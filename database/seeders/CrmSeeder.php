<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure Lead Stages exist (called via CrmSeeder -> LeadStageSeeder or externally)
        $this->call(\Database\Seeders\Crm\LeadStageSeeder::class);
        $this->call(\Database\Seeders\Crm\CompanySeeder::class);

        $faker = \Faker\Factory::create('id_ID');
        $users = \App\Models\User::all();
        $stages = \App\Models\Master\Stage::where('flag','=','leads')->get();
        $sources = \App\Models\CRM\Source::all();

        for ($i = 0; $i < 10000; $i++) {
            \App\Models\Crm\Lead::create([
                'name' => $faker->name,
                'company_name' => $faker->company,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'value' => $faker->randomFloat(2, 5000000, 100000000),
                'stage_id' => $stages->isNotEmpty() ? $stages->random()->id : null,
                'source_id' => $sources->isNotEmpty() ? $sources->random()->id : null,
                'user_id' => $users->isNotEmpty() ? $users->random()->id : null, // Assigned to
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);
        }
    }
}
