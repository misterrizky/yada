<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Setup Leave Types if not exists
        $leaveTypes = [
            ['name' => 'Annual Leave', 'days' => 12, 'paid' => true],
            ['name' => 'Sick Leave', 'days' => 14, 'paid' => true],
            ['name' => 'Maternity Leave', 'days' => 90, 'paid' => true],
            ['name' => 'Unpaid Leave', 'days' => 0, 'paid' => false],
        ];
        
        foreach ($leaveTypes as $type) {
             \App\Models\HR\LeaveType::firstOrCreate(
                 ['name' => $type['name']],
                 [
                     'description' => $type['name'],
                     'max_days_per_year' => $type['days'],
                     'is_paid' => $type['paid'],
                     'is_active' => true
                 ]
             );
        }
    }
}
