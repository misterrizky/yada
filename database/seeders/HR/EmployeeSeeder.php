<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        // Ensure we have some departments and designations
        $designations = \App\Models\HR\Designation::all();
        $departments = \App\Models\HR\Department::all();
        $users = \App\Models\User::get();
        
       
         $employees = [
            [
                'employee_id' =>  127131225006,
                'user_id' => $users->id,
                'first_name' => 'Dani',
                'last_name'  => 'Firmansah',
                'phone'      => '081234567890',
                'gender'     => 'male',
                'marital_status' => 'single',
                'basic_salary' => 5000000,
            ],
            [
                'employee_id' => 124131225005,
                'user_id' => $users->id,
                'first_name' => 'Fazli',
                'last_name'  => 'Rausyan',
                'phone'      => '081298765732',
                'gender'     => 'male',
                'marital_status' => 'married',
                'basic_salary' => 5000000,
            ],
            [
                'employee_id' => '',
                'user_id' => $users->id,
                'first_name' => 'Rizky',
                'last_name'  => 'Ramadhan',
                'phone'      => '082112223333',
                'gender'     => 'male',
                'marital_status' => 'married',
                'basic_salary' => 5000000,
            ],
            [
                'employee_id' => '',
                'user_id' => $users->id,
                'first_name' => 'Ryandra',
                'last_name'  => 'Gunawan',
                'phone'      => '082112223333',
                'gender'     => 'male',
                'marital_status' => 'married',
                'basic_salary' => 5000000,
            ],
        ];

        // Create Employees for existing Users
        foreach ($users as $user) {
            // Skip if employee already exists
            if (\App\Models\HR\Employee::where('user_id', $user->id)->exists()) {
                continue;
            }
            \App\Models\HR\Employee::create([
                'user_id' => $user->id,
                'employee_id' => 'EMP-' . str_pad((string)$user->id, 5, '0', STR_PAD_LEFT),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $user->email,
                'phone' => $faker->phoneNumber,
                'date_of_birth' => $faker->date('Y-m-d', '-20 years'),
                'gender' => $faker->randomElement(['male', 'female']),
                'marital_status' => $faker->randomElement(['single', 'married']),
                'joining_date' => $faker->date('Y-m-d', '-2 years'),
                'basic_salary' => $faker->numberBetween(5000000, 25000000),
                'status' => 'active',
                'employment_type' => 'permanent',
                'department_id' => $departments->isNotEmpty() ? $departments->random()->id : null,
                'designation_id' => $designations->isNotEmpty() ? $designations->random()->id : null,
                'created_by' => $user->id,
            ]);
        }
    }
}
