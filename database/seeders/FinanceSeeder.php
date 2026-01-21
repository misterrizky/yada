<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseCategories = [
            [
                'name' => 'Travel & Transport',
                'description' => 'Biaya perjalanan dinas, bahan bakar, parkir, dan transportasi umum.',
            ],
            [
                'name' => 'Meals & Entertainment',
                'description' => 'Biaya makan, jamuan klien, dan hiburan terkait bisnis.',
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Alat tulis kantor, kertas, tinta printer, dan perlengkapan kecil lainnya.',
            ],
            [
                'name' => 'Communication',
                'description' => 'Biaya pulsa telepon, paket internet, dan langganan software komunikasi.',
            ],
            [
                'name' => 'Utilities',
                'description' => 'Tagihan listrik, air, dan kebersihan.',
            ],
            [
                'name' => 'Rent',
                'description' => 'Biaya sewa kantor atau tempat usaha.',
            ],
            [
                'name' => 'Salary & Benefits',
                'description' => 'Gaji karyawan, bonus, tunjangan, dan lembur.',
            ],
            [
                'name' => 'Marketing & Advertising',
                'description' => 'Biaya iklan, promosi, dan materi pemasaran.',
            ],
            [
                'name' => 'Maintenance & Repairs',
                'description' => 'Perbaikan fasilitas kantor dan pemeliharaan aset.',
            ],
            [
                'name' => 'Professional Services',
                'description' => 'Biaya konsultan, jasa hukum, akuntan, dan tenaga ahli luar.',
            ],
            [
                'name' => 'Insurance',
                'description' => 'Premi asuransi bisnis, kesehatan karyawan, dan aset.',
            ],
            [
                'name' => 'Taxes & Licenses',
                'description' => 'Pajak perusahaan, biaya perizinan, dan retribusi.',
            ],
            [
                'name' => 'Miscellaneous',
                'description' => 'Biaya tak terduga atau yang tidak masuk kategori lain.',
            ],
        ];

        foreach ($expenseCategories as $category) {
            \App\Models\Finance\ExpenseCategory::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description'], 'is_active' => true]
            );
        }
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
            'Bank Transfer', 'Credit Card', 'Cash', 'Cheque',
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
