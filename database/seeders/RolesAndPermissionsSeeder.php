<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HR\Department;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\HR\Designation;
use App\Models\HR\DesignationFamily;
use App\Models\HR\JobLevel;
use Database\Seeders\HR\DepartmentSeeder;
use Database\Seeders\HR\DesignationFamilySeeder;
use Database\Seeders\HR\DesignationSeeder;
use Database\Seeders\HR\JobLevelSeeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = $this->buildPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        if ($this->command) {
            $this->command->info('Created ' . count($permissions) . ' permissions.');
        }
        $this->seedRoles();
    }
    private function buildPermissions(): array
    {
        $actions = ['view', 'create', 'update', 'delete'];
        $permissions = [];
        $moduleMap = [
            'Approval' => 'approval',
            'Asset' => 'asset',
            'CMS' => 'cms',
            'CRM' => 'crm',
            'DMS' => 'dms',
            'Finance' => 'finance',
            'HR' => 'hrm',
            'Master' => 'master',
            'PM' => 'project',
            'Procurement' => 'procurement',
            'QA' => 'qa',
            'Regional' => 'regional',
            'Resource' => 'resource',
            'Sales' => 'sales',
            'Support' => 'support',
            'User' => 'user',
        ];

        $modelFiles = File::allFiles(app_path('Models'));

        foreach ($modelFiles as $file) {
            $relativePath = $file->getRelativePathname();
            $pathWithoutExt = preg_replace('/\.php$/', '', $relativePath);
            $segments = preg_split('/[\\\\\/]/', (string) $pathWithoutExt);

            if (! $segments) {
                continue;
            }

            $classBase = array_pop($segments);
            $moduleSegment = $segments[0] ?? $classBase;
            $module = $moduleMap[$moduleSegment] ?? Str::snake((string) $moduleSegment);
            $resource = Str::snake((string) $classBase);

            foreach ($actions as $action) {
                $permissions[] = "{$module}.{$resource}.{$action}";
            }
        }

        $permissions = array_values(array_unique($permissions));
        sort($permissions);

        return $permissions;
    }

    private function seedRoles(): void
    {
        $this->ensureHrSeeded();

        $roleNames = collect()
            // ->merge(JobLevel::query()->orderBy('sort_order')->pluck('name'))
            // ->merge(Department::query()->orderBy('name')->pluck('name'))
            // ->merge(Designation::query()->orderBy('id','asc')->pluck('designation'))
            ->merge([
                // 'Pemegang Saham',
                // 'Sekretaris RUPS',
                // 'Komisaris Utama',
                // 'Komisaris',
                // 'Sekretaris Dewan Komisaris',
                // 'Ketua Komite',
                // 'Anggota Komite',
                // 'Sekretaris Komite',
                'Super Admin',
                'Direktur Utama',
                'Direktur',
                'Sekretaris Perusahaan',
                'Head',
                'Manager',
                'Staff',
                'Client',
                'Partner',
                'Job Seeker'
            ])
            ->map(fn ($name) => is_string($name) ? trim($name) : $name)
            ->filter()
            ->unique()
            ->values();

        foreach ($roleNames as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        if ($this->command) {
            $this->command->info('Created ' . $roleNames->count() . ' roles.');
        }
    }

    private function ensureHrSeeded(): void
    {
        // if (! JobLevel::query()->exists()) {
        //     $this->call(JobLevelSeeder::class);
        // }

        // if (! Department::query()->exists()) {
        //     $this->call(DepartmentSeeder::class);
        // }

        // if (! DesignationFamily::query()->exists()) {
        //     $this->call(DesignationFamilySeeder::class);
        // }

        // if (! Designation::query()->exists()) {
        //     $this->call(DesignationSeeder::class);
        // }
    }
}
