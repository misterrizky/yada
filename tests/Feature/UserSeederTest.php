<?php

namespace Tests\Feature;

use App\Models\Master\BloodType;
use App\Models\Master\Religion;
use App\Models\User;
use Database\Seeders\HrmSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_seeder_creates_profiles_for_seeded_users(): void
    {
        $this->seed(HrmSeeder::class);
        $this->seedRoles();
        $this->seedMasterData();

        $this->seed(UserSeeder::class);

        $users = User::query()
            ->whereIn('email', [
                'rizky.ramadhan@yex.co.id',
                'ryandra.gunawan@yex.co.id',
                'fazli.rausyan@yex.co.id',
                'dani.firmansah@yex.co.id',
            ])
            ->get();

        $this->assertCount(4, $users);

        foreach ($users as $user) {
            $this->assertDatabaseHas('user_profiles', [
                'user_id' => $user->id,
            ]);
        }
    }

    public function test_user_seeder_creates_missing_blood_type_and_religion(): void
    {
        $this->seed(HrmSeeder::class);
        $this->seedRoles();

        $this->assertDatabaseCount('blood_types', 0);
        $this->assertDatabaseCount('religions', 0);

        $this->seed(UserSeeder::class);

        $this->assertDatabaseHas('blood_types', [
            'name' => 'AB',
        ]);

        $this->assertDatabaseHas('religions', [
            'name' => 'Islam',
        ]);
    }

    private function seedRoles(): void
    {
        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Direktur Utama',
            'guard_name' => 'web',
        ]);
    }

    private function seedMasterData(): void
    {
        $bloodType = new BloodType;
        $bloodType->name = 'AB';
        $bloodType->save();

        $religion = new Religion;
        $religion->name = 'Islam';
        $religion->save();
    }
}
