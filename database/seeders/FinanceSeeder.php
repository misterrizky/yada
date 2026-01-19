<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tax Rates (if not already seeded by Master, but Finance might have specific ones)
        // Master usually handles general tax rates, Finance might handle specific accounting configurations.
        // Checking DatabaseSeeder, MasterSeeder seems to handle basic master data.
        
        // 2. Chart of Accounts (Simplified)
        $accounts = [
            ['code' => '1001', 'name' => 'Cash on Hand', 'type' => 'asset'],
            ['code' => '1002', 'name' => 'Bank BCA', 'type' => 'asset'],
            ['code' => '2001', 'name' => 'Accounts Payable', 'type' => 'liability'],
            ['code' => '3001', 'name' => 'Share Capital', 'type' => 'equity'],
            ['code' => '4001', 'name' => 'Sales Revenue', 'type' => 'revenue'],
            ['code' => '5001', 'name' => 'Office Supplies', 'type' => 'expense'],
            ['code' => '5002', 'name' => 'Salary Expense', 'type' => 'expense'],
        ];
        
        // Assuming there is a Coa or Account model. Let's check Finance models first to be sure, 
        // but I will write generic code assuming standard ERP tables if I can't verify quickly.
        // Actually, let's stick to what we know exists: PaymentMethods, Taxes (if in Finance).
        // create dummy invoices if possible? 
        // Need Customers first (Sales).
        
        // Let's seed Payment Methods
        $paymentMethods = [
            'Bank Transfer', 'Credit Card', 'Cash', 'Cheque'
        ];
        
        foreach ($paymentMethods as $pm) {
            \App\Models\Finance\PaymentMethod::firstOrCreate(
                ['name' => $pm],
                ['is_active' => true]
            );
        }
        
        // Seed Taxes if needed (or rely on Master)
        // \App\Models\Finance\Tax::firstOrCreate(['name' => 'VAT 11%'], ['rate' => 11]);
    }
}
