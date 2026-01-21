<?php

namespace Database\Seeders;

use App\Models\Support\TicketChannel;
use App\Models\Support\TicketGroup;
use App\Models\Support\TicketPriority;
use App\Models\Support\TicketType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupportSeeder extends Seeder
{
    public function run(): void
    {
        $channels = [
            [
                'name' => 'Email',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Facebook',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Instagram',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Phone',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'WhatsApp',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'X',
                'description' => '',
                'is_active' => true
            ],
        ];
        $groups = [
            [
                'name' => 'Client',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Internal',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Partner',
                'description' => '',
                'is_active' => true
            ]
        ];
        $priorities = [
            [
                'name' => 'Critical',
                'order' => 4,
                'is_default' => false
            ],
            [
                'name' => 'High',
                'order' => 3,
                'is_default' => false
            ],
            [
                'name' => 'Low',
                'order' => 1,
                'is_default' => false
            ],
            [
                'name' => 'Medium',
                'order' => 2,
                'is_default' => true
            ]
        ];
        $types = [
            [
                'name' => 'Bug',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Code',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Feature Request',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Incident',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Management',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Problem',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Question',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Sales',
                'description' => '',
                'is_active' => true
            ],
            [
                'name' => 'Suggestion',
                'description' => '',
                'is_active' => true
            ],
        ];

        foreach ($channels as $channel) {
            TicketChannel::firstOrCreate([
                'name' => $channel['name'],
                'description' => $channel['description'],
                'is_active' => $channel['is_active'],
            ]);
        }
        foreach ($groups as $group) {
            TicketGroup::firstOrCreate([
                'name' => $group['name'],
                'description' => $group['description'],
                'is_active' => $group['is_active'],
            ]);
        }
        foreach ($priorities as $priority) {
            TicketPriority::firstOrCreate([
                'name' => $priority['name'],
                'order' => $priority['order'],
                'is_default' => $priority['is_default'],
            ]);
        }
        foreach ($types as $type) {
            TicketType::firstOrCreate([
                'name' => $type['name'],
                'description' => $type['description'],
                'is_active' => $type['is_active'],
            ]);
        }
        $now = now();
        $policies = [
            [
                'name' => 'Standar (Default)',
                'description' => 'SLA standar untuk semua tiket umum. Berlaku jam kerja.',
                'first_response_time' => 4,   // jam
                'resolution_time' => 48,      // jam
                'apply_business_hours' => true,
                'business_start_time' => '09:00:00',
                'business_end_time' => '18:00:00',
                'is_default' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Prioritas Tinggi',
                'description' => 'Untuk isu berdampak signifikan (gangguan operasional). Berlaku jam kerja.',
                'first_response_time' => 1,
                'resolution_time' => 12,
                'apply_business_hours' => true,
                'business_start_time' => '09:00:00',
                'business_end_time' => '18:00:00',
                'is_default' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Kritis (24/7)',
                'description' => 'Untuk insiden kritis (down, data loss, keamanan). Tidak dibatasi jam kerja (24/7).',
                'first_response_time' => 1,
                'resolution_time' => 4,
                'apply_business_hours' => false,
                'business_start_time' => null,
                'business_end_time' => null,
                'is_default' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Rendah / Permintaan Fitur',
                'description' => 'Untuk pertanyaan umum, request minor, dan permintaan fitur. Berlaku jam kerja.',
                'first_response_time' => 24,
                'resolution_time' => 120,
                'apply_business_hours' => true,
                'business_start_time' => '09:00:00',
                'business_end_time' => '18:00:00',
                'is_default' => false,
                'is_active' => true,
            ],
        ];

        // Pastikan hanya ada 1 default
        // 1) Set semua non-default dulu
        foreach ($policies as $p) {
            if (!($p['is_default'] ?? false)) {
                DB::table('sla_policies')->updateOrInsert(
                    ['name' => $p['name']],
                    array_merge($p, ['updated_at' => $now, 'created_at' => $now])
                );
            }
        }

        // 2) Set default terakhir + matikan default lain
        $default = collect($policies)->firstWhere('is_default', true);
        if ($default) {
            DB::table('sla_policies')->update(['is_default' => false]);

            DB::table('sla_policies')->updateOrInsert(
                ['name' => $default['name']],
                array_merge($default, ['updated_at' => $now, 'created_at' => $now])
            );

            // Safety: pastikan yang lain bukan default
            DB::table('sla_policies')
                ->where('name', '!=', $default['name'])
                ->update(['is_default' => false, 'updated_at' => $now]);
        }

        // Parent categories
        $parents = [
            'getting-started' => [
                'name' => 'Getting Started',
                'description' => 'Panduan awal untuk mengenal sistem dan memulai penggunaan.',
                'icon' => 'heroicon-o-rocket-launch',
                'order' => 1,
                'is_active' => true,
            ],
            'account-billing' => [
                'name' => 'Akun & Billing',
                'description' => 'Pengaturan akun, keamanan, paket, dan pembayaran.',
                'icon' => 'heroicon-o-credit-card',
                'order' => 2,
                'is_active' => true,
            ],
            'product-guides' => [
                'name' => 'Panduan Produk',
                'description' => 'Panduan penggunaan fitur dan alur kerja dalam produk.',
                'icon' => 'heroicon-o-book-open',
                'order' => 3,
                'is_active' => true,
            ],
            'troubleshooting' => [
                'name' => 'Troubleshooting',
                'description' => 'Solusi kendala umum, error, dan langkah perbaikan.',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'order' => 4,
                'is_active' => true,
            ],
            'security-privacy' => [
                'name' => 'Keamanan & Privasi',
                'description' => 'Kebijakan privasi, keamanan akun, dan praktik terbaik.',
                'icon' => 'heroicon-o-shield-check',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        $categoryIds = [];

        foreach ($parents as $slug => $data) {
            $categoryIds[$slug] = DB::table('kb_categories')->insertGetId([
                'ulid'        => (string) Str::ulid(),
                'name'        => $data['name'],
                'slug'        => $slug,
                'description' => $data['description'],
                'icon'        => $data['icon'],
                'order'       => $data['order'],
                'parent_id'   => null,
                'is_active'   => $data['is_active'],
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }

        // Child categories
        $children = [
            'getting-started/overview' => [
                'parent' => 'getting-started',
                'name' => 'Ringkasan',
                'description' => 'Gambaran umum fitur, istilah, dan alur kerja utama.',
                'icon' => 'heroicon-o-sparkles',
                'order' => 1,
                'is_active' => true,
            ],
            'getting-started/faq' => [
                'parent' => 'getting-started',
                'name' => 'FAQ',
                'description' => 'Pertanyaan yang paling sering ditanyakan pengguna baru.',
                'icon' => 'heroicon-o-question-mark-circle',
                'order' => 2,
                'is_active' => true,
            ],
            'account-billing/security' => [
                'parent' => 'account-billing',
                'name' => 'Keamanan Akun',
                'description' => 'Reset password, 2FA, sesi login, dan keamanan akun.',
                'icon' => 'heroicon-o-lock-closed',
                'order' => 1,
                'is_active' => true,
            ],
            'account-billing/payments' => [
                'parent' => 'account-billing',
                'name' => 'Pembayaran',
                'description' => 'Metode pembayaran, invoice, dan status transaksi.',
                'icon' => 'heroicon-o-receipt-percent',
                'order' => 2,
                'is_active' => true,
            ],
            'product-guides/workflows' => [
                'parent' => 'product-guides',
                'name' => 'Workflow',
                'description' => 'Cara menyusun alur kerja untuk hasil yang konsisten.',
                'icon' => 'heroicon-o-arrows-right-left',
                'order' => 1,
                'is_active' => true,
            ],
            'product-guides/integrations' => [
                'parent' => 'product-guides',
                'name' => 'Integrasi',
                'description' => 'Menghubungkan layanan pihak ketiga dan API.',
                'icon' => 'heroicon-o-puzzle-piece',
                'order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($children as $slug => $data) {
            DB::table('kb_categories')->insert([
                'ulid'        => (string) Str::ulid(),
                'name'        => $data['name'],
                'slug'        => $slug,
                'description' => $data['description'],
                'icon'        => $data['icon'],
                'order'       => $data['order'],
                'parent_id'   => $categoryIds[$data['parent']],
                'is_active'   => $data['is_active'],
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
        // Ambil user id pertama untuk created_by/updated_by (boleh null)
        $userId = DB::table('users')->orderBy('id')->value('id');

        // Helper ambil category id by slug
        $catId = fn(string $slug) => DB::table('kb_categories')->where('slug', $slug)->value('id');

        $articles = [
            [
                'title' => 'Cara Memulai: Setup Awal dalam 5 Menit',
                'slug' => 'cara-memulai-setup-awal-5-menit',
                'excerpt' => 'Langkah cepat untuk login, melengkapi profil, dan menyiapkan pengaturan dasar.',
                'content' => '<h2>1) Login</h2><p>Masuk menggunakan email dan password Anda.</p>
<h2>2) Lengkapi Profil</h2><p>Tambahkan nama, foto, dan preferensi notifikasi.</p>
<h2>3) Pengaturan Dasar</h2><ul><li>Zona waktu</li><li>Bahasa</li><li>Notifikasi</li></ul>
<p>Setelah selesai, Anda siap menggunakan fitur utama.</p>',
                'category_slug' => 'getting-started/overview',
                'status' => 'published',
                'published_at' => $now->copy()->subDays(2),
            ],
            [
                'title' => 'Istilah Penting yang Perlu Anda Ketahui',
                'slug' => 'istilah-penting-knowledge-base',
                'excerpt' => 'Penjelasan istilah seperti kategori, artikel, status, dan publikasi.',
                'content' => '<p>Berikut beberapa istilah yang sering muncul:</p>
<ul>
  <li><strong>Kategori</strong>: pengelompokan artikel.</li>
  <li><strong>Artikel</strong>: konten panduan/solusi.</li>
  <li><strong>Status</strong>: draft atau published.</li>
  <li><strong>Published at</strong>: waktu artikel dipublikasikan.</li>
</ul>',
                'category_slug' => 'getting-started/overview',
                'status' => 'published',
                'published_at' => $now->copy()->subDays(1),
            ],
            [
                'title' => 'FAQ: Pertanyaan yang Sering Ditanyakan',
                'slug' => 'faq-pertanyaan-sering-ditanyakan',
                'excerpt' => 'Kumpulan jawaban untuk pertanyaan umum pengguna baru.',
                'content' => '<h2>Apakah saya bisa mengubah email?</h2><p>Bisa, melalui menu Pengaturan Akun.</p>
<h2>Apakah ada mode gelap?</h2><p>Jika fitur tersedia, Anda bisa mengaktifkan dari Pengaturan Tampilan.</p>
<h2>Bagaimana cara menghubungi dukungan?</h2><p>Gunakan menu Bantuan atau form kontak.</p>',
                'category_slug' => 'getting-started/faq',
                'status' => 'published',
                'published_at' => $now,
            ],
            [
                'title' => 'Reset Password dan Pemulihan Akun',
                'slug' => 'reset-password-dan-pemulihan-akun',
                'excerpt' => 'Panduan reset password, verifikasi email, dan pemulihan akun.',
                'content' => '<ol>
  <li>Buka halaman login</li>
  <li>Klik <em>Lupa Password</em></li>
  <li>Masukkan email terdaftar</li>
  <li>Cek inbox untuk tautan reset</li>
</ol>
<p>Jika tidak menerima email, cek folder spam atau pastikan alamat email benar.</p>',
                'category_slug' => 'account-billing/security',
                'status' => 'published',
                'published_at' => $now->copy()->subHours(10),
            ],
            [
                'title' => 'Mengaktifkan 2FA untuk Keamanan Akun',
                'slug' => 'mengaktifkan-2fa-keamanan-akun',
                'excerpt' => 'Aktifkan Two-Factor Authentication untuk perlindungan tambahan.',
                'content' => '<p>2FA menambahkan lapisan keamanan tambahan:</p>
<ul>
  <li>Masuk ke Pengaturan Akun</li>
  <li>Pilih Keamanan</li>
  <li>Aktifkan 2FA</li>
  <li>Scan QR dengan aplikasi authenticator</li>
</ul>
<p>Simpan recovery codes di tempat aman.</p>',
                'category_slug' => 'account-billing/security',
                'status' => 'published',
                'published_at' => $now->copy()->subHours(6),
            ],
            [
                'title' => 'Metode Pembayaran, Invoice, dan Status Tagihan',
                'slug' => 'metode-pembayaran-invoice-status-tagihan',
                'excerpt' => 'Cara menambah metode pembayaran, unduh invoice, dan memahami status tagihan.',
                'content' => '<h2>Menambah Metode Pembayaran</h2><p>Buka Billing lalu tambahkan kartu/transfer (sesuai yang tersedia).</p>
<h2>Invoice</h2><p>Unduh invoice dari halaman Billing &gt; Riwayat.</p>
<h2>Status Tagihan</h2><ul><li>Paid</li><li>Pending</li><li>Failed</li></ul>',
                'category_slug' => 'account-billing/payments',
                'status' => 'published',
                'published_at' => $now->copy()->subDays(3),
            ],
            [
                'title' => 'Menyusun Workflow yang Konsisten',
                'slug' => 'menyusun-workflow-yang-konsisten',
                'excerpt' => 'Kerangka kerja sederhana untuk menyusun alur agar hasil lebih konsisten.',
                'content' => '<p>Workflow yang baik biasanya punya:</p>
<ul>
  <li><strong>Tujuan</strong> yang jelas</li>
  <li><strong>Input</strong> yang rapi</li>
  <li><strong>Langkah</strong> terurut</li>
  <li><strong>Output</strong> terukur</li>
</ul>
<p>Mulai dari workflow paling kecil, lalu iterasi.</p>',
                'category_slug' => 'product-guides/workflows',
                'status' => 'draft',
                'published_at' => null,
            ],
            [
                'title' => 'Troubleshooting: Tidak Bisa Login (Langkah Cepat)',
                'slug' => 'troubleshooting-tidak-bisa-login-langkah-cepat',
                'excerpt' => 'Solusi cepat jika Anda mengalami kendala login.',
                'content' => '<ol>
  <li>Pastikan email dan password benar</li>
  <li>Coba reset password</li>
  <li>Cek koneksi internet</li>
  <li>Hapus cache browser</li>
  <li>Coba mode incognito</li>
</ol>
<p>Jika masih gagal, hubungi dukungan dengan menyertakan screenshot error.</p>',
                'category_slug' => 'troubleshooting',
                'status' => 'published',
                'published_at' => $now->copy()->subDays(5),
            ],
        ];

        foreach ($articles as $a) {
            DB::table('kb_articles')->insert([
                'ulid'            => (string) Str::ulid(),
                'title'           => $a['title'],
                'slug'            => $a['slug'],
                'excerpt'         => $a['excerpt'],
                'content'         => $a['content'],
                'category_id'     => $catId($a['category_slug']),
                'status'          => $a['status'],
                'published_at'    => $a['published_at'],
                'view_count'      => 0,
                'helpful_count'   => 0,
                'not_helpful_count' => 0,
                'created_by'      => $userId,
                'updated_by'      => $userId,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }
    }
}
