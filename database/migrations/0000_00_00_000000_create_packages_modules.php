<?php

use Plank\Mediable\Media;
use Illuminate\Support\Facades\DB;
use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Cog\Laravel\Love\Reacter\Models\Reacter;
use Illuminate\Database\Migrations\Migration;
use Cog\Laravel\Love\Reactant\Models\Reactant;
use Cog\Laravel\Love\Reaction\Models\Reaction;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Spatie\Health\Models\HealthCheckResultHistoryItem;
use Spatie\UptimeMonitor\Models\Enums\CertificateStatus;
use Spatie\Health\ResultStores\EloquentHealthResultStore;
use Cog\Laravel\Love\Reactant\ReactionTotal\Models\ReactionTotal;
use Cog\Laravel\Love\Reactant\ReactionCounter\Models\ReactionCounter;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('bans', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('bannable');
            $table->nullableMorphs('created_by');
            $table->text('comment')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('expired_at');
        });
        Schema::connection(config('short-url.connection'))->create('short_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('destination_url');

            $urlKeyColumn = $table->string('url_key')->unique();

            if (Schema::getConnection()->getConfig('driver') === 'mysql') {
                $urlKeyColumn->collation('utf8mb4_bin');
            }

            $table->string('default_short_url');
            $table->boolean('single_use');
            $table->boolean('track_visits');
            $table->timestamps();
        });
        Schema::connection(config('short-url.connection'))->create('short_url_visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('short_url_id');
            $table->string('ip_address')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('operating_system_version')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->timestamp('visited_at');
            $table->timestamps();

            $table->foreign('short_url_id')->references('id')->on('short_urls')->onDelete('cascade');
        });
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->integer('redirect_status_code')->after('track_visits')->default(301);
            $table->boolean('track_ip_address')->after('redirect_status_code')->default(false);
            $table->boolean('track_operating_system')->after('track_ip_address')->default(false);
            $table->boolean('track_operating_system_version')->after('track_operating_system')->default(false);
            $table->boolean('track_browser')->after('track_operating_system_version')->default(false);
            $table->boolean('track_browser_version')->after('track_browser')->default(false);
            $table->boolean('track_referer_url')->after('track_browser_version')->default(false);
            $table->boolean('track_device_type')->after('track_referer_url')->default(false);
        });

        DB::connection(config('short-url.connection'))->table('short_urls')->update([
            'track_ip_address' => config('short-url.tracking.fields.ip_address'),
            'track_operating_system' => config('short-url.tracking.fields.operating_system'),
            'track_operating_system_version' => config('short-url.tracking.fields.operating_system_version'),
            'track_browser' => config('short-url.tracking.fields.browser'),
            'track_browser_version' => config('short-url.tracking.fields.browser_version'),
            'track_referer_url' => config('short-url.tracking.fields.referer_url'),
            'track_device_type' => config('short-url.tracking.fields.device_type'),
        ]);
        Schema::connection(config('short-url.connection'))->table('short_url_visits', function (Blueprint $table) {
            $table->string('referer_url')->after('browser_version')->nullable();
            $table->string('device_type')->after('referer_url')->nullable();
        });
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->timestamp('activated_at')->after('track_device_type')->nullable()->default(now());
            $table->timestamp('deactivated_at')->after('activated_at')->nullable();
        });
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->boolean('forward_query_params')->after('single_use')->default(false);
        });
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->dropColumn(['forward_query_params']);
        });
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable();
            $table->text('description');
            $table->nullableMorphs('subject', 'subject');
            $table->nullableMorphs('causer', 'causer');
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_name');
        });
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->string('event')->nullable()->after('subject_type');
        });
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->uuid('batch_uuid')->nullable()->after('properties');
        });
        Schema::create(config('authentication-log.table_name'), function (Blueprint $table) {
            $table->id();
            $table->morphs('authenticatable');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device_id')->nullable()->index();
            $table->string('device_name')->nullable();
            $table->boolean('is_trusted')->default(false);
            $table->timestamp('login_at')->nullable();
            $table->boolean('login_successful')->default(false);
            $table->timestamp('logout_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->boolean('cleared_by_user')->default(false);
            $table->json('location')->nullable();
            $table->boolean('is_suspicious')->default(false);
            $table->string('suspicious_reason')->nullable();
        });
        $tableName = config('authentication-log.table_name', 'authentication_log');
        
        if (! Schema::hasTable($tableName)) {
            return;
        }

        // Check for columns outside the closure for better database compatibility
        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add device_id column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'device_id')) {
                $table->string('device_id')->nullable()->index()->after('user_agent');
            }
        });

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add device_name column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'device_name')) {
                $table->string('device_name')->nullable()->after('device_id');
            }
        });

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add is_trusted column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'is_trusted')) {
                $table->boolean('is_trusted')->default(false)->after('device_name');
            }
        });

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add last_activity_at column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'last_activity_at')) {
                $table->timestamp('last_activity_at')->nullable()->after('logout_at');
            }
        });

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add is_suspicious column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'is_suspicious')) {
                $table->boolean('is_suspicious')->default(false)->after('location');
            }
        });

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            // Add suspicious_reason column if it doesn't exist
            if (! Schema::hasColumn($tableName, 'suspicious_reason')) {
                $table->string('suspicious_reason')->nullable()->after('is_suspicious');
            }
        });
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');
            $table->uuid()->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->json('manipulations');
            $table->json('custom_properties');
            $table->json('generated_conversions');
            $table->json('responsive_images');
            $table->unsignedInteger('order_column')->nullable()->index();

            $table->nullableTimestamps();
        });
        Schema::create('folders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')->nullable()->constrained('folders')->cascadeOnDelete();

            $table->string('name')->nullable();
            $table->string('slug')->nullable();

            $table->timestamps();
        });
        Schema::table('folders', function (Blueprint $table) {
            if (!Schema::hasColumn('folders', 'user_id')) {
                $table->foreignIdFor(config('auth.providers.users.model'), 'user_id')
                    ->nullable()
                    ->nullOnDelete();
            }
        });
        Schema::create('monitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();

            $table->boolean('uptime_check_enabled')->default(true);
            $table->string('look_for_string')->default('');
            $table->string('uptime_check_interval_in_minutes')->default(5);
            $table->string('uptime_status')->default(UptimeStatus::NOT_YET_CHECKED);
            $table->text('uptime_check_failure_reason')->nullable();
            $table->integer('uptime_check_times_failed_in_a_row')->default(0);
            $table->timestamp('uptime_status_last_change_date')->nullable();
            $table->timestamp('uptime_last_check_date')->nullable();
            $table->timestamp('uptime_check_failed_event_fired_on_date')->nullable();
            $table->string('uptime_check_method')->default('get');
            $table->text('uptime_check_payload')->nullable();
            $table->text('uptime_check_additional_headers')->nullable();
            $table->string('uptime_check_response_checker')->nullable();

            $table->boolean('certificate_check_enabled')->default(false);
            $table->string('certificate_status')->default(CertificateStatus::NOT_YET_CHECKED);
            $table->timestamp('certificate_expiration_date')->nullable();
            $table->string('certificate_issuer')->nullable();
            $table->string('certificate_check_failure_reason')->default('');

            $table->timestamps();
        });
        Schema::create('monitored_scheduled_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('type')->nullable();
            $table->string('cron_expression');
            $table->string('timezone')->nullable();
            $table->string('ping_url')->nullable();

            $table->dateTime('last_started_at')->nullable();
            $table->dateTime('last_finished_at')->nullable();
            $table->dateTime('last_failed_at')->nullable();
            $table->dateTime('last_skipped_at')->nullable();

            $table->dateTime('registered_on_oh_dear_at')->nullable();
            $table->dateTime('last_pinged_at')->nullable();
            $table->integer('grace_time_in_minutes');

            $table->timestamps();
        });


        Schema::create('monitored_scheduled_task_log_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('monitored_scheduled_task_id');
            $table
                ->foreign('monitored_scheduled_task_id', 'fk_scheduled_task_id')
                ->references('id')
                ->on('monitored_scheduled_tasks')
                ->cascadeOnDelete();

            $table->string('type');

            $table->json('meta')->nullable();

            $table->timestamps();
        });
        $connection = (new HealthCheckResultHistoryItem)->getConnectionName();
        $tableName = EloquentHealthResultStore::getHistoryItemInstance()->getTable();
    
        Schema::connection($connection)->create($tableName, function (Blueprint $table) {
            $table->id();

            $table->string('check_name');
            $table->string('check_label');
            $table->string('status');
            $table->text('notification_message')->nullable();
            $table->string('short_summary')->nullable();
            $table->json('meta');
            $table->timestamp('ended_at');
            $table->uuid('batch');

            $table->timestamps();
        });
        
        Schema::connection($connection)->table($tableName, function (Blueprint $table) {
            $table->index('created_at');
            $table->index('batch');
        });
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('reason')->nullable();
            $table->morphs('model');
            $table->timestamps();
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('slug');
            $table->string('type')->nullable()->index();
            $table->integer('order_column')->nullable();

            $table->timestamps();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

            $table->morphs('taggable');
            $table->index('taggable_type');

            $table->unique(['tag_id', 'taggable_id', 'taggable_type']);
        });
        Schema::create('hosts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ssh_user')->nullable();
            $table->integer('port')->nullable();
            $table->string('ip')->nullable();
            $table->json('custom_properties')->nullable();
            $table->timestamps();
        });
        Schema::create('checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
            $table->string('type');
            $table->string('status')->nullable();
            $table->boolean('enabled')->default(true);
            $table->text('last_run_message')->nullable();
            $table->json('last_run_output')->nullable();
            $table->timestamp('last_ran_at')->nullable();
            $table->integer('next_run_in_minutes')->nullable();
            $table->timestamp('started_throttling_failing_notifications_at')->nullable();
            $table->json('custom_properties')->nullable();
            $table->timestamps();
        });
        Schema::create(Models::table('threads'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create(Models::table('messages'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create(Models::table('participants'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('last_read')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('settings', function (Blueprint $table): void {
            $table->id();

            $table->string('group');
            $table->string('name');
            $table->boolean('locked')->default(false);
            $table->json('payload');

            $table->timestamps();

            $table->unique(['group', 'name']);
        });
        Schema::create((new Reacter())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->timestamps();

            $table->index('type');
        });
        Schema::create((new Reactant())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->timestamps();

            $table->index('type');
        });
        Schema::create((new ReactionType())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('mass');
            $table->timestamps();

            $table->index('name');
        });
        Schema::create((new Reaction())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reactant_id');
            $table->unsignedBigInteger('reacter_id');
            $table->unsignedBigInteger('reaction_type_id');
            $table->decimal('rate', 4, 2);
            $table->timestamps();

            $table->index([
                'reactant_id',
                'reaction_type_id',
            ]);
            $table->index([
                'reactant_id',
                'reacter_id',
                'reaction_type_id',
            ]);
            $table->index([
                'reactant_id',
                'reacter_id',
            ]);
            $table->index([
                'reacter_id',
                'reaction_type_id',
            ]);

            $table
                ->foreign('reactant_id')
                ->references('id')
                ->on((new Reactant())->getTable())
                ->onDelete('cascade');
            $table
                ->foreign('reacter_id')
                ->references('id')
                ->on((new Reacter())->getTable())
                ->onDelete('cascade');
            $table
                ->foreign('reaction_type_id')
                ->references('id')
                ->on((new ReactionType())->getTable())
                ->onDelete('cascade');
        });
        Schema::create((new ReactionCounter())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reactant_id');
            $table->unsignedBigInteger('reaction_type_id');
            $table->unsignedBigInteger('count');
            $table->decimal('weight', 13, 2);
            $table->timestamps();

            $table->index([
                'reactant_id',
                'reaction_type_id',
            ], 'love_reactant_reaction_counters_reactant_reaction_type_index');

            $table
                ->foreign('reactant_id')
                ->references('id')
                ->on((new Reactant())->getTable())
                ->onDelete('cascade');
            $table
                ->foreign('reaction_type_id')
                ->references('id')
                ->on((new ReactionType())->getTable())
                ->onDelete('cascade');
        });
        Schema::create((new ReactionTotal())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reactant_id');
            $table->unsignedBigInteger('count');
            $table->decimal('weight', 13, 2);
            $table->timestamps();

            $table
                ->foreign('reactant_id')
                ->references('id')
                ->on((new Reactant())->getTable())
                ->onDelete('cascade');
        });
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('uuid');
            $table->string('filename');
            $table->string('document_filename')->nullable();
            $table->boolean('certified')->default(false);
            $table->json('from_ips')->nullable();
            $table->timestamps();
        });
        if (!Schema::hasTable('media')) {
            Schema::create(
                'media',
                function (Blueprint $table) {
                    $table->id();
                    $table->string('disk', 32);
                    $table->string('directory');
                    $table->string('filename');
                    $table->string('extension', 32);
                    $table->string('mime_type', 128);
                    $table->string('aggregate_type', 32)->index();
                    $table->unsignedInteger('size');
                    $table->timestamps();
                    $table->unique(['disk', 'directory', 'filename', 'extension']);
                }
            );
        }

        if (!Schema::hasTable('mediables')) {
            Schema::create(
                'mediables',
                function (Blueprint $table) {
                    $table->foreignIdFor(Media::class)->constrained('media')->cascadeOnDelete();
                    $table->morphs('mediable');
                    $table->string('tag')->index();
                    $table->unsignedInteger('order')->index();
                    $table->primary(['media_id', 'mediable_type', 'mediable_id', 'tag']);
                    $table->index(['mediable_id', 'mediable_type']);
                }
            );
        }
        Schema::whenTableDoesntHaveColumn(
            'media',
            'variant_name',
            function (Blueprint $table) {
                $table->string('variant_name', 255)
                    ->after('size')
                    ->nullable();
            }
        );
        Schema::whenTableDoesntHaveColumn(
            'media',
            'original_media_id',
            function (Blueprint $table) {
                $table->foreignIdFor(Media::class, 'original_media_id')
                    ->nullable()
                    ->after('variant_name')
                    ->constrained('media')
                    ->nullOnDelete();
            }
        );
        Schema::whenTableDoesntHaveColumn(
            'media',
            'alt',
            function (Blueprint $table) {
                $table->text('alt')->nullable();
            }
        );
        if (!Schema::hasTable('meta')) {
            Schema::create('meta', function (Blueprint $table) {
                $table->id();
                $table->morphs('metable');
                $table->string('type')->nullable();
                $table->string('key')->index();
                $table->longtext('value');
            });
        }
        Schema::table('meta', function (Blueprint $table) {
            $table->dropIndex(['metable_type', 'metable_id']);
            $table->unique(['metable_type', 'metable_id', 'key']);
            $table->index(['key', 'metable_type']);
        });
        Schema::table('meta', function (Blueprint $table) {
            $table->decimal('numeric_value', 36, 16)->nullable();
            $table->string('hmac', 64)->nullable();

            $table->dropIndex(['key', 'metable_type']);
            $table->dropIndex(['key']);
            $table->index(['key', 'metable_type', 'numeric_value']);

            $stringIndexLength = (int)config('metable.stringValueIndexLength', 255);
            $connection = $this->detectConnectionInUse();
            if ($stringIndexLength > 0 && $driver = $connection?->getDriverName()) {
                $grammar = $connection->getQueryGrammar();
                if (in_array($driver, ['mysql', 'mariadb'])) {
                    $table->rawIndex(
                        sprintf(
                            "%s, %s, %s(%d)",
                            $grammar->wrap('metable_type'),
                            $grammar->wrap('key'),
                            $grammar->wrap('value'),
                            $stringIndexLength
                        ),
                        'value_string_prefix_index'
                    );
                } elseif (in_array($driver, ['pgsql', 'sqlite'])) {
                    $table->rawIndex(
                        sprintf(
                            "%s, %s, SUBSTR(%s, 1, %d)",
                            $grammar->wrap('metable_type'),
                            $grammar->wrap('key'),
                            $grammar->wrap('value'),
                            $stringIndexLength
                        ),
                        'value_string_prefix_index'
                    );
                }
            }
        });
    }
    public function down(): void
    {
        Schema::table('meta', function (Blueprint $table) {
            $stringIndexLength = (int)config('metable.stringValueIndexLength', 255);
            if ($stringIndexLength > 0
                && in_array(
                    $this->detectConnectionInUse()?->getDriverName(),
                    ['mysql', 'mariadb', 'pgsql', 'sqlite']
                )
            ) {
                $table->dropIndex('value_string_prefix_index');
            }

            $table->dropIndex(['key', 'metable_type', 'numeric_value']);
            $table->index(['key']);
            $table->index(['key', 'metable_type']);
            $table->dropColumn('hmac');
            $table->dropColumn('numeric_value');
        });
        Schema::table('meta', function (Blueprint $table) {
            $table->dropIndex(['key', 'metable_type']);
            $table->dropUnique(['metable_type', 'metable_id', 'key']);
            $table->index(['metable_type', 'metable_id']);
        });
        Schema::dropIfExists('meta');
        Schema::whenTableHasColumn(
            'media',
            'alt',
            function (Blueprint $table) {
                $table->dropColumn('alt');
            }
        );
        Schema::whenTableHasColumn(
            'media',
            'original_media_id',
            function (Blueprint $table) {
                // SQLite does not support dropping foreign keys or columns with constraints
                // skip removing this column, the `whenTableDoesntHaveColumn`
                // method should make this safe to play back
                if (DB::getDriverName() !== 'sqlite') {
                    $table->dropConstrainedForeignIdFor(Media::class, 'original_media_id');
                }
            }
        );
        Schema::whenTableHasColumn(
            'media',
            'variant_name',
            function (Blueprint $table) {
                $table->dropColumn('variant_name');
            }
        );
        Schema::dropIfExists('mediables');
        Schema::dropIfExists('media');
        Schema::dropIfExists('signatures');
        Schema::dropIfExists((new ReactionTotal())->getTable());
        Schema::dropIfExists((new ReactionCounter())->getTable());
        Schema::dropIfExists((new Reaction())->getTable());
        Schema::dropIfExists((new ReactionType())->getTable());
        Schema::dropIfExists((new Reactant())->getTable());
        Schema::dropIfExists((new Reacter())->getTable());
        Schema::drop('settings');
        Schema::dropIfExists(Models::table('participants'));
        Schema::dropIfExists(Models::table('messages'));
        Schema::dropIfExists(Models::table('threads'));
        Schema::drop('checks');
        Schema::drop('hosts');
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('health_check_result_history_items');
        Schema::dropIfExists('monitored_scheduled_task_log_items');
        Schema::dropIfExists('monitored_scheduled_tasks');
        Schema::dropIfExists('monitors');
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('folders');
        Schema::dropIfExists('media');
        $tableName = config('authentication-log.table_name', 'authentication_log');
        
        if (! Schema::hasTable($tableName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($tableName) {
            $columns = [
                'device_id',
                'device_name',
                'is_trusted',
                'last_activity_at',
                'is_suspicious',
                'suspicious_reason',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn($tableName, $column)) {
                    $table->dropColumn($column);
                }
            }
        });
        Schema::dropIfExists(config('authentication-log.table_name'));
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->dropColumn('batch_uuid');
        });
        Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
            $table->dropColumn('event');
        });
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->dropColumn(['activated_at', 'deactivated_at']);
        });
        Schema::connection(config('short-url.connection'))->table('short_url_visits', function (Blueprint $table) {
            $table->dropColumn(['referer_url', 'device_type']);
        });
        Schema::connection(config('short-url.connection'))->table('short_urls', function (Blueprint $table) {
            $table->dropColumn([
                'redirect_status_code',
                'track_ip_address',
                'track_operating_system',
                'track_operating_system_version',
                'track_browser',
                'track_browser_version',
                'track_referer_url',
                'track_device_type',
            ]);
        });
        Schema::connection(config('short-url.connection'))->dropIfExists('short_url_visits');
        Schema::connection(config('short-url.connection'))->dropIfExists('short_urls');
        Schema::dropIfExists('bans');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
    }
    private function detectConnectionInUse(): Connection
    {
        return Schema::getConnection();
    }
};
