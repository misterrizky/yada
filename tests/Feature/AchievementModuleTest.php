<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LevelUp\Experience\Models\Achievement;
use LevelUp\Experience\Models\Activity;
use LevelUp\Experience\Models\Experience;
use LevelUp\Experience\Models\Level;
use LevelUp\Experience\Models\Streak;
use Livewire\Volt\Volt;
use Tests\TestCase;

class AchievementModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_achievement_index_shows_records(): void
    {
        $user = User::factory()->create();
        $achievement = Achievement::create([
            'name' => 'Level 10',
            'is_secret' => false,
            'description' => 'When a user hits level 10',
        ]);

        $achievement->users()->attach($user->id, ['progress' => 10]);

        $response = $this->actingAs($user)
            ->get(route('app.achievement'));

        $response->assertOk();
        $response->assertSee('Level 10');
    }

    public function test_achievement_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $achievement = Achievement::create([
            'name' => 'Level 20',
            'is_secret' => true,
        ]);

        Volt::actingAs($user)
            ->test('apps.achievements.achievement.index')
            ->call('deleteAchievement', $achievement->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('achievements', [
            'id' => $achievement->id,
        ]);
    }

    public function test_achievement_form_creates_record(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.form.achievement.achievement')
            ->set('name', 'Level 30')
            ->set('is_secret', 1)
            ->set('description', 'When a user hits level 30')
            ->set('image', 'achievements/level-30.png')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-achievement');

        $this->assertDatabaseHas('achievements', [
            'name' => 'Level 30',
            'is_secret' => 1,
        ]);
    }

    public function test_achievement_form_requires_fields(): void
    {
        Volt::test('apps.form.achievement.achievement')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
            ]);
    }

    public function test_experience_index_shows_records(): void
    {
        $user = User::factory()->create();
        $level = Level::create([
            'level' => 10,
            'next_level_experience' => 2000,
        ]);

        Experience::create([
            'user_id' => $user->id,
            'level_id' => $level->id,
            'experience_points' => 1500,
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.experience'));

        $response->assertOk();
        $response->assertSee($user->name);
        $response->assertSee('1500');
    }

    public function test_experience_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $level = Level::create([
            'level' => 11,
            'next_level_experience' => 2200,
        ]);
        $experience = Experience::create([
            'user_id' => $user->id,
            'level_id' => $level->id,
            'experience_points' => 1800,
        ]);

        Volt::actingAs($user)
            ->test('apps.achievements.experience.index')
            ->call('deleteExperience', $experience->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('experiences', [
            'id' => $experience->id,
        ]);
    }

    public function test_experience_form_creates_record(): void
    {
        $user = User::factory()->create();
        $level = Level::create([
            'level' => 12,
            'next_level_experience' => 2400,
        ]);

        Volt::actingAs($user)
            ->test('apps.form.achievement.experience')
            ->set('userId', $user->id)
            ->set('levelId', $level->id)
            ->set('experience_points', 2100)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-experience');

        $this->assertDatabaseHas('experiences', [
            'user_id' => $user->id,
            'level_id' => $level->id,
            'experience_points' => 2100,
        ]);
    }

    public function test_experience_form_requires_fields(): void
    {
        Volt::test('apps.form.achievement.experience')
            ->call('save')
            ->assertHasErrors([
                'userId' => 'required',
                'levelId' => 'required',
                'experience_points' => 'required',
            ]);
    }

    public function test_level_index_shows_records(): void
    {
        $user = User::factory()->create();

        Level::create([
            'level' => 101,
            'next_level_experience' => 5000,
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.level'));

        $response->assertOk();
        $response->assertSee('101');
    }

    public function test_level_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $level = Level::create([
            'level' => 102,
            'next_level_experience' => 5200,
        ]);

        Volt::actingAs($user)
            ->test('apps.achievements.level.index')
            ->call('deleteLevel', $level->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('levels', [
            'id' => $level->id,
        ]);
    }

    public function test_level_form_creates_record(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.form.achievement.level')
            ->set('level', 103)
            ->set('next_level_experience', 5400)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-level');

        $this->assertDatabaseHas('levels', [
            'level' => 103,
            'next_level_experience' => 5400,
        ]);
    }

    public function test_level_form_requires_fields(): void
    {
        Volt::test('apps.form.achievement.level')
            ->set('level', 0)
            ->call('save')
            ->assertHasErrors([
                'level' => 'min',
            ]);
    }

    public function test_streak_index_shows_records(): void
    {
        $user = User::factory()->create();
        $activity = Activity::create([
            'name' => 'Daily Login',
            'description' => 'Log in every day',
        ]);

        Streak::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'count' => 5,
            'activity_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.streak'));

        $response->assertOk();
        $response->assertSee('Daily Login');
    }

    public function test_streak_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $activity = Activity::create([
            'name' => 'Weekly Sync',
        ]);
        $streak = Streak::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'count' => 2,
            'activity_at' => now(),
        ]);

        Volt::actingAs($user)
            ->test('apps.achievements.streaks.index')
            ->call('deleteStreak', $streak->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('streaks', [
            'id' => $streak->id,
        ]);
    }

    public function test_streak_form_creates_record(): void
    {
        $user = User::factory()->create();
        $activity = Activity::create([
            'name' => 'Weekly Review',
        ]);
        $activityAt = now()->format('Y-m-d H:i:s');

        Volt::actingAs($user)
            ->test('apps.form.achievement.streak')
            ->set('userId', $user->id)
            ->set('activityId', $activity->id)
            ->set('count', 3)
            ->set('activity_at', $activityAt)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-streak');

        $this->assertDatabaseHas('streaks', [
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'count' => 3,
        ]);
    }

    public function test_streak_form_requires_fields(): void
    {
        Volt::test('apps.form.achievement.streak')
            ->call('save')
            ->assertHasErrors([
                'userId' => 'required',
                'activityId' => 'required',
                'count' => 'required',
                'activity_at' => 'required',
            ]);
    }
}
