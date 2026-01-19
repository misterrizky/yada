<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\PM\Project;
use App\Models\Crm\Company;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\PM\ProjectGallery;
use App\Models\PM\ProjectCategory;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Website / Company Profile',
                'description' => 'Pembuatan website company profile, landing page, atau portal informasi.',
                'is_active' => true,
            ],
            [
                'name' => 'Web Application / Platform',
                'description' => 'Aplikasi berbasis web untuk proses bisnis, portal, atau platform digital.',
                'is_active' => true,
            ],
            [
                'name' => 'Mobile Application',
                'description' => 'Aplikasi mobile Android/iOS untuk operasional maupun layanan publik.',
                'is_active' => true,
            ],
            [
                'name' => 'E-Commerce',
                'description' => 'Marketplace / B2B / B2C commerce, katalog, checkout, pembayaran, dsb.',
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise System (ERP/Accounting/Inventory)',
                'description' => 'Sistem internal seperti inventory, accounting, procurement, HR, dll.',
                'is_active' => true,
            ],
            [
                'name' => 'Government Information System',
                'description' => 'Sistem informasi untuk instansi pemerintah (dukcapil, pelaporan, e-office, dsb).',
                'is_active' => true,
            ],
            [
                'name' => 'Data & Analytics / BI',
                'description' => 'Dashboard, pelaporan, analitik, data center, dan business intelligence.',
                'is_active' => true,
            ],
            [
                'name' => 'AI / Machine Learning',
                'description' => 'Proyek AI/ML seperti computer vision, classification, recommendation, dsb.',
                'is_active' => true,
            ],
            [
                'name' => 'Infrastructure / Support',
                'description' => 'Dukungan infrastruktur, operasional TI, dan maintenance layanan.',
                'is_active' => true,
            ],
            [
                'name' => 'Consultancy Services',
                'description' => 'Jasa konsultansi, advisory, pendampingan implementasi, dan assessment.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $c) {
            ProjectCategory::firstOrCreate(
                ['name' => $c['name']],
                [
                    'description' => $c['description'],
                    'is_active' => $c['is_active'],
                ]
            );
        }
        $projects = [
            ['name' => 'ALV Website', 'company' => 'ALV', 'date' => 'DESEMBER 2025', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'AI Counting Food Tray', 'company' => 'Badan Gizi Nasional', 'date' => 'SEPTEMBER 2024', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Intelligence Social Platform', 'company' => 'Pusat Intel Angkatan Darat', 'date' => 'AGUSTUS 2023', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Babinsar Reporting Mobile Apps', 'company' => 'Pusat Intel Angkatan Darat', 'date' => 'AGUSTUS 2023', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'KYC & Rent Platform', 'company' => 'Adamasanya', 'date' => 'SEPTEMBER 2023', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Coway (Company Profile)', 'company' => 'Coway', 'date' => 'APRIL 2023', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'IKN Design Competition Platform', 'company' => 'Kementerian PUPR', 'date' => 'MARET 2022', 'is_featured' => 1, 'summary' => 'The IKN Competition Platform is designed to facilitate the competition process, starting from the registration process of the participants, submission of the design ideas, evaluation and selection of the winning designs by the judges, and finally announcing the winners.'],
            ['name' => 'Overseas Grant Loan', 'company' => 'Kementerian PUPR', 'date' => 'JANUARI 2022', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'IKN Building Calculation System', 'company' => 'Kementerian PUPR', 'date' => 'DESEMBER 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Civil Registration App', 'company' => 'Kementerian Dalam Negri', 'date' => 'SEPTEMBER 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'E-Office Dukcapil', 'company' => 'Kementerian Dalam Negri', 'date' => 'AGUSTUS 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Interregional Communication App', 'company' => 'Kementerian Dalam Negri', 'date' => 'OKTOBER 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Non Permanent Civil Registration App', 'company' => 'Kementerian Dalam Negri', 'date' => 'NOVEMBER 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Company Profile', 'company' => 'Republikorp', 'date' => 'JANUARI 2022', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Out Source', 'company' => 'Bank Mandiri', 'date' => 'AGUSTUS 2022', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Consultancy Services', 'company' => 'Panasonic', 'date' => 'SEPTEMBER 2022', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'E-Commerce', 'company' => 'Bajaga', 'date' => 'JULY 2022', 'is_featured' => 1, 'summary' => 'E-Commerce B2B Platform is a digital marketplace that connects businesses to suppliers and customers in a user-friendly and secure environment.'],
            ['name' => 'Education Platform with Subcription - Edodon', 'company' => 'CV Jaya Indonesia Prestasi', 'date' => 'DESEMBER 2021', 'is_featured' => 1, 'summary' => 'Edodon is a digital platform that connects readers with book authors through e-book subscriptions and microblogging services.'],
            ['name' => 'Jagojek, Jagoride, Jagocar, Jagofood, Jagosend, Jagopay', 'company' => 'Jagojek', 'date' => 'SEPTEMBER 2020', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Digital Infrastructure Support', 'company' => 'Kominfo', 'date' => 'SEPTEMBER 2016', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Psychologist Analysis Platform', 'company' => 'BIN', 'date' => 'SEPTEMBER 2015', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Inventory & Accounting System', 'company' => 'AHM', 'date' => 'SEPTEMBER 2020', 'is_featured' => 1, 'summary' => 'The project aimed to develop an Inventory Management System for a private company to automate and streamline their inventory management processes.'],
            ['name' => 'Cashier App', 'company' => 'Borma', 'date' => 'SEPTEMBER 2020', 'is_featured' => 1, 'summary' => 'Borma Retail Digitalization Platform project was created by Yada Ekidanta to modernize and streamline the operational ecosystem of Borma retail stores across Indonesia.'],
            ['name' => 'Employee Career Ladder System', 'company' => 'Kementerian Kelautan dan Perikanan', 'date' => 'JUNI 2018', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Company Profile', 'company' => 'PT Perkebunan Sumatera Utara', 'date' => 'SEPTEMBER 2019', 'is_featured' => 1, 'summary' => 'The project aimed to create a modern and informative website to reflect the company’s identity and improve its online presence. The website was designed to provide a user-friendly experience and to be accessible on all devices.'],
            ['name' => 'E-Office', 'company' => 'PT Perkebunan Sumatera Utara', 'date' => 'AGUSTUS 2021', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'E-Procurement', 'company' => 'PT Perkebunan Sumatera Utara', 'date' => 'SEPTEMBER 2021', 'is_featured' => 1, 'summary' => 'The project aimed to develop an E-Procurement Platform to streamline the procurement process of PT Perkebunan Sumatera Utara.'],
            ['name' => 'Ayo Toko', 'company' => 'PT HM- Sampoerna', 'date' => 'SEPTEMBER 2018', 'is_featured' => 1, 'summary' => 'AYO SRC – Toko is a mobile app developed by Yada Ekidanta to offer a hassle-free and efficient shopping experience for customers. '],
            ['name' => 'Ayo Cashier', 'company' => 'PT HM Sampoerna', 'date' => 'DESEMBER 2018', 'is_featured' => 1, 'summary' => 'AYO SRC Cashier project was created by Yada Ekidanta to transform the way small and medium-sized retailers in Indonesia run their business.'],
            ['name' => 'Healthcare System Support', 'company' => 'IDI', 'date' => 'SEPTEMBER 2016', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Reporting System', 'company' => 'BNPB', 'date' => 'JULI 2018', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Career Data Center', 'company' => 'ITENAS', 'date' => 'JUNI 2017', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Career Data Center', 'company' => 'UKRI', 'date' => 'OKTOBER 2017', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Company Profile', 'company' => 'UKRI', 'date' => 'SEPTEMBER 2020', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Music App Platform', 'company' => 'Overseas Clients', 'date' => '2019', 'is_featured' => 1, 'summary' => 'The Music App Platform project is a digital transformation initiative aimed at developing a user-friendly and intuitive music app for the company’s customers.'],
            ['name' => 'Creator Content Platform', 'company' => 'Overseas Clients', 'date' => '2019', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Accounting PT Persada', 'company' => 'PT Persada', 'date' => '2018', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Sistem Informasi Pemaketan Jasa Konstruksi', 'company' => 'Kementerian PUPR', 'date' => 'JANUARI 2017', 'is_featured' => 0, 'summary' => 'Description'],
            ['name' => 'Sistem Evaluasi Pelaksanaan Pengadaan Jasa Konstruksi', 'company' => 'Kementerian PUPR', 'date' => 'JULI 2017', 'is_featured' => 0, 'summary' => 'Description'],
        ];

        foreach ($projects as $p) {
            $company = null;
            $companyId = null;

            if (!empty($p['company'])) {
                $company = Company::where('name', $p['company'])->first();
                $companyId = $company?->id;
            }

            $startDate = $this->parseDate($p['date']); // string Y-m-d atau null
            $year = $startDate ? Carbon::parse($startDate)->year : null;

            // 1) category_id
            $categoryName = $this->guessCategoryName($p['name'], $p['company'] ?? null);
            $categoryId = $this->getOrCreateCategoryId($categoryName);

            // 2) code (deterministik & unique)
            $code = $this->makeProjectCode(
                projectName: $p['name'],
                companyName: $p['company'] ?? null,
                startDate: $startDate
            );

            // 3-8) konten otomatis
            $content = $this->buildProjectContent(
                projectName: $p['name'],
                companyName: $p['company'] ?? null,
                categoryName: $categoryName,
                startDate: $startDate,
                year: $year,
                providedSummary: $p['summary'] ?? null
            );

            // Idempotent: kalau seed ulang -> update field-fieldnya
            $project = Project::updateOrCreate(
                [
                    'name' => $p['name'],
                    'company_id' => $companyId,
                    'start_date' => $startDate,
                ],
                [
                    'ulid' => (string) Str::ulid(),
                    'code' => $code,
                    'category_id' => $categoryId,

                    'summary' => $content['summary'],
                    'description' => $content['description'],
                    'project_overview' => $content['project_overview'],
                    'business_solution' => $content['business_solution'],
                    'lesson_learned' => $content['lesson_learned'],
                    'benefit' => $content['benefit'],

                    'status' => 'completed',
                    'progress' => 100,
                    'is_featured' => (bool) ($p['is_featured'] ?? false),
                ]
            );

            // Gallery (hindari dobel saat seeding ulang)
            $totalImages = $project->is_featured ? 3 : 1;

            for ($i = 1; $i <= $totalImages; $i++) {
                ProjectGallery::firstOrCreate(
                    [
                        'project_id' => $project->id,
                        'sort_order' => $i,
                    ],
                    [
                        'file_path'   => "projects/{$project->id}/image{$i}.jpg",
                        'title'       => "Gambar {$i} untuk Project {$project->id}",
                        'description' => "Deskripsi gambar {$i} untuk project dengan ID {$project->id}",
                        'is_active'   => true,
                    ]
                );
            }
        }
    }

    private function getOrCreateCategoryId(string $name): int
    {
        $cat = ProjectCategory::firstOrCreate(
            ['name' => $name],
            ['description' => null, 'is_active' => true]
        );

        return $cat->id;
    }

    /**
     * Rule sederhana: keyword + deteksi instansi pemerintah.
     */
    private function guessCategoryName(string $projectName, ?string $companyName): string
    {
        $n = Str::lower($projectName);
        $c = Str::lower($companyName ?? '');

        $isGov = str_contains($c, 'kementerian')
            || str_contains($c, 'badan')
            || str_contains($c, 'kominfo')
            || str_contains($c, 'bnpb')
            || str_contains($c, 'bin')
            || str_contains($c, 'pusat intel')
            || str_contains($c, 'angkatan darat');

        // AI / ML
        if (str_contains($n, 'ai') || str_contains($n, 'machine') || str_contains($n, 'vision') || str_contains($n, 'counting')) {
            return 'AI / Machine Learning';
        }

        // Infra / Support
        if (str_contains($n, 'infrastructure') || str_contains($n, 'support')) {
            return 'Infrastructure / Support';
        }

        // Consultancy
        if (str_contains($n, 'consult') || str_contains($n, 'consultancy')) {
            return 'Consultancy Services';
        }

        // E-Commerce
        if (str_contains($n, 'e-commerce') || str_contains($n, 'marketplace') || str_contains($n, 'commerce')) {
            return 'E-Commerce';
        }

        // Mobile
        if (str_contains($n, 'mobile') || str_contains($n, 'apps') || str_contains($n, 'app')) {
            // kalau project memang "Cashier App" kadang mobile, tapi kalau gov juga bisa mobile.
            return 'Mobile Application';
        }

        // Company Profile / Website
        if (str_contains($n, 'company profile') || str_contains($n, 'website')) {
            return 'Website / Company Profile';
        }

        // Enterprise system keywords
        if (
            str_contains($n, 'inventory') ||
            str_contains($n, 'accounting') ||
            str_contains($n, 'procurement') ||
            str_contains($n, 'e-office') ||
            str_contains($n, 'cashier') ||
            str_contains($n, 'reporting') ||
            str_contains($n, 'data center') ||
            str_contains($n, 'calculation') ||
            str_contains($n, 'system')
        ) {
            return $isGov ? 'Government Information System' : 'Enterprise System (ERP/Accounting/Inventory)';
        }

        // Default
        return $isGov ? 'Government Information System' : 'Web Application / Platform';
    }

    /**
     * Code deterministik: PRJ-YYYY-XXXXXX (hash pendek, stabil)
     */
    private function makeProjectCode(string $projectName, ?string $companyName, ?string $startDate): string
    {
        $year = $startDate ? Carbon::parse($startDate)->year : '0000';
        $base = trim(($companyName ?? 'GENERAL') . '|' . $projectName . '|' . ($startDate ?? ''));
        $hash = strtoupper(substr(md5($base), 0, 6));

        return "PRJ-{$year}-{$hash}";
    }

    /**
     * Generate konten default yang lebih “bagus” dari placeholder "Description".
     */
    private function buildProjectContent(
        string $projectName,
        ?string $companyName,
        string $categoryName,
        ?string $startDate,
        ?int $year,
        ?string $providedSummary
    ): array {
        $client = $companyName ?: 'klien';
        $yr = $year ?: ($startDate ? Carbon::parse($startDate)->year : null);
        $when = $yr ? "pada {$yr}" : "pada periode proyek";
        $deliverable = $this->deliverableFromCategory($categoryName);

        $summaryClean = trim((string) $providedSummary);
        $isPlaceholder = $summaryClean === '' || Str::lower($summaryClean) === 'description';

        $summary = $isPlaceholder
            ? "Development of {$deliverable} for {$client} {$when} to improve process efficiency and service quality."
            : $summaryClean;


        $description = "The **{$projectName}** project is an initiative to develop {$deliverable} for **{$client}** {$when}. "
            . "The main focus of this project is to deliver a solution that is user-friendly, secure, and scalable for both operational and reporting needs.\n\n"
            . "The scope of work includes requirements analysis, UI/UX design, core feature development, testing, as well as deployment and documentation. "
            . "The solution is designed to be further expandable (scalable) and ready for integration with other systems when required.";


        $project_overview = "- **Objective:** to provide {$deliverable} that supports {$client}'s business processes.\n"
            . "- **Main scope:** requirement gathering, design, development, testing, deployment.\n"
            . "- **Deliverables:** core application/features, documentation, and operational guidelines.\n"
            . "- **Status:** completed.";


        $business_solution = "The business solutions delivered in this project include:\n"
            . "- Standardization of workflows and data to minimize input errors.\n"
            . "- Automation of previously manual processes to improve speed and efficiency.\n"
            . "- Access control mechanisms (roles/permissions) according to organizational needs.\n"
            . "- Reporting and dashboards to support monitoring and decision-making.";

        $lesson_learned = "Lessons learned from this project:\n"
            . "- Early alignment of stakeholder expectations helps accelerate execution.\n"
            . "- Clear scope definition reduces changes during the project lifecycle.\n"
            . "- Well-prepared documentation and handover speed up user adoption.\n"
            . "- Post-release monitoring helps improve stability and performance.";

        $benefit = "Benefits achieved:\n"
            . "- Faster and more transparent processes.\n"
            . "- More structured and easily traceable data.\n"
            . "- Reduced manual workload and lower risk of human error.\n"
            . "- Improved service quality and user experience.";


        return compact(
            'summary',
            'description',
            'project_overview',
            'business_solution',
            'lesson_learned',
            'benefit'
        );
    }

    private function deliverableFromCategory(string $categoryName): string
    {
        return match ($categoryName) {
            'Website / Company Profile' => 'website/company profile',
            'Mobile Application' => 'aplikasi mobile',
            'E-Commerce' => 'platform e-commerce',
            'Enterprise System (ERP/Accounting/Inventory)' => 'sistem enterprise',
            'Government Information System' => 'sistem informasi pemerintahan',
            'AI / Machine Learning' => 'solusi berbasis AI/ML',
            'Infrastructure / Support' => 'dukungan infrastruktur dan operasional TI',
            'Consultancy Services' => 'jasa konsultansi dan pendampingan',
            default => 'platform/aplikasi',
        };
    }

    private function parseDate($dateString): ?string
    {
        if (!$dateString) return null;

        $months = [
            'JANUARI' => 1,
            'FEBRUARI' => 2,
            'MARET' => 3,
            'APRIL' => 4,
            'MEI' => 5,
            'JUNI' => 6,
            'JULI' => 7,
            'JULY' => 7,
            'AGUSTUS' => 8,
            'SEPTEMBER' => 9,
            'OKTOBER' => 10,
            'NOVEMBER' => 11,
            'DESEMBER' => 12
        ];

        $parts = explode(' ', trim((string) $dateString));

        if (count($parts) === 2) {
            $monthName = strtoupper($parts[0]);
            $year = $parts[1];
            $month = $months[$monthName] ?? 1;
            return Carbon::create($year, $month, 1)->toDateString();
        }

        if (count($parts) === 1 && is_numeric($parts[0])) {
            return Carbon::create($parts[0], 1, 1)->toDateString();
        }

        return null;
    }
}