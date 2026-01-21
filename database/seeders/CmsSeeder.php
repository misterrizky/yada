<?php

namespace Database\Seeders;

use App\Models\CMS\Post;
use App\Models\CMS\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        $authorId = $author?->id;

        // Parent categories
        $parents = [
            'company_news' => [
                'name' => 'Berita Perusahaan',
                'description' => 'Update resmi perusahaan: pengumuman, pencapaian, dan rilis.',
                'sort_order' => 1,
            ],
            'products' => [
                'name' => 'Produk',
                'description' => 'Informasi produk: fitur, pembaruan, panduan, dan rilis.',
                'sort_order' => 2,
            ],
            'technology' => [
                'name' => 'Teknologi',
                'description' => 'Artikel teknologi, arsitektur, dan engineering insight.',
                'sort_order' => 3,
            ],
            'business' => [
                'name' => 'Bisnis & Strategi',
                'description' => 'Insight bisnis: strategi, pasar, dan pertumbuhan.',
                'sort_order' => 4,
            ],
            'career' => [
                'name' => 'Karier',
                'description' => 'Budaya kerja, rekrutmen, dan pengembangan talenta.',
                'sort_order' => 5,
            ],
            'event' => [
                'name' => 'Event',
                'description' => 'Kegiatan, webinar, konferensi, dan agenda komunitas.',
                'sort_order' => 6,
            ],
        ];

        $categoryIds = [];

        foreach ($parents as $key => $data) {
            $category = PostCategory::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'parent_id' => null,
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'sort_order' => $data['sort_order'],
                ]
            );
            $categoryIds[$key] = $category->id;
        }

        // Child categories
        $children = [
            'feature_release' => [
                'parent_key' => 'products',
                'name' => 'Rilis Fitur',
                'description' => 'Catatan rilis dan pembaruan fitur terbaru.',
                'sort_order' => 1,
            ],
            'tips_tutorial' => [
                'parent_key' => 'products',
                'name' => 'Tips & Tutorial',
                'description' => 'Panduan praktis untuk memaksimalkan penggunaan produk.',
                'sort_order' => 2,
            ],
            'security' => [
                'parent_key' => 'technology',
                'name' => 'Keamanan',
                'description' => 'Praktik terbaik, audit, dan peningkatan keamanan sistem.',
                'sort_order' => 1,
            ],
            'infrastructure' => [
                'parent_key' => 'technology',
                'name' => 'Infrastruktur',
                'description' => 'Topik cloud, deployment, observability, dan scaling.',
                'sort_order' => 2,
            ],
        ];

        foreach ($children as $key => $data) {
            $category = PostCategory::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'parent_id' => $categoryIds[$data['parent_key']],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'sort_order' => $data['sort_order'],
                ]
            );
            $categoryIds[$key] = $category->id;
        }

        $posts = [
            [
                'title' => 'Paparan Pengembangan Aplikasi Program Hibah Luar Negeri Tahap 1',
                'excerpt' => 'Paparan pengembangan Aplikasi Program Hibah Luar Negeri Tahap 1 membahas ruang lingkup pekerjaan, alur proses end-to-end, serta rencana implementasi untuk mempercepat pengajuan, verifikasi, monitoring, dan pelaporan hibah secara terstruktur dan transparan.',
                'content' => '
<p>
    Pada Jumat (17/12/2021) dilaksanakan paparan pengembangan Aplikasi Program Hibah Luar Negeri Tahap 1 sebagai bagian dari upaya peningkatan tata kelola administrasi hibah yang lebih efektif, terdokumentasi, dan mudah ditelusuri. Paparan ini menekankan pentingnya digitalisasi proses agar alur pengajuan hingga pelaporan hibah dapat berjalan lebih cepat, akurat, serta meminimalkan risiko kesalahan administratif.
</p>
<p>
    Tahap 1 berfokus pada penyusunan fondasi sistem yang mencakup pengelolaan master data, alur pengajuan, serta mekanisme verifikasi dan persetujuan berjenjang. Dengan pendekatan ini, setiap tahapan proses dapat dipantau statusnya secara real-time, termasuk riwayat perubahan (audit trail) untuk memastikan akuntabilitas.
</p>
<p>
    Secara garis besar, fitur yang menjadi cakupan Tahap 1 meliputi:
</p>
<ul>
    <li><strong>Manajemen Pengguna & Peran</strong>: pengaturan hak akses sesuai fungsi dan kewenangan.</li>
    <li><strong>Pengajuan Hibah</strong>: pengisian data, unggah dokumen persyaratan, serta validasi dasar.</li>
    <li><strong>Verifikasi Dokumen</strong>: pengecekan kelengkapan dan kesesuaian dokumen secara terstruktur.</li>
    <li><strong>Persetujuan Berjenjang</strong>: alur approval mengikuti SOP, termasuk catatan revisi dan komentar.</li>
    <li><strong>Monitoring & Dashboard</strong>: ringkasan status pengajuan, progres verifikasi, dan notifikasi tindak lanjut.</li>
    <li><strong>Pelaporan Awal</strong>: rekap data pengajuan dan status proses untuk kebutuhan evaluasi internal.</li>
</ul>
<p>
    Dari sisi teknis, paparan juga menyoroti penerapan standar keamanan data (pengelolaan akses, pencatatan aktivitas, dan kontrol dokumen), serta rancangan integrasi bertahap dengan sistem pendukung yang relevan apabila dibutuhkan pada fase berikutnya. Implementasi dilakukan secara modular agar mudah dikembangkan pada Tahap 2 dan seterusnya.
</p>
<p>
    Melalui Aplikasi Program Hibah Luar Negeri ini, diharapkan proses pengelolaan hibah menjadi lebih tertib, transparan, dan efisien—mulai dari pengajuan, verifikasi, persetujuan, hingga pelaporan. Tahap 1 menjadi dasar penting untuk memastikan sistem stabil, siap digunakan, dan dapat ditingkatkan sesuai kebutuhan operasional di masa mendatang.
</p>',
                'status' => 'published',
                'published_at' => '2021-12-17 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-hibah-luar-negeri-tahap-1.jpg',
                'seo_title' => 'Paparan Pengembangan Aplikasi Program Hibah Luar Negeri Tahap 1',
                'seo_description' => 'Ringkasan paparan pengembangan Aplikasi Program Hibah Luar Negeri Tahap 1: cakupan fitur pengajuan, verifikasi, approval berjenjang, monitoring, dan pelaporan awal untuk tata kelola hibah yang lebih transparan.',
                'canonical_url' => 'https://example.com/blog/paparan-pengembangan-aplikasi-program-hibah-luar-negeri-tahap-1',
                'meta' => [
                    'tags' => ['hibah luar negeri', 'aplikasi hibah', 'transformasi digital', 'governance', 'monitoring', 'pelaporan'],
                    'reading_time' => 5,
                    'event_date' => '2021-12-17',
                    'phase' => 'Tahap 1',
                    'scope' => [
                        'Manajemen pengguna & hak akses',
                        'Pengajuan hibah & unggah dokumen',
                        'Verifikasi dokumen',
                        'Approval berjenjang',
                        'Dashboard monitoring',
                        'Pelaporan awal',
                    ],
                    'notes' => [
                        'Tahap 1 difokuskan pada fondasi proses end-to-end dan kesiapan pengembangan fase berikutnya.',
                    ],
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Paparan Pengembangan Aplikasi eOffice Dukcapil Kementerian Dalam Negeri Republik Indonesia',
                'excerpt' => 'Paparan Kemendagri pada 27 Juli 2022 membahas pengembangan eOffice Dukcapil—aplikasi berbasis web untuk digitalisasi persuratan, data kependudukan, dan administrasi paperless yang lebih efisien.',
                'content' => "
<p>
    Beberapa waktu lalu, pada Rabu (27/07/2022) Kementerian Dalam Negeri (Kemendagri) mengadakan rapat penting terkait perkembangan transformasi layanan publik yang membantu kemudahan bagi para pegawai sipil, terutama dalam meningkatkan kualitas pelayanan bagi masyarakat yakni eOffice.
</p>
<p>
    Electronic Office (Eoffice) sendiri merupakan aplikasi berbasis website yang mendukung administrasi pengelolaan database  terkait persuratan baik surat dinas, data kepegawaian, data kependudukan, pencatatan sipil hingga dokumen yang bersifat rahasia sebelumnya dipindahkan ke bentuk kertas, sekarang dapat diakses melalui media digital. Semua penyimpanan, pengontrolan dokumen serta penerimaan surat masuk - surat keluar mulai dari rancangan/ konsep, persetujuan, penomoran hingga distribusi kepada penerima, dapat dilakukan secara digital.
</p>
<p>
    Peningkatan kualitas pelayanan ini tidak hanya akan dirasakan oleh pegawai sipil saja, tapi para pejabat pun dapat mengakses data seperti menerima dan menandatangani berbagai surat secara elektronik sampai memonitoring progress kinerja daerah.
</p>
<p>
    Pelaporan kerja pegawai daerah baik ASN maupun non-ASN juga akan diterapkan dalam aplikasi ini sesuai dengan Peraturan Menteri Dalam Negeri ( Permendagri ) nomor 53 tahun 2019 pasal 11 ayat 3 mengatakan 'pelaporan secara daring sebagaimana yang dimaksud dalam ayat 1 huruf b, dilakukan oleh SIAK' dan pasal 14 mengatakan bahwa 'pelaporan secara daring sebagaimana dimaksud dalam pasal 11 ayat 3 dilakukan oleh pemegang hak akses dengan cara mengakses menu laporan pada laman aplikasi SIAK'.
</p>
<p>
    Keuntungan lainnya dari pelayanan digital ini yaitu, setiap pegawai dalam kantor dapat berkomunikasi serta berkoordinasi terkait pekerjaan administratif internal kantor. Selain itu, eOffice ini juga memiliki fitur menganalisa terkait pegawai sipil yang akan naik jabatan dan yang akan pensiun berdasarkan hasil/ kriteria yang ditetapkan oleh pemerintah.
</p>
<p>
    Dan terakhir adalah mampu meningkatkan efisiensi kerja dengan konsep paperless karena dapat mengurangi anggaran sekitar Rp450 M /tahun untuk pengadaan pencetakan kertas security printing untuk dokumen kependudukan yang diganti jadi dokumen elektronik. Konsep paperless sudah menjadi kebiasaan baru karena selain dapat meningkatkan citra suatu instansi, pohon - pohon sekarang tidak akan ditebang lagi untuk memproduksi kertas.
</p>
<p>
    Dari keuntungan transformasi layanan baru ini diharapkan kini dapat meningkatkan kualitas kinerja setiap pegawai maupun pemimpin dalam membantu serta memudahkan kebutuhan masyarakat akan pelayanan yang lebih mumpuni dan profesional.
</p>",
                'status' => 'published',
                'published_at' => '2022-07-27 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-eoffice-dukcapil-kemendagri.jpg',
                'seo_title' => 'Paparan Pengembangan Aplikasi eOffice Dukcapil Kemendagri',
                'seo_description' => 'Kemendagri memaparkan pengembangan eOffice Dukcapil untuk digitalisasi persuratan dan dokumen kependudukan secara paperless—lebih cepat, aman, dan efisien.',
                'canonical_url' => 'https://example.com/blog/paparan-pengembangan-aplikasi-eoffice-dukcapil-kementerian-dalam-negeri-republik-indonesia',
                'meta' => [
                    'tags' => ['eoffice', 'dukcapil', 'kemendagri', 'transformasi digital', 'paperless', 'siak'],
                    'reading_time' => 7,
                    'event_date' => '2022-07-27',
                    'institutions' => ['Kementerian Dalam Negeri', 'Dukcapil'],
                    'references' => [
                        'Permendagri 53/2019 Pasal 11 ayat (3)',
                        'Permendagri 53/2019 Pasal 14',
                    ],
                    'highlights' => [
                        'Digitalisasi persuratan & dokumen kependudukan',
                        'Tanda tangan elektronik & monitoring kinerja',
                        'Efisiensi paperless (security printing) ~Rp450 M/tahun',
                    ],
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Kementerian Pertahanan Gelar Indo Defence 2022 Expo & Forum, Pameran Industri Pertahanan Bertaraf Internasional',
                'excerpt' => 'Kementerian Pertahanan menggelar Indo Defence 2022 Expo & Forum pada 2–5 November 2022 di JIExpo Kemayoran. Event bertema “Peace, Prosperity, Strong Defence” ini menghadirkan ratusan industri pertahanan dari puluhan negara serta display pesawat dan kapal perang sebagai kegiatan pendukung.',
                'content' => '
<p>
    Kementerian Pertahanan akan menggelar pameran industri pertahanan bertaraf internasional, Indo Defence 2022 Expo & Forum pada Rabu (2/11/2022) sampai Sabtu (5/11/2022).
    Pameran bertajuk “Peace, Prosperity, Strong Defence” itu merupakan event internasional yang memamerkan industri pertahanan tiga mantra.
    Untuk acara utama berupa pameran internasional akan dilaksanakan pada Rabu (2/11/2022) sampai Sabtu (5/11/2022) di JIExpo Kemayoran, Jakarta.
    Pameran tersebut dibagi dalam dua sesi pengunjung. Pada Rabu (2/11/2022) sampai Jumat (4/11/2022), acara hanya melayani pengunjung terbatas dan profesional. Pengunjung umum bisa datang JIExpo Kemayoran pada Sabtu (5/11/2022) dengan membayar biaya masuk Rp 50.000 per orang.
    Selain acara utama, ada juga kegiatan pendukung yang dilaksanakan pada Kamis (3/11/2022) sampai Jumat (4/11/2022) dengan dua kategori pameran.
</p>
<p>
    Pameran pertama adalah Aircraft Display berlokasi di Pangkalan Angkatan Udara (Lanud) Halim Perdanakusuma. Pameran kedua adalah Naval Ship Display yang akan dipamerkan di Dermaga Penyeberangan TNI AL Pondok Dayung.
    Kedua kegiatan pendukung ini melayani pengunjung umum dan tamu undangan. Khusus untuk pengunjung umum berlaku syarat dan ketentuan. Registrasi dan shuttle bus hanya tersedia di JIExpo Kemayoran.
    Pameran industri pertahanan internasional yang digelar dua tahun sekali ini nantinya akan melibatkan lebih dari 900 industri dari 57 negara.
    Kementerian Pertahanan mengungkapkan, sejauh ini sudah ada 903 industri yang dikonfirmasi akan mengikuti gelaran akbar tersebut.
</p>
<p>
    Indonesia sendiri memiliki industri pertahanan sebanyak 207 industri. Dari jumlah ini, sekitar 151 industri sudah dikonfirmasi untuk mengikuti kegiatan Indo Defence 2022 Expo & Forum.
    Adapun produk yang akan ditampilkan pada pameran tersebut, di antaranya berbagai jenis alat utama sistem senjata (alutsista) terbaru, seperti persenjataan ringan dan berat, kendaraan tempur, pesawat terbang, kapal perang serta peralatan atau komponen persenjataan lainnya.
    Merasa tertarik untuk melihat Indo Defence 2022 Expo & Forum? Sebelum mengikuti acara ini, pastikan Anda mendaftar terlebih dahulu melalui link https://visitorreg.id/q/IDD22.
    Untuk informasi lebih lanjut mengenai Indo Defence 2022 Expo & Forum, Anda bisa menuju ke laman www.indodefence.com, www.indoaerospace.com, atau www.indomarine.co.
</p>
<p>
    Pada kesempatan terpisah, Direktur Jenderal (Dirjen) Potensi Pertahanan (Pothan) Kementerian Pertahanan Mayor Jenderal (Mayjen) TNI Dadang Hendrayudha berharap, pameran tersebut bisa mengenalkan sekaligus menjual banyak produk dari industri dalam negeri.
    Dengan begitu, kata dia, industri dalam negeri terutama di sektor industri pertahanan bisa maju dan berkembang.
    “Kementerian Pertahanan melalui Direktorat Jenderal (Ditjen) Pothan memiliki tugas untuk membina dan mengembangkan industri pertahanan,” ujar Dadang pada acara podcast Kementerian Pertahanan beberapa waktu lalu.
</p>
<p>
    Kegiatan promosi industri, menurutnya, menjadi salah satu upaya untuk mengembangkan industri pertahanan yang dimiliki Indonesia.
    Dadang menjelaskan, tantangan terbesar bagi industri dalam negeri untuk dapat berkembang hingga go international adalah meningkatkan kemampuan dari segi sumber daya manusia (SDM), teknologi, serta kondisi finansial yang sehat.
    “Pemerintah selaku regulator telah menerbitkan kebijakan yang mendukung pengembangan industri pertahanan, seperti Undang-undang (UU) Nomor 16 tahun 2012 serta UU Cipta Kerja,” ujarnya.
</p>
<h3 class="qrt-mb-20">Peluang bagi Indonesia</h3>
<p>
    Pada kesempatan tersebut, Dadang menjelaskan bahwa kegiatan Indo Defence 2022 Expo & Forum merupakan salah satu upaya pihaknya untuk meningkatkan kemampuan industri pertahanan melalui kegiatan promosi produk dan jasa alat peralatan pertahanan dan keamanan (alpalhankam).
</p>
<p class="">
    “Peluang untuk meningkatkan ekspor produk industri pertahanan cukup besar.
    Terlebih, beberapa produk alutsista kami sudah ada yang digunakan negara luar, seperti kapal laut kelas landing platform dock (LPD), pesawat angkut, dan senjata ringan,” jelasnya.
    Dadang berharap penyelenggaraan kegiatan dapat berjalan dengan baik, meski saat ini terdapat konflik Rusia-Ukraina dan China-Taiwan.
    Ia menilai, konflik Rusia-Ukraina serta China-Taiwan akan berpengaruh terhadap lingkungan global, termasuk penyelenggaraan berbagai internasional, seperti Indo Defence. Lebih lanjut, ia mengatakan bahwa kegiatan Indo Defence 2022 Expo & Forum tidak hanya berupa pameran forum dan pertemuan pameran alutsista semata.
</p>
<p class="">
    “Dari acara ini sangat memungkinkan adanya komunikasi, kerja sama dan bahkan transaksi secara business to business (B2B) maupun government to government (G2G) terkait dengan produk alutsista,” ucap Dadang.
    Ia mengungkapkan, Kementerian Pertahanan nantinya akan melakukan pembelian alutsista sesuai dengan rencana strategis (renstra) yang telah ditetapkan dan alokasi anggaran yang tersedia.
</p>',
                'status' => 'published',
                'published_at' => '2022-11-02 00:00:00',
                'featured_image' => 'https://example.com/images/posts/indo-defence-2022-expo-forum.jpg',
                'seo_title' => 'Indo Defence 2022 Expo & Forum: Jadwal, Lokasi, dan Informasi Pengunjung',
                'seo_description' => 'Indo Defence 2022 Expo & Forum digelar 2–5 November 2022 di JIExpo Kemayoran. Simak jadwal, pembagian sesi pengunjung, kegiatan pendukung (Aircraft & Naval Ship Display), serta info registrasi.',
                'canonical_url' => 'https://example.com/blog/kementerian-pertahanan-gelar-indo-defence-2022-expo-forum-pameran-industri-pertahanan-bertaraf-internasional',
                'meta' => [
                    'tags' => ['indo defence', 'kementerian pertahanan', 'pameran', 'industri pertahanan', 'alutsista', 'jieexpo kemayoran'],
                    'reading_time' => 6,
                    'event' => [
                        'name' => 'Indo Defence 2022 Expo & Forum',
                        'theme' => 'Peace, Prosperity, Strong Defence',
                        'main_event_location' => 'JIExpo Kemayoran, Jakarta',
                        'main_event_dates' => ['2022-11-02', '2022-11-05'],
                        'supporting_events' => [
                            [
                                'name' => 'Aircraft Display',
                                'location' => 'Lanud Halim Perdanakusuma',
                                'dates' => ['2022-11-03', '2022-11-04'],
                            ],
                            [
                                'name' => 'Naval Ship Display',
                                'location' => 'Dermaga Penyeberangan TNI AL Pondok Dayung',
                                'dates' => ['2022-11-03', '2022-11-04'],
                            ],
                        ],
                        'visitor_info' => [
                            'professional_days' => ['2022-11-02', '2022-11-04'],
                            'public_day' => '2022-11-05',
                            'ticket_price_public' => 50000,
                            'registration' => 'https://visitorreg.id/q/IDD22',
                            'official_sites' => [
                                'https://www.indodefence.com',
                                'https://www.indoaerospace.com',
                                'https://www.indomarine.co',
                            ],
                        ],
                        'participation' => [
                            'countries' => 57,
                            'industries_confirmed' => 903,
                            'indonesia_industries_total' => 207,
                            'indonesia_industries_confirmed' => 151,
                        ],
                    ],
                    'source_notes' => [
                        'Informasi jadwal dan pembagian sesi pengunjung disajikan sebagaimana tercantum pada konten artikel.',
                    ],
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Paparan Pengembangan Aplikasi Penduduk Non Permanen Dukcapil Kementerian Dalam Negeri Republik Indonesia',
                'excerpt' => 'Paparan pengembangan Aplikasi Penduduk Non Permanen Dukcapil Kemendagri membahas digitalisasi pendataan dan monitoring mobilitas penduduk non permanen agar pelaporan lebih rapi, terukur, dan mendukung layanan administrasi kependudukan yang cepat serta akurat.',
                'content' => '
<p>
    Pada Rabu (14/09/2022) diselenggarakan paparan pengembangan Aplikasi Penduduk Non Permanen oleh Dukcapil Kementerian Dalam Negeri Republik Indonesia. Kegiatan ini merupakan bagian dari upaya penguatan transformasi layanan administrasi kependudukan melalui digitalisasi proses pendataan, verifikasi, dan pelaporan penduduk non permanen secara lebih terstruktur.
</p>
<p>
    Aplikasi Penduduk Non Permanen dirancang untuk membantu perangkat daerah dan petugas terkait dalam melakukan pencatatan penduduk yang berdomisili sementara di suatu wilayah, termasuk pengelolaan data identitas, alamat tinggal, periode tinggal, serta informasi pendukung sesuai ketentuan yang berlaku. Dengan sistem berbasis digital, proses administrasi diharapkan menjadi lebih efisien, mudah ditelusuri, dan meminimalkan duplikasi data.
</p>
<p>
    Ruang lingkup pengembangan yang dipaparkan mencakup:
</p>
<ul>
    <li><strong>Manajemen Data</strong>: pencatatan data penduduk non permanen, validasi data dasar, dan pengelolaan master wilayah.</li>
    <li><strong>Registrasi & Verifikasi</strong>: alur input data dan kelengkapan dokumen, termasuk pencatatan status verifikasi.</li>
    <li><strong>Monitoring & Dashboard</strong>: ringkasan data per wilayah, tren mobilitas, serta indikator untuk kebutuhan pengawasan.</li>
    <li><strong>Pelaporan</strong>: rekap pelaporan periodik dan ekspor data untuk kebutuhan internal.</li>
    <li><strong>Audit Trail</strong>: pencatatan aktivitas perubahan data untuk memastikan akuntabilitas.</li>
</ul>
<p>
    Dari sisi operasional, aplikasi ini diarahkan agar mendukung koordinasi lintas unit kerja melalui notifikasi dan status proses yang jelas. Selain itu, aspek keamanan data menjadi perhatian utama, termasuk pengaturan hak akses berbasis peran, pengendalian dokumen, serta penerapan standar praktik baik dalam pengelolaan data kependudukan.
</p>
<p>
    Melalui pengembangan Aplikasi Penduduk Non Permanen ini, diharapkan proses pendataan menjadi lebih cepat, akurat, dan transparan sehingga dapat membantu perencanaan layanan publik, pengambilan keputusan berbasis data, serta peningkatan kualitas pelayanan administrasi kependudukan di daerah.
</p>',
                'status' => 'published',
                'published_at' => '2022-09-14 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-penduduk-non-permanen-dukcapil.jpg',
                'seo_title' => 'Paparan Pengembangan Aplikasi Penduduk Non Permanen Dukcapil Kemendagri',
                'seo_description' => 'Ringkasan paparan pengembangan Aplikasi Penduduk Non Permanen Dukcapil Kemendagri: digitalisasi pendataan, verifikasi, monitoring, dashboard, dan pelaporan untuk layanan kependudukan yang lebih efisien.',
                'canonical_url' => 'https://example.com/blog/paparan-pengembangan-aplikasi-penduduk-non-permanen-dukcapil-kementerian-dalam-negeri-republik-indonesia',
                'meta' => [
                    'tags' => ['dukcapil', 'kemendagri', 'penduduk non permanen', 'administrasi kependudukan', 'transformasi digital', 'monitoring'],
                    'reading_time' => 5,
                    'event_date' => '2022-09-14',
                    'institution' => 'Dukcapil Kementerian Dalam Negeri Republik Indonesia',
                    'highlights' => [
                        'Pendataan & validasi penduduk non permanen',
                        'Verifikasi dan status proses terstruktur',
                        'Dashboard monitoring dan pelaporan periodik',
                        'Audit trail untuk akuntabilitas',
                    ],
                    'features_scope' => [
                        'Manajemen data & master wilayah',
                        'Registrasi & verifikasi',
                        'Monitoring & dashboard',
                        'Pelaporan & ekspor data',
                        'Kontrol akses berbasis peran',
                    ],
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Pengumuman: Pembukaan Kantor Cabang Surabaya',
                'excerpt' => 'Kami memperluas jangkauan layanan dengan membuka kantor cabang Surabaya untuk mempercepat respons dan pendampingan pelanggan di Jawa Timur.',
                'content' => '<p>Mulai Januari 2026, kami resmi membuka kantor cabang Surabaya. Keputusan ini lahir dari dua hal: meningkatnya kebutuhan pendampingan di Jawa Timur dan komitmen kami untuk menghadirkan layanan yang lebih dekat, cepat, dan konsisten.</p>
<p>Dengan kehadiran tim lokal, pelanggan tidak perlu menunggu jadwal kunjungan dari kota lain untuk sesi onboarding, workshop, atau diskusi optimasi proses. Tujuan utamanya sederhana: mengurangi friksi, mempercepat adopsi, dan memastikan implementasi berjalan rapi sejak hari pertama.</p>
<h3>Fokus layanan di cabang Surabaya</h3>
<ul><li><strong>Onboarding terstruktur</strong>: konfigurasi awal, pemetaan role, dan penyesuaian template sesuai SOP internal</li><li><strong>Pendampingan implementasi</strong>: review alur approval, notifikasi, dan integrasi dasar bila diperlukan</li><li><strong>Dukungan operasional</strong>: penanganan isu harian, pelatihan admin, dan evaluasi bulanan</li><li><strong>Workshop perbaikan proses</strong>: identifikasi bottleneck dan rekomendasi peningkatan berbasis data</li></ul>
<h3>Apa dampaknya untuk pelanggan</h3>
<p>Kami menargetkan respons lebih cepat untuk kebutuhan yang sifatnya time-sensitive, seperti perubahan konfigurasi yang memblokir proses atau kebutuhan pelatihan saat ada pergantian admin. Selain itu, tim lokal membantu memastikan dokumentasi internal pelanggan tetap konsisten dan mudah diaudit.</p>
<h3>Langkah berikutnya</h3>
<ol><li>Jika Anda berada di wilayah Jawa Timur, tim kami akan menghubungi untuk jadwal perkenalan dan pemetaan kebutuhan.</li><li>Untuk pelanggan baru, onboarding dapat dijadwalkan lebih fleksibel (online atau on-site).</li><li>Untuk pelanggan existing, kami menyiapkan sesi audit konfigurasi ringan untuk memastikan setup tetap selaras dengan SOP terbaru.</li></ol>
<h3>Kontak dan jadwal</h3>
<p>Silakan hubungi tim dukungan untuk penjadwalan sesi. Kami juga akan mengumumkan rangkaian workshop bulanan yang bisa diikuti gratis oleh admin pelanggan.</p>
<p>Terima kasih atas kepercayaan Anda. Kami tumbuh bersama kebutuhan Anda, dan Surabaya adalah langkah penting untuk memperkuat layanan yang lebih dekat dan berdampak.</p>',
                'status' => 'published',
                'published_at' => '2026-01-10 09:00:00',
                'featured_image' => 'https://example.com/images/posts/cn-cabang-surabaya.jpg',
                'seo_title' => 'Pengumuman: Pembukaan Kantor Cabang Surabaya',
                'seo_description' => 'Kami membuka kantor cabang Surabaya untuk mempercepat layanan, onboarding, dan pendampingan pelanggan di Jawa Timur.',
                'canonical_url' => 'https://example.com/blog/pengumuman-pembukaan-kantor-cabang-surabaya',
                'meta' => [
                    'tags' => [
                        'pengumuman',
                        'ekspansi',
                        'layanan pelanggan',
                        'surabaya',
                        'onboarding'
                    ],
                    'reading_time' => 9
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Laporan Kinerja 2025: Stabilitas Naik, Respons Lebih Cepat',
                'excerpt' => 'Sepanjang 2025 kami meningkatkan stabilitas sistem dan mempercepat waktu respons dukungan melalui pembaruan proses dan tooling.',
                'content' => '<p>Tahun 2025 adalah tahun konsolidasi: kami merapikan fondasi stabilitas layanan dan membangun kebiasaan operasional yang lebih disiplin. Fokusnya bukan sekadar menambah fitur, melainkan memastikan apa yang sudah ada berjalan lebih andal, terukur, dan mudah dipantau.</p>
<h3>Ringkasan capaian utama</h3>
<ul><li><strong>Peningkatan monitoring</strong>: alert lebih presisi, mengurangi notifikasi yang tidak actionable</li><li><strong>Perbaikan incident response</strong>: jalur eskalasi lebih jelas, triase lebih cepat, dan dokumentasi postmortem lebih konsisten</li><li><strong>Standarisasi SOP dukungan</strong>: pola penanganan kasus berulang dibakukan agar resolusi lebih cepat</li><li><strong>Perbaikan performa</strong>: optimasi query di titik kritikal dashboard dan laporan periodik</li></ul>
<h3>Apa yang berubah di cara kami bekerja</h3>
<p>Kami menerapkan kebiasaan rutin yang sederhana tetapi berdampak: review mingguan metrik layanan, pembaruan runbook, dan penetapan prioritas perbaikan yang berbasis data. Dengan cara ini, masalah yang tadinya muncul berulang dapat ditangani dari akar penyebab, bukan sekadar tambal sulam.</p>
<h3>Pelajaran penting dari 2025</h3>
<ul><li>Alert yang baik harus menjawab: apa yang rusak, seberapa parah, dan apa langkah pertama untuk mitigasi.</li><li>Dokumentasi incident membantu tim baru melakukan debugging lebih cepat dan mengurangi ketergantungan pada individu tertentu.</li><li>Performa dashboard sering menjadi indikator awal adanya masalah di query atau indeks, sehingga perlu dipantau rutin.</li></ul>
<h3>Rencana fokus 2026</h3>
<ol><li>Memperluas automasi: dari triase awal hingga rekomendasi tindakan mitigasi yang lebih cepat.</li><li>Meningkatkan transparansi: pembaruan halaman status dan komunikasi insiden yang lebih rapi.</li><li>Memperdalam keamanan: penguatan kontrol akses, audit trail, dan praktik rotasi kredensial.</li></ol>
<p>Kami akan terus menyampaikan pembaruan secara berkala agar pelanggan bisa mengikuti perkembangan perbaikan layanan dan memahami langkah-langkah yang kami ambil untuk menjaga reliabilitas.</p>',
                'status' => 'published',
                'published_at' => '2026-01-12 11:30:00',
                'featured_image' => 'https://example.com/images/posts/cn-laporan-2025.jpg',
                'seo_title' => 'Laporan Kinerja 2025: Stabilitas Naik, Respons Lebih Cepat',
                'seo_description' => 'Ringkasan capaian 2025: peningkatan stabilitas, monitoring, dan proses dukungan untuk respons lebih cepat.',
                'canonical_url' => 'https://example.com/blog/laporan-kinerja-2025-stabilitas-naik-respons-lebih-cepat',
                'meta' => [
                    'tags' => [
                        'laporan',
                        'kinerja',
                        'stabilitas',
                        'support',
                        'operational excellence'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Program CSR: Pelatihan Literasi Digital untuk Komunitas',
                'excerpt' => 'Kami menjalankan program CSR literasi digital untuk membantu komunitas meningkatkan produktivitas dan keamanan saat menggunakan layanan online.',
                'content' => '<p>Akses digital yang semakin luas membawa dua sisi: peluang produktivitas dan risiko keamanan. Lewat program CSR, kami mengadakan pelatihan literasi digital untuk komunitas lokal agar penggunaan teknologi menjadi lebih aman dan bermanfaat.</p>
<h3>Mengapa literasi digital penting</h3>
<p>Banyak insiden keamanan bermula dari hal sederhana seperti tautan palsu, penggunaan kata sandi yang lemah, atau kebiasaan berbagi data tanpa sadar. Di sisi lain, banyak orang belum memanfaatkan alat digital untuk menghemat waktu, merapikan dokumen, dan meningkatkan kolaborasi.</p>
<h3>Materi yang dibahas</h3>
<ul><li><strong>Keamanan dasar</strong>: mengenali phishing, menghindari tautan berbahaya, dan cara memeriksa sumber informasi</li><li><strong>Password & MFA</strong>: membuat password kuat, pengelola kata sandi, serta penggunaan multi-factor authentication</li><li><strong>Produktivitas</strong>: manajemen dokumen, penamaan file, versi dokumen, dan praktik paperless</li><li><strong>Privasi</strong>: data apa yang sebaiknya tidak dibagikan, serta pengaturan privasi di aplikasi umum</li></ul>
<h3>Format pelatihan</h3>
<p>Pelatihan dikemas dalam sesi singkat, praktik langsung, dan studi kasus. Peserta diajak mencoba: mengaktifkan MFA, menyusun struktur folder, serta mengenali pola pesan penipuan yang sering muncul.</p>
<h3>Dampak yang diharapkan</h3>
<ul><li>Komunitas memiliki kebiasaan digital yang lebih aman dan sadar risiko.</li><li>Produktivitas meningkat karena dokumen lebih rapi dan mudah ditemukan.</li><li>Terbentuk jejaring belajar: peserta saling berbagi praktik baik setelah pelatihan.</li></ul>
<p>Kami percaya kontribusi terbaik adalah yang berkelanjutan. Karena itu, program ini akan diteruskan secara periodik dan materi akan diperbarui mengikuti pola risiko terbaru di lapangan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-15 15:00:00',
                'featured_image' => 'https://example.com/images/posts/cn-csr-literasi-digital.jpg',
                'seo_title' => 'Program CSR: Pelatihan Literasi Digital untuk Komunitas',
                'seo_description' => 'Program CSR literasi digital: keamanan online, produktivitas, dan praktik paperless untuk komunitas.',
                'canonical_url' => 'https://example.com/blog/program-csr-pelatihan-literasi-digital-untuk-komunitas',
                'meta' => [
                    'tags' => [
                        'csr',
                        'literasi digital',
                        'komunitas',
                        'keamanan',
                        'produktifitas'
                    ],
                    'reading_time' => 9
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Mengenal Paket Produk: Basic, Pro, dan Enterprise',
                'excerpt' => 'Panduan singkat memilih paket produk berdasarkan kebutuhan tim, skala penggunaan, dan kebutuhan kontrol akses.',
                'content' => '<p>Memilih paket yang tepat membuat implementasi lebih mulus dan biaya lebih efisien. Di bawah ini adalah panduan praktis untuk memahami perbedaan Basic, Pro, dan Enterprise, serta kapan sebaiknya Anda upgrade.</p>
<h3>Gambaran singkat setiap paket</h3>
<ul><li><strong>Basic</strong>: fitur inti untuk memulai dan membentuk kebiasaan kerja yang rapi</li><li><strong>Pro</strong>: automasi, integrasi, dan analitik lebih dalam untuk tim yang mulai bertumbuh</li><li><strong>Enterprise</strong>: kontrol, audit, dan dukungan implementasi untuk organisasi dengan governance ketat</li></ul>
<h3>Cara memilih paket berdasarkan kebutuhan</h3>
<h4>1) Ukuran tim dan kompleksitas proses</h4>
<p>Jika tim Anda masih kecil dan proses relatif sederhana, Basic biasanya cukup. Ketika jumlah approval bertambah, banyak unit terlibat, atau dokumen sering bolak-balik revisi, paket Pro akan terasa manfaatnya karena automasi dan pelaporan lebih kuat.</p>
<h4>2) Kontrol akses dan kepatuhan</h4>
<p>Organisasi yang membutuhkan audit trail, kebijakan akses granular, serta kebutuhan compliance biasanya lebih cocok dengan Enterprise. Paket ini membantu memastikan setiap perubahan dapat ditelusuri dan akses tidak melampaui wewenang.</p>
<h4>3) Kebutuhan laporan dan insight</h4>
<p>Jika Anda butuh laporan rutin untuk manajemen atau perlu memantau bottleneck, Pro dan Enterprise menawarkan opsi dashboard serta ekspor data yang lebih lengkap.</p>
<h3>Contoh skenario</h3>
<ul><li><strong>Basic</strong>: tim 5–20 orang, proses belum banyak variasi, ingin mulai paperless.</li><li><strong>Pro</strong>: tim 20–200 orang, banyak jenis permintaan, butuh integrasi notifikasi dan laporan.</li><li><strong>Enterprise</strong>: lintas divisi, kebijakan akses ketat, audit berkala, butuh SLA dan pendampingan implementasi.</li></ul>
<h3>Tips implementasi agar tidak salah langkah</h3>
<ol><li>Mulai dari proses paling sering digunakan agar adopsi cepat terlihat hasilnya.</li><li>Tetapkan pemilik proses dan admin yang bertanggung jawab atas template dan role.</li><li>Kumpulkan feedback 2–4 minggu pertama, lalu rapikan konfigurasi.</li><li>Upgrade paket saat kebutuhan benar-benar muncul, bukan sekadar karena ingin fitur.</li></ol>
<p>Jika Anda ingin, tim kami dapat membantu melakukan assessment singkat untuk memetakan kebutuhan dan merekomendasikan paket yang paling efisien.</p>',
                'status' => 'published',
                'published_at' => '2026-01-08 10:00:00',
                'featured_image' => 'https://example.com/images/posts/pd-paket-produk.jpg',
                'seo_title' => 'Mengenal Paket Produk: Basic, Pro, dan Enterprise',
                'seo_description' => 'Panduan memilih paket Basic, Pro, atau Enterprise berdasarkan skala tim, kontrol akses, dan kebutuhan laporan.',
                'canonical_url' => 'https://example.com/blog/mengenal-paket-produk-basic-pro-dan-enterprise',
                'meta' => [
                    'tags' => [
                        'produk',
                        'pricing',
                        'paket',
                        'enterprise',
                        'onboarding'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'products',
            ],
            [
                'title' => 'Produk: Integrasi API untuk Otomasi Alur Kerja',
                'excerpt' => 'Integrasikan produk dengan sistem lain melalui API untuk mempercepat approval, sinkronisasi data, dan notifikasi.',
                'content' => '<p>Integrasi API memungkinkan produk Anda terhubung dengan sistem lain seperti ERP, CRM, HRIS, atau portal internal. Hasilnya: alur kerja lebih otomatis, data lebih konsisten, dan tim tidak perlu memasukkan informasi yang sama berulang-ulang.</p>
<h3>Kapan API paling berguna</h3>
<ul><li>Saat Anda ingin <strong>mengurangi input manual</strong> dan risiko salah ketik.</li><li>Saat Anda membutuhkan <strong>sinkronisasi data master</strong> (unit, departemen, pengguna).</li><li>Saat Anda ingin <strong>notifikasi</strong> masuk ke sistem lain (chat internal, email gateway, tiket helpdesk).</li></ul>
<h3>Use case yang sering dipakai</h3>
<ul><li><strong>Auto-create request</strong> dari sistem internal (misalnya permintaan dari portal karyawan).</li><li><strong>Auto-approval</strong> untuk kasus tertentu berdasarkan aturan (misalnya nilai di bawah ambang batas).</li><li><strong>Webhook notifikasi</strong> saat status berubah, untuk memicu automasi di sistem lain.</li><li><strong>Sinkronisasi pengguna</strong> agar akses sesuai struktur organisasi terbaru.</li></ul>
<h3>Prinsip desain integrasi yang aman</h3>
<ul><li>Gunakan API key dengan <strong>scope</strong> yang minimal.</li><li>Terapkan <strong>idempotency</strong> untuk mencegah duplikasi saat terjadi retry.</li><li>Simpan secret di secret manager, bukan di kode atau dokumen.</li><li>Aktifkan audit trail untuk aktivitas integrasi yang penting.</li></ul>
<h3>Langkah implementasi yang direkomendasikan</h3>
<ol><li>Pilih satu alur paling kritikal (misalnya pembuatan request).</li><li>Definisikan data yang dibutuhkan dan mapping field.</li><li>Uji di staging: skenario sukses, gagal, dan retry.</li><li>Rollout bertahap: mulai dari satu unit, lalu perluas.</li><li>Pantau metrik: error rate, latency, serta volume request.</li></ol>
<p>Dengan pendekatan bertahap, integrasi API bukan proyek besar yang menakutkan, melainkan peningkatan kecil yang terus menambah nilai seiring waktu.</p>',
                'status' => 'published',
                'published_at' => '2026-01-11 13:00:00',
                'featured_image' => 'https://example.com/images/posts/pd-integrasi-api.jpg',
                'seo_title' => 'Integrasi API untuk Otomasi Alur Kerja',
                'seo_description' => 'Gunakan API untuk automasi approval, sinkronisasi data, dan notifikasi—mulai dari satu alur yang paling sering dipakai.',
                'canonical_url' => 'https://example.com/blog/integrasi-api-untuk-otomasi-alur-kerja',
                'meta' => [
                    'tags' => [
                        'produk',
                        'api',
                        'integrasi',
                        'otomasi',
                        'webhook'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'products',
            ],
            [
                'title' => 'Produk: Dashboard KPI untuk Monitoring Proses',
                'excerpt' => 'Dashboard KPI membantu memantau bottleneck proses dan melihat tren performa dari waktu ke waktu.',
                'content' => '<p>Dashboard KPI membantu tim memantau kesehatan proses tanpa harus membuka detail satu per satu. Dengan KPI yang tepat, Anda bisa melihat bottleneck, memprioritaskan perbaikan, dan melaporkan progres ke stakeholder dengan lebih jelas.</p>
<h3>KPI yang umum dipakai</h3>
<ul><li><strong>Waktu penyelesaian</strong> per jenis proses dan per unit.</li><li><strong>Volume permintaan</strong> per periode (harian, mingguan, bulanan).</li><li><strong>Rasio revisi</strong> dan titik tahap yang paling sering menyebabkan revisi.</li><li><strong>Kepatuhan SLA</strong> (jika Anda menetapkan target layanan).</li></ul>
<h3>Cara membaca dashboard agar tidak keliru</h3>
<ul><li>Jangan hanya melihat angka rata-rata; perhatikan juga sebaran dan outlier.</li><li>Bandingkan periode yang setara (misalnya bulan ini vs bulan lalu) agar tidak bias musiman.</li><li>Cari korelasi: naiknya volume sering diikuti naiknya waktu penyelesaian jika kapasitas tidak bertambah.</li></ul>
<h3>Membuat dashboard lebih actionable</h3>
<ol><li>Tetapkan definisi metrik yang konsisten (misalnya kapan waktu mulai dihitung).</li><li>Buat segmentasi: per unit, per jenis request, per tahap approval.</li><li>Tambahkan filter yang sering dipakai agar pengguna cepat menemukan insight.</li><li>Sertakan rekomendasi tindakan: misalnya daftar 5 proses yang paling lambat.</li></ol>
<h3>Contoh langkah perbaikan dari temuan KPI</h3>
<ul><li>Jika revisi banyak terjadi di tahap verifikasi, perjelas template dan checklist dokumen.</li><li>Jika bottleneck ada di approver tertentu, pertimbangkan delegasi atau aturan auto-routing.</li><li>Jika dashboard lambat, evaluasi caching dan optimasi query laporan.</li></ul>
<p>Gunakan dashboard KPI sebagai alat perbaikan proses, bukan sekadar laporan angka. Nilai terbesar muncul saat data diubah menjadi keputusan dan kebiasaan kerja yang lebih rapi.</p>',
                'status' => 'published',
                'published_at' => '2026-01-16 09:30:00',
                'featured_image' => 'https://example.com/images/posts/pd-dashboard-kpi.jpg',
                'seo_title' => 'Dashboard KPI untuk Monitoring Proses',
                'seo_description' => 'Pantau bottleneck dan tren performa dengan dashboard KPI: waktu penyelesaian, volume permintaan, dan rasio revisi.',
                'canonical_url' => 'https://example.com/blog/dashboard-kpi-untuk-monitoring-proses',
                'meta' => [
                    'tags' => [
                        'produk',
                        'dashboard',
                        'kpi',
                        'monitoring',
                        'analytics'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'products',
            ],
            [
                'title' => 'Teknologi: Prinsip Observability untuk Aplikasi Modern',
                'excerpt' => 'Observability membantu tim memahami apa yang terjadi di sistem melalui logs, metrics, dan traces.',
                'content' => '<p>Observability adalah kemampuan untuk memahami kondisi internal sistem dari sinyal yang dihasilkan sistem itu sendiri. Ini lebih dari sekadar monitoring; observability membantu menjawab pertanyaan mengapa sebuah masalah terjadi, bukan hanya memberi tahu bahwa masalah terjadi.</p>
<h3>Tiga pilar observability</h3>
<ul><li><strong>Logs</strong>: rekaman peristiwa yang menyimpan konteks. Cocok untuk investigasi detail.</li><li><strong>Metrics</strong>: angka agregat seperti latency, throughput, dan error rate. Cocok untuk tren dan alert.</li><li><strong>Traces</strong>: jejak perjalanan request lintas layanan. Cocok untuk mencari bottleneck dan dependency.</li></ul>
<h3>Mulai dari yang paling berdampak</h3>
<p>Jika Anda baru mulai, jangan mencoba menginstrumentasi semuanya sekaligus. Pilih endpoint atau alur yang paling kritikal bagi pengguna, misalnya login, submission, atau approval. Tetapkan SLO sederhana, misalnya persentase request sukses dan batas latency.</p>
<h3>Alert yang sehat</h3>
<ul><li>Actionable: ada langkah pertama yang jelas.</li><li>Tidak bising: menghindari spam notifikasi.</li><li>Berdasarkan SLO: fokus pada pengalaman pengguna, bukan metrik internal yang tidak relevan.</li></ul>
<h3>Praktik baik yang sering dilupakan</h3>
<ul><li>Tambah correlation id agar log dan trace bisa ditautkan.</li><li>Standarkan format log dan level (info, warn, error).</li><li>Simpan runbook di dekat alert: ketika alert bunyi, tim tahu apa yang harus dilakukan.</li></ul>
<h3>Contoh alur investigasi singkat</h3>
<ol><li>Alert error rate naik pada endpoint tertentu.</li><li>Cek trace untuk melihat layanan mana yang lambat atau error.</li><li>Ambil sampel log terkait correlation id untuk melihat konteks.</li><li>Lakukan mitigasi cepat, lalu tulis postmortem dan perbaikan permanen.</li></ol>
<p>Observability yang baik membuat tim lebih tenang: masalah terdeteksi lebih cepat, investigasi lebih singkat, dan perbaikan lebih terarah.</p>',
                'status' => 'published',
                'published_at' => '2026-01-07 14:00:00',
                'featured_image' => 'https://example.com/images/posts/tech-observability.jpg',
                'seo_title' => 'Prinsip Observability untuk Aplikasi Modern',
                'seo_description' => 'Kenali observability lewat logs, metrics, dan traces—mulai dari endpoint kritikal dan SLO untuk alerting yang efektif.',
                'canonical_url' => 'https://example.com/blog/prinsip-observability-untuk-aplikasi-modern',
                'meta' => [
                    'tags' => [
                        'teknologi',
                        'observability',
                        'monitoring',
                        'sre',
                        'tracing'
                    ],
                    'reading_time' => 12
                ],
                'category_key' => 'technology',
            ],
            [
                'title' => 'Teknologi: Event-Driven Architecture untuk Proses yang Skalabel',
                'excerpt' => 'Pendekatan event-driven membantu memecah proses besar menjadi rangkaian event yang lebih mudah diskalakan dan dipantau.',
                'content' => '<p>Event-driven architecture (EDA) adalah pendekatan di mana perubahan status atau kejadian penting dipublikasikan sebagai event, lalu layanan lain bereaksi terhadap event tersebut. Cocok untuk proses panjang, multi-tahap, dan lintas sistem.</p>
<h3>Mengapa event-driven membantu skalabilitas</h3>
<ul><li><strong>Decoupling</strong>: produsen event tidak perlu tahu siapa konsumennya.</li><li><strong>Asinkron</strong>: pekerjaan berat bisa diproses di belakang layar tanpa memblokir pengguna.</li><li><strong>Ekstensibel</strong>: menambah konsumen baru cukup berlangganan event, tanpa ubah produsen.</li></ul>
<h3>Komponen umum dalam EDA</h3>
<ul><li>Event broker atau message queue untuk distribusi event.</li><li>Schema event yang stabil dan terdokumentasi.</li><li>Consumer yang idempotent dan punya strategi retry.</li><li>Dead-letter queue untuk event yang gagal diproses.</li></ul>
<h3>Hal penting yang harus didesain sejak awal</h3>
<ul><li><strong>Idempotency</strong>: event yang sama diproses berkali-kali tidak boleh membuat data kacau.</li><li><strong>Ordering</strong>: tentukan apakah urutan event harus dijaga.</li><li><strong>Delivery semantics</strong>: at-least-once vs exactly-once (dan konsekuensinya).</li><li><strong>Observability</strong>: trace end-to-end dari event diterbitkan sampai selesai diproses.</li></ul>
<h3>Kapan EDA tidak cocok</h3>
<p>Jika proses sangat sederhana dan sinkron sudah cukup, EDA bisa menambah kompleksitas. Gunakan EDA ketika manfaat decoupling dan asinkron benar-benar diperlukan.</p>
<h3>Langkah adopsi bertahap</h3>
<ol><li>Mulai dari satu event penting (misalnya RequestCreated).</li><li>Buat consumer sederhana (misalnya kirim notifikasi).</li><li>Tambahkan monitoring dan metrik pemrosesan event.</li><li>Perluas use case secara bertahap.</li></ol>
<p>Dengan desain yang rapi, EDA membuat sistem lebih tahan lonjakan, lebih mudah berkembang, dan lebih mudah diaudit lewat jejak event.</p>',
                'status' => 'published',
                'published_at' => '2026-01-13 10:15:00',
                'featured_image' => 'https://example.com/images/posts/tech-event-driven.jpg',
                'seo_title' => 'Event-Driven Architecture untuk Proses yang Skalabel',
                'seo_description' => 'Kenali event-driven untuk proses multi-tahap: decoupling, audit event, serta pentingnya idempotency dan retry.',
                'canonical_url' => 'https://example.com/blog/event-driven-architecture-untuk-proses-yang-skalabel',
                'meta' => [
                    'tags' => [
                        'teknologi',
                        'event-driven',
                        'arsitektur',
                        'scaling',
                        'message queue'
                    ],
                    'reading_time' => 12
                ],
                'category_key' => 'technology',
            ],
            [
                'title' => 'Teknologi: Strategi Caching agar Aplikasi Tetap Responsif',
                'excerpt' => 'Caching yang tepat mengurangi beban database dan mempercepat respons, terutama untuk dashboard dan laporan.',
                'content' => '<p>Caching adalah teknik menyimpan hasil perhitungan atau data yang sering diakses agar permintaan berikutnya bisa dilayani lebih cepat. Namun caching yang salah bisa menghasilkan data basi atau bug yang sulit dilacak, sehingga perlu strategi yang tepat.</p>
<h3>Titik yang paling cocok untuk caching</h3>
<ul><li>Dashboard dan laporan yang dibuka berulang.</li><li>Data referensi yang jarang berubah (misalnya daftar unit, role).</li><li>Hasil agregasi yang mahal dihitung (misalnya KPI bulanan).</li></ul>
<h3>Pola caching yang umum</h3>
<ul><li><strong>Read-through</strong>: aplikasi membaca dari cache dulu, jika kosong baru ke database.</li><li><strong>Write-through</strong>: saat menulis ke database, cache ikut diperbarui.</li><li><strong>Cache-aside</strong>: aplikasi mengelola cache secara eksplisit (hapus/refresh saat update).</li></ul>
<h3>Menentukan TTL yang masuk akal</h3>
<p>TTL tergantung karakter data. Data referensi bisa TTL lebih lama, sementara data status proses mungkin perlu TTL singkat atau invalidasi saat ada perubahan. Prinsipnya: lebih baik sedikit lebih segar daripada cepat tetapi salah.</p>
<h3>Metrik yang perlu dipantau</h3>
<ul><li><strong>Hit rate</strong>: seberapa sering cache dipakai dibanding akses ke database.</li><li><strong>Latency</strong>: perbandingan waktu respons sebelum dan sesudah caching.</li><li><strong>Staleness</strong>: seberapa sering pengguna melihat data yang belum terbarui (indikator invalidasi).</li></ul>
<h3>Kesalahan umum</h3>
<ul><li>Tidak menghapus cache saat data berubah.</li><li>Key cache tidak konsisten sehingga data tumpang tindih.</li><li>Mencache data yang sangat dinamis sehingga invalidasi lebih mahal daripada manfaatnya.</li></ul>
<p>Caching yang baik adalah kompromi yang terukur: cepat, tetapi tetap benar dan mudah dioperasikan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 16:20:00',
                'featured_image' => 'https://example.com/images/posts/tech-caching.jpg',
                'seo_title' => 'Strategi Caching agar Aplikasi Tetap Responsif',
                'seo_description' => 'Pahami caching: read-through, write-through, TTL, serta evaluasi lewat hit rate dan latency.',
                'canonical_url' => 'https://example.com/blog/strategi-caching-agar-aplikasi-tetap-responsif',
                'meta' => [
                    'tags' => [
                        'teknologi',
                        'caching',
                        'performa',
                        'database',
                        'latency'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'technology',
            ],
            [
                'title' => 'Bisnis & Strategi: Menentukan Prioritas dengan RICE Framework',
                'excerpt' => 'RICE membantu memprioritaskan inisiatif berdasarkan Reach, Impact, Confidence, dan Effort.',
                'content' => '<p>Ketika ide dan permintaan terus berdatangan, tantangan terbesar bukan kekurangan pekerjaan, tetapi memilih mana yang paling berdampak. RICE adalah kerangka sederhana untuk membantu tim membuat keputusan prioritas yang lebih objektif.</p>
<h3>Apa itu RICE</h3>
<ul><li><strong>Reach</strong>: berapa banyak pengguna atau proses yang akan terdampak dalam periode tertentu.</li><li><strong>Impact</strong>: seberapa besar dampaknya pada tujuan (misalnya konversi, efisiensi, retensi).</li><li><strong>Confidence</strong>: seberapa yakin Anda dengan estimasi reach dan impact.</li><li><strong>Effort</strong>: berapa biaya waktu dan tenaga untuk mengeksekusi.</li></ul>
<h3>Cara menggunakannya dalam praktik</h3>
<ol><li>Tuliskan semua kandidat inisiatif secara ringkas (1–2 kalimat).</li><li>Estimasi Reach dalam angka yang relevan (misalnya jumlah pengguna, jumlah transaksi).</li><li>Beri skor Impact menggunakan skala konsisten (misalnya 0.25, 0.5, 1, 2, 3).</li><li>Tetapkan Confidence (misalnya 50%, 80%, 100%) berdasarkan data yang tersedia.</li><li>Estimasi Effort dalam person-week atau person-month.</li></ol>
<h3>Tips agar tidak terjebak angka</h3>
<ul><li>Gunakan RICE untuk memicu diskusi, bukan untuk memenangkan debat.</li><li>Pastikan semua orang memakai definisi yang sama untuk reach dan impact.</li><li>Review skor secara berkala karena konteks bisnis bisa berubah.</li></ul>
<h3>Contoh sederhana</h3>
<p>Jika sebuah fitur dipakai banyak orang (reach tinggi) tetapi dampaknya kecil, skornya mungkin kalah dari perbaikan proses yang menyasar bottleneck kritikal. RICE membantu membuat trade-off itu lebih jelas.</p>
<p>Pada akhirnya, keputusan prioritas tetap membutuhkan pertimbangan strategi. RICE membantu memastikan keputusan itu punya dasar yang dapat dijelaskan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-06 09:45:00',
                'featured_image' => 'https://example.com/images/posts/biz-rice-framework.jpg',
                'seo_title' => 'Menentukan Prioritas dengan RICE Framework',
                'seo_description' => 'Gunakan RICE (Reach, Impact, Confidence, Effort) untuk memprioritaskan inisiatif secara lebih objektif.',
                'canonical_url' => 'https://example.com/blog/menentukan-prioritas-dengan-rice-framework',
                'meta' => [
                    'tags' => [
                        'bisnis',
                        'strategi',
                        'prioritas',
                        'product management',
                        'framework'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'business',
            ],
            [
                'title' => 'Bisnis & Strategi: Mengukur CAC dan LTV dengan Cara Sederhana',
                'excerpt' => 'CAC dan LTV membantu memahami efisiensi akuisisi serta nilai pelanggan sepanjang siklus hidupnya.',
                'content' => '<p>CAC (Customer Acquisition Cost) dan LTV (Lifetime Value) adalah dua metrik dasar untuk memahami apakah pertumbuhan bisnis Anda sehat. Dengan metrik ini, Anda bisa menilai efisiensi pemasaran, kualitas pelanggan, dan ruang untuk investasi pertumbuhan.</p>
<h3>Cara sederhana menghitung CAC</h3>
<ul><li>Hitung total biaya akuisisi dalam periode tertentu: iklan, gaji tim, tool pemasaran, biaya event.</li><li>Bagi dengan jumlah pelanggan baru pada periode yang sama.</li><li><strong>CAC = total biaya akuisisi / pelanggan baru</strong>.</li></ul>
<h3>Cara sederhana menghitung LTV</h3>
<ul><li>Ambil pendapatan bulanan per pelanggan (ARPA) atau margin bulanan per pelanggan.</li><li>Kalikan dengan durasi rata-rata pelanggan bertahan (dalam bulan).</li><li><strong>LTV = margin bulanan x durasi rata-rata</strong>.</li></ul>
<h3>Hal yang perlu diperhatikan</h3>
<ul><li>Gunakan <strong>margin</strong> jika biaya layanan signifikan, agar LTV lebih realistis.</li><li>Pastikan periode CAC dan jumlah pelanggan baru sinkron (jangan campur kuartal dengan bulanan).</li><li>Bila churn belum stabil, pakai asumsi konservatif dan perbarui seiring data bertambah.</li></ul>
<h3>Bagaimana memakainya untuk keputusan</h3>
<ul><li>Jika LTV jauh lebih besar dari CAC, Anda punya ruang untuk scaling channel akuisisi.</li><li>Jika CAC tinggi, fokus pada peningkatan konversi funnel atau kualitas lead.</li><li>Jika LTV rendah, fokus pada retensi: onboarding, value delivery, dan dukungan.</li></ul>
<p>Mulai dari perhitungan sederhana lebih baik daripada menunggu model sempurna. Iterasi metrik seiring Anda mengumpulkan data dan memahami perilaku pelanggan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-09 12:10:00',
                'featured_image' => 'https://example.com/images/posts/biz-cac-ltv.jpg',
                'seo_title' => 'Mengukur CAC dan LTV dengan Cara Sederhana',
                'seo_description' => 'Cara sederhana menghitung CAC dan LTV untuk melihat efisiensi akuisisi dan nilai pelanggan.',
                'canonical_url' => 'https://example.com/blog/mengukur-cac-dan-ltv-dengan-cara-sederhana',
                'meta' => [
                    'tags' => [
                        'bisnis',
                        'metrics',
                        'cac',
                        'ltv',
                        'growth'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'business',
            ],
            [
                'title' => 'Bisnis & Strategi: Playbook Go-to-Market untuk Produk B2B',
                'excerpt' => 'Ringkasan playbook go-to-market B2B: segmentasi, positioning, channel, dan feedback loop.',
                'content' => '<p>Go-to-market (GTM) B2B bukan sekadar menjalankan pemasaran dan penjualan. GTM adalah sistem: memilih segmen yang tepat, merumuskan nilai yang jelas, menyiapkan channel, dan membangun feedback loop agar produk terus membaik.</p>
<h3>1) Tentukan ICP dan masalah yang nyata</h3>
<p>Mulai dari ICP (ideal customer profile). B2B yang sukses biasanya punya definisi jelas: tipe industri, ukuran organisasi, proses yang ingin diperbaiki, serta indikator urgensi.</p>
<h3>2) Susun positioning dan proof point</h3>
<ul><li>Tuliskan value proposition dalam bahasa pelanggan, bukan jargon internal.</li><li>Siapkan proof point: studi kasus, angka efisiensi, atau testimoni.</li><li>Buat perbandingan sederhana: sebelum dan sesudah menggunakan produk.</li></ul>
<h3>3) Pilih channel: inbound, outbound, partner</h3>
<ul><li><strong>Inbound</strong>: konten, SEO, webinar, komunitas. Cocok untuk edukasi pasar.</li><li><strong>Outbound</strong>: prospecting terarah ke ICP. Cocok saat Anda sudah yakin segmen mana yang konversinya tinggi.</li><li><strong>Partner</strong>: integrator, konsultan, atau vendor lain. Cocok untuk memperluas distribusi.</li></ul>
<h3>4) Rancang proses penjualan dan onboarding</h3>
<p>B2B memerlukan proses: discovery, demo, pilot, negosiasi, dan onboarding. Pastikan setiap tahap punya exit criteria yang jelas agar pipeline tidak mandek.</p>
<h3>5) Bangun feedback loop</h3>
<ul><li>Catat alasan menang dan kalah dalam penjualan.</li><li>Ukur time-to-value saat onboarding.</li><li>Ukur aktivasi fitur inti dan retensi pengguna.</li></ul>
<p>GTM yang baik dimulai kecil: satu segmen, satu channel, satu pesan. Setelah metrik stabil, barulah Anda memperluas dan menskalakan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-17 10:40:00',
                'featured_image' => 'https://example.com/images/posts/biz-gtm-b2b.jpg',
                'seo_title' => 'Playbook Go-to-Market untuk Produk B2B',
                'seo_description' => 'Playbook go-to-market B2B: ICP, positioning, channel strategy, dan feedback loop untuk mempercepat pertumbuhan.',
                'canonical_url' => 'https://example.com/blog/playbook-go-to-market-untuk-produk-b2b',
                'meta' => [
                    'tags' => [
                        'bisnis',
                        'gtm',
                        'b2b',
                        'sales',
                        'marketing'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'business',
            ],
            [
                'title' => 'Karier: Budaya Kerja Kami—Cepat, Rapi, dan Transparan',
                'excerpt' => 'Cara kami bekerja: dokumentasi jelas, komunikasi terbuka, dan fokus pada dampak.',
                'content' => '<p>Budaya kerja bukan slogan. Ia dibentuk dari kebiasaan harian: bagaimana tim berdiskusi, menulis keputusan, mengeksekusi rencana, dan mengevaluasi hasil. Di sini, kami merangkum tiga prinsip yang kami jaga: cepat, rapi, dan transparan.</p>
<h3>Cepat bukan berarti tergesa</h3>
<p>Cepat berarti mengurangi hambatan yang tidak perlu. Kami memecah pekerjaan menjadi iterasi kecil, merilis perbaikan bertahap, dan menghindari proses yang bertele-tele. Kecepatan yang sehat selalu diiringi definisi selesai yang jelas.</p>
<h3>Rapi berarti bisa diulang dan diaudit</h3>
<ul><li>Dokumentasi: keputusan penting ditulis agar konteks tidak hilang.</li><li>SOP: pekerjaan berulang punya checklist dan standar.</li><li>Kualitas: ada review dan pengujian yang konsisten.</li></ul>
<h3>Transparan membangun kepercayaan</h3>
<p>Kami mendorong komunikasi terbuka: status pekerjaan, risiko, dan dependensi dibagikan lebih awal. Transparansi membuat kolaborasi lebih mudah dan mengurangi kejutan.</p>
<h3>Bagaimana ini terasa dalam keseharian</h3>
<ul><li>Weekly planning yang ringkas dan fokus.</li><li>Update tertulis yang mudah ditelusuri.</li><li>Postmortem tanpa menyalahkan individu, fokus pada perbaikan sistem.</li></ul>
<h3>Siapa yang cocok</h3>
<p>Anda akan cocok jika suka belajar cepat, nyaman dengan feedback, dan menikmati merapikan proses. Anda juga akan cocok jika senang mengukur dampak, bukan hanya menyelesaikan tugas.</p>
<p>Jika prinsip ini sejalan dengan cara Anda bekerja, kami akan senang bertemu dan berdiskusi lebih lanjut.</p>',
                'status' => 'published',
                'published_at' => '2026-01-05 16:00:00',
                'featured_image' => 'https://example.com/images/posts/career-budaya-kerja.jpg',
                'seo_title' => 'Budaya Kerja Kami—Cepat, Rapi, dan Transparan',
                'seo_description' => 'Budaya kerja: transparansi, kerapian proses, dan fokus dampak untuk tim yang bertumbuh cepat.',
                'canonical_url' => 'https://example.com/blog/karier-budaya-kerja-kami-cepat-rapi-dan-transparan',
                'meta' => [
                    'tags' => [
                        'karier',
                        'budaya',
                        'tim',
                        'kolaborasi',
                        'cara kerja'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'career',
            ],
            [
                'title' => 'Karier: Program Magang 2026—Belajar dari Proyek Nyata',
                'excerpt' => 'Program magang 2026 membuka kesempatan untuk terlibat dalam proyek nyata dengan mentor dan target pembelajaran yang jelas.',
                'content' => '<p>Program magang 2026 dirancang untuk memberi pengalaman proyek nyata, bukan sekadar tugas kecil yang terpisah dari kebutuhan bisnis. Anda akan belajar end-to-end: memahami masalah, merancang solusi, mengeksekusi, dan mempresentasikan hasil.</p>
<h3>Struktur program</h3>
<ul><li><strong>Minggu 1–2</strong>: onboarding, pemahaman produk, dan pemetaan kebutuhan proyek.</li><li><strong>Minggu 3–6</strong>: eksekusi iterasi pertama, review rutin, dan perbaikan berdasarkan feedback.</li><li><strong>Minggu 7–10</strong>: penguatan kualitas, dokumentasi, dan persiapan presentasi hasil.</li></ul>
<h3>Mentoring dan pembelajaran</h3>
<ul><li>Mentoring mingguan untuk membahas progres dan hambatan.</li><li>Review hasil kerja (code review untuk teknis, review analisis untuk non-teknis).</li><li>Sesi sharing internal tentang praktik kerja, komunikasi, dan manajemen waktu.</li></ul>
<h3>Contoh proyek yang relevan</h3>
<ul><li>Otomasi alur approval sederhana dan notifikasi.</li><li>Perbaikan dashboard KPI dan analisis bottleneck.</li><li>Dokumentasi runbook atau SOP untuk proses internal.</li></ul>
<h3>Kualifikasi yang kami cari</h3>
<ul><li>Rasa ingin tahu tinggi dan mau belajar cepat.</li><li>Nyaman berkomunikasi dan meminta klarifikasi ketika perlu.</li><li>Bisa bekerja terstruktur: menulis rencana, mengeksekusi, dan mengevaluasi.</li></ul>
<p>Di akhir program, Anda akan mempresentasikan hasil proyek: apa masalahnya, apa solusi yang dibuat, dampaknya, serta pelajaran yang didapat.</p>',
                'status' => 'published',
                'published_at' => '2026-01-14 08:30:00',
                'featured_image' => 'https://example.com/images/posts/career-magang-2026.jpg',
                'seo_title' => 'Program Magang 2026—Belajar dari Proyek Nyata',
                'seo_description' => 'Program magang 2026: mentoring, target pembelajaran, dan pengalaman proyek nyata dari awal hingga akhir.',
                'canonical_url' => 'https://example.com/blog/karier-program-magang-2026-belajar-dari-proyek-nyata',
                'meta' => [
                    'tags' => [
                        'karier',
                        'magang',
                        'talent',
                        'learning',
                        'internship'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'career',
            ],
            [
                'title' => 'Karier: Tips Interview—Apa yang Kami Nilai',
                'excerpt' => 'Kami menilai cara berpikir, komunikasi, dan kemampuan mengeksekusi—bukan hafalan jawaban.',
                'content' => '<p>Interview adalah ruang untuk saling memahami. Kami ingin melihat bagaimana Anda berpikir, berkomunikasi, dan mengeksekusi, bukan seberapa hafal Anda terhadap jawaban yang terdengar sempurna.</p>
<h3>Tiga hal yang paling kami nilai</h3>
<ul><li><strong>Struktur berpikir</strong>: mampu memecah masalah menjadi langkah-langkah kecil dan membuat asumsi yang jelas.</li><li><strong>Komunikasi</strong>: menjelaskan ide secara ringkas, memberi konteks yang cukup, dan terbuka saat tidak yakin.</li><li><strong>Eksekusi</strong>: mampu menyusun rencana realistis, memprioritaskan, dan menuntaskan pekerjaan.</li></ul>
<h3>Cara menyiapkan cerita pengalaman</h3>
<p>Gunakan pola sederhana: situasi, tugas, tindakan, hasil, dan pelajaran. Yang penting bukan dramanya, tetapi detail keputusan yang Anda ambil dan alasan di baliknya.</p>
<h3>Contoh pertanyaan yang sering muncul</h3>
<ul><li>Ceritakan proyek yang paling menantang dan bagaimana Anda mengatasinya.</li><li>Pernah gagal? Apa yang Anda pelajari dan bagaimana Anda memperbaikinya.</li><li>Bagaimana Anda mengambil keputusan saat data belum lengkap.</li></ul>
<h3>Tips praktis saat interview</h3>
<ul><li>Jujur tentang asumsi dan batas pengetahuan Anda.</li><li>Tanya balik untuk mengklarifikasi konteks, ini menunjukkan Anda berpikir terstruktur.</li><li>Berikan contoh nyata, bukan jawaban general.</li><li>Akhiri dengan ringkasan: keputusan Anda dan trade-off yang dipilih.</li></ul>
<p>Jika Anda datang dengan kesiapan cerita nyata dan cara berpikir yang jernih, itu sudah lebih dari cukup untuk menunjukkan potensi Anda.</p>',
                'status' => 'published',
                'published_at' => '2026-01-20 19:00:00',
                'featured_image' => 'https://example.com/images/posts/career-tips-interview.jpg',
                'seo_title' => 'Tips Interview—Apa yang Kami Nilai',
                'seo_description' => 'Tips interview: struktur berpikir, komunikasi, dan eksekusi—siapkan contoh pengalaman nyata dan pelajarannya.',
                'canonical_url' => 'https://example.com/blog/karier-tips-interview-apa-yang-kami-nilai',
                'meta' => [
                    'tags' => [
                        'karier',
                        'interview',
                        'rekrutmen',
                        'tips',
                        'hiring'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'career',
            ],
            [
                'title' => 'Event: Webinar Paperless Workflow untuk Tim Operasional',
                'excerpt' => 'Webinar membahas langkah praktis menerapkan paperless workflow: template, approval, dan pelaporan.',
                'content' => '<p>Paperless workflow bukan sekadar memindahkan dokumen dari kertas ke digital. Ini tentang merapikan proses: siapa melakukan apa, kapan perlu approval, bagaimana melacak revisi, dan bagaimana melaporkan progres.</p>
<h3>Untuk siapa webinar ini</h3>
<ul><li>Tim operasional dan administrasi yang memproses permintaan rutin.</li><li>Supervisor/manajer yang ingin memantau SLA dan bottleneck.</li><li>Admin sistem yang mengelola template, role, dan akses.</li></ul>
<h3>Agenda sesi</h3>
<ul><li><strong>Desain template</strong>: struktur dokumen, checklist, dan catatan revisi.</li><li><strong>Approval berjenjang</strong>: routing, delegasi, dan notifikasi.</li><li><strong>Pelaporan</strong>: KPI dasar, ekspor data, dan cara membaca tren.</li><li><strong>Studi kasus</strong>: contoh implementasi bertahap untuk tim kecil hingga besar.</li></ul>
<h3>Hasil yang diharapkan</h3>
<ul><li>Peserta punya blueprint alur paperless untuk satu proses yang paling sering.</li><li>Peserta memahami kesalahan umum: template tidak konsisten, akses terlalu longgar, dan notifikasi yang bising.</li><li>Peserta punya checklist 30 hari untuk implementasi tahap awal.</li></ul>
<p>Webinar ini dirancang praktis: lebih banyak contoh dan langkah-langkah yang bisa langsung diterapkan, bukan teori panjang.</p>
<p>Kami juga menyediakan sesi tanya jawab agar peserta bisa membawa kasus nyata dari tempat kerja masing-masing.</p>',
                'status' => 'published',
                'published_at' => '2026-01-09 09:00:00',
                'featured_image' => 'https://example.com/images/posts/event-webinar-paperless.jpg',
                'seo_title' => 'Webinar Paperless Workflow untuk Tim Operasional',
                'seo_description' => 'Webinar: paperless workflow, template dokumen, approval berjenjang, notifikasi, dan pelaporan KPI proses.',
                'canonical_url' => 'https://example.com/blog/event-webinar-paperless-workflow-untuk-tim-operasional',
                'meta' => [
                    'tags' => [
                        'event',
                        'webinar',
                        'paperless',
                        'operasional',
                        'workflow'
                    ],
                    'reading_time' => 9,
                    'event_date' => '2026-02-05'
                ],
                'category_key' => 'event',
            ],
            [
                'title' => 'Event: Meetup Komunitas Developer—Observability dan Scaling',
                'excerpt' => 'Sesi komunitas untuk berbagi praktik observability, tracing, dan strategi scaling layanan.',
                'content' => '<p>Meetup ini adalah ruang diskusi untuk developer yang ingin membangun sistem yang lebih andal. Fokusnya pada praktik observability dan scaling yang bisa diterapkan di berbagai skala, dari monolith hingga microservices.</p>
<h3>Topik utama</h3>
<ul><li><strong>SLO dan alerting</strong>: bagaimana membuat alert yang actionable dan tidak bising.</li><li><strong>Tracing lintas layanan</strong>: mencari bottleneck dari request end-to-end.</li><li><strong>Scaling database</strong>: optimasi query, index, caching, dan read replica.</li><li><strong>Incident response</strong>: runbook, postmortem, dan perbaikan berkelanjutan.</li></ul>
<h3>Format acara</h3>
<ul><li>Lightning talk singkat untuk memancing diskusi.</li><li>Sesi studi kasus: peserta bisa membahas problem nyata (tanpa membocorkan data sensitif).</li><li>Networking untuk berbagi praktik dan tooling.</li></ul>
<h3>Yang perlu dipersiapkan</h3>
<ul><li>Bawa satu masalah yang pernah Anda temui: latency, error rate, atau outage.</li><li>Bawa insight tentang apa yang sudah dicoba dan apa yang tidak berhasil.</li><li>Siapkan pertanyaan tentang observability dan scaling.</li></ul>
<p>Tujuan meetup ini adalah membuat peserta pulang dengan daftar tindakan yang bisa dicoba minggu depan, bukan sekadar inspirasi.</p>',
                'status' => 'published',
                'published_at' => '2026-01-16 18:00:00',
                'featured_image' => 'https://example.com/images/posts/event-meetup-observability.jpg',
                'seo_title' => 'Meetup Komunitas Developer—Observability dan Scaling',
                'seo_description' => 'Meetup developer: SLO, tracing lintas service, dan strategi scaling database untuk beban tinggi.',
                'canonical_url' => 'https://example.com/blog/event-meetup-komunitas-developer-observability-dan-scaling',
                'meta' => [
                    'tags' => [
                        'event',
                        'meetup',
                        'developer',
                        'observability',
                        'scaling'
                    ],
                    'reading_time' => 9,
                    'event_date' => '2026-02-12'
                ],
                'category_key' => 'event',
            ],
            [
                'title' => 'Event: Roadshow Pelatihan Admin—Kontrol Akses dan Audit Trail',
                'excerpt' => 'Pelatihan admin membahas role-based access, audit trail, dan praktik governance agar sistem rapi dan aman.',
                'content' => '<p>Roadshow pelatihan admin ini dibuat untuk membantu organisasi membangun tata kelola sistem yang rapi: akses tepat sasaran, jejak aktivitas tercatat, dan perubahan konfigurasi tidak menimbulkan risiko.</p>
<h3>Materi pelatihan</h3>
<ul><li><strong>Role-based access</strong>: mendesain peran berdasarkan fungsi kerja, bukan orang.</li><li><strong>Least privilege</strong>: memberi akses minimal yang diperlukan untuk menjalankan tugas.</li><li><strong>Audit trail</strong>: memahami jejak aktivitas, ekspor log, dan kebutuhan audit internal.</li><li><strong>Governance checklist</strong>: penamaan template, SOP revisi, dan review akses berkala.</li></ul>
<h3>Mengapa ini penting</h3>
<p>Banyak masalah operasional muncul bukan karena bug, tetapi karena konfigurasi dan akses yang tidak terjaga. Pelatihan ini membantu mengurangi risiko tersebut, sekaligus memudahkan proses audit dan investigasi ketika ada insiden.</p>
<h3>Output yang dibawa pulang</h3>
<ul><li>Template matriks role dan permission untuk organisasi Anda.</li><li>Checklist review akses per kuartal.</li><li>Panduan menyusun SOP perubahan konfigurasi agar tidak mengganggu operasional.</li></ul>
<p>Pelatihan cocok untuk admin sistem, supervisor, tim compliance, serta siapa pun yang bertanggung jawab pada governance digital.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 10:00:00',
                'featured_image' => 'https://example.com/images/posts/event-roadshow-admin.jpg',
                'seo_title' => 'Roadshow Pelatihan Admin—Kontrol Akses dan Audit Trail',
                'seo_description' => 'Roadshow pelatihan admin: role-based access, audit trail, dan governance checklist untuk sistem yang rapi dan aman.',
                'canonical_url' => 'https://example.com/blog/event-roadshow-pelatihan-admin-kontrol-akses-dan-audit-trail',
                'meta' => [
                    'tags' => [
                        'event',
                        'pelatihan',
                        'admin',
                        'governance',
                        'audit'
                    ],
                    'reading_time' => 10,
                    'event_date' => '2026-02-20'
                ],
                'category_key' => 'event',
            ],
            [
                'title' => 'Rilis Fitur: Audit Trail untuk Perubahan Data',
                'excerpt' => 'Audit trail mencatat perubahan penting agar proses lebih akuntabel dan mudah diaudit.',
                'content' => '<p>Kami merilis fitur audit trail untuk membantu organisasi melacak perubahan data secara lebih akurat. Audit trail menjawab tiga pertanyaan utama: siapa yang melakukan perubahan, kapan perubahan terjadi, dan apa yang berubah.</p>
<h3>Apa saja yang tercatat</h3>
<ul><li>Perubahan status proses (misalnya diajukan, diverifikasi, disetujui, ditolak).</li><li>Perubahan field penting pada data (misalnya nilai, pihak terkait, atau atribut kunci).</li><li>Aktivitas administratif tertentu: perubahan role, pembaruan konfigurasi, dan tindakan penting lainnya.</li></ul>
<h3>Manfaat utama</h3>
<ul><li><strong>Akuntabilitas</strong>: jelas siapa melakukan tindakan tertentu.</li><li><strong>Audit</strong>: memudahkan pemeriksaan internal dan eksternal.</li><li><strong>Investigasi</strong>: mempercepat pencarian akar masalah saat terjadi anomali.</li><li><strong>Keamanan</strong>: membantu mendeteksi perubahan yang tidak wajar.</li></ul>
<h3>Cara menggunakan audit trail dengan efektif</h3>
<ol><li>Tetapkan role yang boleh mengakses audit trail (biasanya admin dan compliance).</li><li>Gunakan filter waktu dan jenis aktivitas agar pencarian cepat.</li><li>Ekspor log untuk kebutuhan laporan audit berkala.</li><li>Kombinasikan dengan SOP perubahan: siapa boleh mengubah apa dan kapan.</li></ol>
<h3>Catatan implementasi</h3>
<p>Audit trail dirancang untuk tidak mengganggu performa operasional. Namun untuk organisasi dengan volume tinggi, kami menyarankan penetapan retensi log dan strategi ekspor berkala.</p>
<p>Dengan audit trail, organisasi bisa menjalankan proses digital yang lebih tertib, dapat dipertanggungjawabkan, dan mudah ditelusuri.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 09:15:00',
                'featured_image' => 'https://example.com/images/posts/fr-audit-trail.jpg',
                'seo_title' => 'Rilis Fitur: Audit Trail untuk Perubahan Data',
                'seo_description' => 'Audit trail mencatat siapa, kapan, dan apa yang berubah—membantu akuntabilitas dan kebutuhan audit.',
                'canonical_url' => 'https://example.com/blog/rilis-fitur-audit-trail-untuk-perubahan-data',
                'meta' => [
                    'tags' => [
                        'rilis',
                        'audit trail',
                        'akuntabilitas',
                        'compliance',
                        'log'
                    ],
                    'reading_time' => 10,
                    'changelog' => [
                        'Added audit trail for critical events',
                        'Added export audit log',
                        'Added filters by action and actor'
                    ]
                ],
                'category_key' => 'feature_release',
            ],
            [
                'title' => 'Rilis Fitur: Notifikasi Real-Time untuk Approval',
                'excerpt' => 'Notifikasi real-time memastikan approver tidak ketinggalan update saat ada permintaan baru atau revisi.',
                'content' => '<p>Approval yang lambat sering bukan karena orangnya, tetapi karena informasi terlambat sampai. Karena itu kami merilis notifikasi real-time agar approver menerima update saat peristiwa penting terjadi.</p>
<h3>Kapan notifikasi muncul</h3>
<ul><li>Permintaan baru masuk ke antrian Anda.</li><li>Ada revisi atau komentar pada dokumen.</li><li>Status berubah menjadi disetujui, ditolak, atau perlu tindakan lanjutan.</li><li>Ada delegasi atau perubahan penanggung jawab.</li></ul>
<h3>Pengaturan preferensi</h3>
<p>Anda bisa mengatur preferensi notifikasi sesuai kebutuhan tim: jenis notifikasi yang diterima, kanal notifikasi, dan frekuensi ringkasan. Tujuannya agar notifikasi membantu, bukan mengganggu.</p>
<h3>Praktik baik agar notifikasi efektif</h3>
<ul><li>Tetapkan aturan delegasi saat approver cuti atau tidak tersedia.</li><li>Gunakan komentar yang jelas saat meminta revisi, agar bolak-balik berkurang.</li><li>Gunakan ringkasan harian untuk update non-kritis.</li></ul>
<h3>Dampak yang diharapkan</h3>
<p>Dengan notifikasi real-time, waktu tunggu approval dapat berkurang karena approver mengetahui tugasnya lebih cepat. Ini membantu SLA lebih terjaga dan proses lebih lancar.</p>
<p>Kami akan terus memantau feedback agar notifikasi semakin relevan dan minim noise.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 10:10:00',
                'featured_image' => 'https://example.com/images/posts/fr-notifikasi-realtime.jpg',
                'seo_title' => 'Rilis Fitur: Notifikasi Real-Time untuk Approval',
                'seo_description' => 'Notifikasi real-time untuk approval: permintaan baru, revisi, komentar, dan perubahan status.',
                'canonical_url' => 'https://example.com/blog/rilis-fitur-notifikasi-real-time-untuk-approval',
                'meta' => [
                    'tags' => [
                        'rilis',
                        'notifikasi',
                        'approval',
                        'produktivitas',
                        'workflow'
                    ],
                    'reading_time' => 9,
                    'changelog' => [
                        'Added real-time notifications',
                        'Added notification preferences',
                        'Added daily digest option'
                    ]
                ],
                'category_key' => 'feature_release',
            ],
            [
                'title' => 'Rilis Fitur: Ekspor Laporan ke CSV dan Excel',
                'excerpt' => 'Ekspor laporan memudahkan analisis lanjutan dan pelaporan periodik ke stakeholder.',
                'content' => '<p>Kebutuhan laporan sering berbeda-beda: ada yang ingin analisis di spreadsheet, ada yang perlu rekap untuk presentasi, ada juga yang perlu digabungkan dengan data lain. Karena itu kami merilis fitur ekspor laporan ke CSV dan Excel.</p>
<h3>Jenis laporan yang bisa diekspor</h3>
<ul><li>Rekap permintaan per periode dan per unit.</li><li>Waktu penyelesaian dan kepatuhan SLA.</li><li>Status proses dan daftar item yang tertahan di tahap tertentu.</li><li>Ringkasan revisi dan komentar (untuk evaluasi kualitas dokumen).</li></ul>
<h3>Cara mendapatkan hasil ekspor yang rapi</h3>
<ol><li>Terapkan filter terlebih dahulu (periode, unit, jenis proses).</li><li>Pastikan kolom yang dipilih sesuai kebutuhan analisis.</li><li>Gunakan penamaan file standar agar mudah ditelusuri.</li><li>Jadwalkan ekspor berkala untuk pelaporan rutin.</li></ol>
<h3>Contoh penggunaan</h3>
<ul><li>Analisis bottleneck: pivot tabel untuk melihat tahap paling lambat.</li><li>Pelaporan manajemen: tren volume permintaan per bulan.</li><li>Audit internal: cek item yang melewati batas SLA.</li></ul>
<p>Fitur ekspor ini dibuat agar data Anda tidak terkunci di dashboard. Anda bisa mengolahnya sesuai kebutuhan organisasi, sambil tetap menjaga konsistensi sumber data.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 11:40:00',
                'featured_image' => 'https://example.com/images/posts/fr-export-csv-excel.jpg',
                'seo_title' => 'Rilis Fitur: Ekspor Laporan ke CSV dan Excel',
                'seo_description' => 'Ekspor laporan ke CSV dan Excel: rekap periode, SLA, status proses, dan filter agar hasil lebih fokus.',
                'canonical_url' => 'https://example.com/blog/rilis-fitur-ekspor-laporan-ke-csv-dan-excel',
                'meta' => [
                    'tags' => [
                        'rilis',
                        'laporan',
                        'export',
                        'excel',
                        'csv'
                    ],
                    'reading_time' => 9,
                    'changelog' => [
                        'Added CSV export',
                        'Added Excel export',
                        'Improved filter before export',
                        'Added column selector'
                    ]
                ],
                'category_key' => 'feature_release',
            ],
            [
                'title' => 'Tips & Tutorial: Menyusun Template Dokumen yang Konsisten',
                'excerpt' => 'Template yang konsisten mengurangi revisi, mempercepat approval, dan memudahkan audit.',
                'content' => '<p>Template dokumen yang konsisten adalah fondasi workflow yang rapi. Tanpa template, setiap orang menulis dengan format berbeda, informasi penting tercecer, dan approver menghabiskan waktu untuk menanyakan hal yang sama berulang-ulang.</p>
<h3>Prinsip template yang baik</h3>
<ul><li><strong>Jelas</strong>: pembaca tahu tujuan dokumen dalam 30 detik pertama.</li><li><strong>Konsisten</strong>: struktur sama untuk dokumen sejenis sehingga mudah dibandingkan.</li><li><strong>Lengkap</strong>: informasi minimum selalu ada, termasuk lampiran dan catatan revisi.</li></ul>
<h3>Checklist isi template</h3>
<ul><li>Judul, nomor dokumen, dan versi (jika digunakan).</li><li>Tujuan, ruang lingkup, dan pihak terkait.</li><li>Data utama: tanggal, unit, dan ringkasan permintaan.</li><li>Bagian lampiran: daftar dokumen pendukung.</li><li>Bagian approval: siapa menyetujui dan kapan.</li><li>Catatan revisi: apa yang berubah dan alasannya.</li></ul>
<h3>Langkah menyusun template</h3>
<ol><li>Kumpulkan 5–10 contoh dokumen yang paling sering dipakai.</li><li>Identifikasi informasi yang selalu ditanyakan approver (ini biasanya wajib masuk template).</li><li>Susun struktur: dari ringkasan, detail, lampiran, hingga approval.</li><li>Uji coba di satu tim selama 2 minggu, kumpulkan feedback.</li><li>Finalisasi dan tetapkan sebagai standar, lalu dokumentasikan.</li></ol>
<h3>Tips mengurangi revisi</h3>
<ul><li>Tambahkan checklist kelengkapan sebelum submit.</li><li>Gunakan bahasa yang lugas dan hindari istilah ambigu.</li><li>Sediakan contoh pengisian pada bagian yang sering salah.</li></ul>
<p>Mulailah dari 1–2 template paling berdampak. Setelah pola kerja terbentuk, memperluas template ke proses lain akan jauh lebih mudah.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 09:00:00',
                'featured_image' => 'https://example.com/images/posts/tt-template-konsisten.jpg',
                'seo_title' => 'Menyusun Template Dokumen yang Konsisten',
                'seo_description' => 'Checklist menyusun template dokumen: struktur, approval, catatan revisi—agar proses lebih cepat dan rapi.',
                'canonical_url' => 'https://example.com/blog/tips-tutorial-menyusun-template-dokumen-yang-konsisten',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'template',
                        'dokumen',
                        'workflow',
                        'paperless'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'tips_tutorial',
            ],
            [
                'title' => 'Tips & Tutorial: Mengatur Role dan Permission dengan Aman',
                'excerpt' => 'Atur role dan permission berdasarkan fungsi kerja agar akses tepat, aman, dan mudah dikelola.',
                'content' => '<p>Kontrol akses yang baik menghindari dua risiko sekaligus: data bocor karena akses terlalu luas, dan pekerjaan terhambat karena akses terlalu sempit. Kuncinya adalah mendesain role dan permission berdasarkan fungsi kerja.</p>
<h3>Konsep dasar yang perlu dipahami</h3>
<ul><li><strong>Role</strong>: kumpulan izin yang menggambarkan fungsi (admin, approver, requester, viewer).</li><li><strong>Permission</strong>: izin spesifik (lihat, buat, ubah, hapus, ekspor).</li><li><strong>Scope</strong>: batas cakupan akses (misalnya hanya unit tertentu).</li></ul>
<h3>Langkah praktis menyusun role</h3>
<ol><li>Petakan fungsi dalam proses: siapa mengajukan, memverifikasi, menyetujui, memonitor.</li><li>Tentukan izin minimal untuk tiap fungsi (least privilege).</li><li>Tambahkan scope agar akses tidak melebar lintas unit tanpa kebutuhan.</li><li>Uji dengan akun dummy untuk memastikan alur kerja tetap lancar.</li></ol>
<h3>Review akses berkala</h3>
<p>Akses harus direview rutin, terutama saat ada mutasi jabatan atau perubahan organisasi. Jadwalkan review per kuartal: cek admin, cek approver, dan cek akun yang sudah tidak aktif.</p>
<h3>Kesalahan umum</h3>
<ul><li>Menggunakan satu akun admin bersama (sebaiknya hindari).</li><li>Memberi akses ekspor ke semua orang tanpa alasan.</li><li>Tidak mencabut akses ketika orang pindah unit.</li></ul>
<p>Role yang rapi membuat sistem lebih aman dan operasional lebih tenang. Anda mengurangi risiko, sekaligus memudahkan audit karena akses punya logika yang jelas.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 14:30:00',
                'featured_image' => 'https://example.com/images/posts/tt-role-permission.jpg',
                'seo_title' => 'Mengatur Role dan Permission dengan Aman',
                'seo_description' => 'Panduan role & permission: definisi peran, least privilege, dan review berkala agar akses tepat dan aman.',
                'canonical_url' => 'https://example.com/blog/tips-tutorial-mengatur-role-dan-permission-dengan-aman',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'akses',
                        'permission',
                        'admin',
                        'security'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'tips_tutorial',
            ],
            [
                'title' => 'Tips & Tutorial: Membaca Dashboard KPI untuk Menemukan Bottleneck',
                'excerpt' => 'Pelajari cara membaca KPI agar bisa menemukan bottleneck dan memperbaiki proses secara tepat sasaran.',
                'content' => '<p>Dashboard KPI tidak akan banyak membantu jika hanya dilihat sesekali. Nilainya muncul ketika KPI dijadikan kebiasaan: memantau, menemukan bottleneck, lalu melakukan perbaikan kecil yang terukur.</p>
<h3>Tiga KPI yang paling sering mengungkap bottleneck</h3>
<ul><li><strong>Cycle time</strong>: waktu dari pengajuan hingga selesai. Naik berarti ada hambatan di salah satu tahap.</li><li><strong>Rework rate</strong>: persentase item yang perlu revisi. Tinggi berarti template atau instruksi belum jelas.</li><li><strong>WIP</strong> (work in progress): jumlah item yang sedang diproses. Terlalu tinggi biasanya menunjukkan kapasitas tidak seimbang.</li></ul>
<h3>Langkah membaca dashboard</h3>
<ol><li>Mulai dari tren: apakah cycle time membaik atau memburuk.</li><li>Segmentasikan: per unit, per jenis proses, per approver.</li><li>Cari outlier: item yang jauh lebih lama dari rata-rata.</li><li>Cek tahap: di mana item paling lama tertahan.</li></ol>
<h3>Mengubah temuan menjadi tindakan</h3>
<ul><li>Jika revisi tinggi, perbaiki template dan tambahkan checklist kelengkapan sebelum submit.</li><li>Jika bottleneck di approver, aktifkan delegasi atau buat aturan routing.</li><li>Jika volume naik, evaluasi kapasitas tim atau automasi tahap verifikasi.</li></ul>
<h3>Ritme yang disarankan</h3>
<p>Lakukan review ringan mingguan (15–30 menit) dan review bulanan yang lebih mendalam. Dengan ritme ini, perbaikan proses menjadi kebiasaan, bukan proyek besar yang jarang dilakukan.</p>
<p>KPI adalah alat, bukan tujuan. Tujuan akhirnya adalah proses yang lebih cepat, lebih rapi, dan lebih mudah dipantau.</p>',
                'status' => 'published',
                'published_at' => '2026-01-20 10:00:00',
                'featured_image' => 'https://example.com/images/posts/tt-dashboard-bottleneck.jpg',
                'seo_title' => 'Membaca Dashboard KPI untuk Menemukan Bottleneck',
                'seo_description' => 'Cara membaca KPI: waktu penyelesaian, tren volume, dan tahap yang memicu revisi untuk menemukan bottleneck.',
                'canonical_url' => 'https://example.com/blog/tips-tutorial-membaca-dashboard-kpi-untuk-menemukan-bottleneck',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'kpi',
                        'dashboard',
                        'proses',
                        'continuous improvement'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'tips_tutorial',
            ],
            [
                'title' => 'Keamanan: Mengaktifkan MFA untuk Melindungi Akun',
                'excerpt' => 'MFA menambah lapisan keamanan penting untuk mencegah pengambilalihan akun.',
                'content' => '<p>Password saja tidak cukup. Banyak insiden pengambilalihan akun terjadi karena password bocor, dipakai ulang, atau ditebak. Multi-factor authentication (MFA) menambah lapisan verifikasi yang membuat akun jauh lebih sulit diambil alih.</p>
<h3>Siapa yang wajib memakai MFA</h3>
<ul><li>Admin sistem dan pemilik konfigurasi.</li><li>Approver yang punya akses menyetujui proses penting.</li><li>Akun integrasi atau akun dengan akses sensitif (bila memungkinkan).</li></ul>
<h3>Metode MFA yang disarankan</h3>
<ul><li><strong>Authenticator app</strong> (disarankan): lebih aman daripada SMS.</li><li><strong>Security key</strong>: cocok untuk organisasi dengan kebijakan keamanan tinggi.</li><li><strong>SMS</strong>: pilihan terakhir jika tidak ada opsi lain.</li></ul>
<h3>Checklist implementasi MFA</h3>
<ol><li>Aktifkan MFA sebagai kebijakan untuk role tertentu.</li><li>Edukasi pengguna dengan panduan singkat 5 menit.</li><li>Simpan recovery codes pada tempat aman dan terkontrol.</li><li>Uji skenario pemulihan akun agar operasional tidak terganggu.</li></ol>
<h3>Kesalahan umum</h3>
<ul><li>Membiarkan admin tanpa MFA karena alasan kenyamanan.</li><li>Tidak menyiapkan proses pemulihan sehingga saat perangkat hilang operasional panik.</li><li>Menggunakan SMS padahal ada opsi authenticator app.</li></ul>
<p>MFA adalah investasi keamanan dengan biaya rendah dan dampak besar. Mulailah dari admin dan approver, lalu perluas sesuai kebutuhan risiko organisasi.</p>',
                'status' => 'published',
                'published_at' => '2026-01-11 09:10:00',
                'featured_image' => 'https://example.com/images/posts/sec-mfa.jpg',
                'seo_title' => 'Mengaktifkan MFA untuk Melindungi Akun',
                'seo_description' => 'Panduan MFA: aktifkan untuk admin/approver, gunakan authenticator app, dan simpan recovery codes dengan aman.',
                'canonical_url' => 'https://example.com/blog/keamanan-mengaktifkan-mfa-untuk-melindungi-akun',
                'meta' => [
                    'tags' => [
                        'keamanan',
                        'mfa',
                        'akun',
                        'best practice',
                        'authenticator'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'security',
            ],
            [
                'title' => 'Keamanan: Rotasi API Key dan Praktik Pengelolaan Rahasia',
                'excerpt' => 'Rotasi API key dan pengelolaan secret yang baik menurunkan risiko kebocoran dan penyalahgunaan akses.',
                'content' => '<p>Integrasi yang kuat membutuhkan secret management yang rapi. API key, token, dan kredensial lain adalah pintu masuk sistem. Jika bocor, dampaknya bisa besar. Karena itu, rotasi dan pengelolaan secret harus menjadi kebiasaan, bukan reaksi saat insiden terjadi.</p>
<h3>Prinsip dasar secret management</h3>
<ul><li><strong>Least privilege</strong>: key hanya punya akses yang dibutuhkan.</li><li><strong>Short-lived</strong> jika memungkinkan: token dengan masa berlaku terbatas.</li><li><strong>Rotasi berkala</strong>: jadwalkan rotasi untuk mengurangi risiko kebocoran jangka panjang.</li><li><strong>Audit</strong>: catat penggunaan key dan akses yang dilakukan.</li></ul>
<h3>Checklist rotasi yang aman</h3>
<ol><li>Buat key baru dengan scope yang sama atau lebih sempit.</li><li>Deploy perubahan konfigurasi secara bertahap (staging dulu).</li><li>Aktifkan monitoring error untuk mendeteksi integrasi yang gagal.</li><li>Setelah stabil, revoke key lama dan simpan catatan perubahan.</li></ol>
<h3>Di mana secret seharusnya disimpan</h3>
<ul><li>Secret manager atau vault.</li><li>Environment variable di infrastruktur yang terkontrol.</li><li>Bukan di repository kode, spreadsheet publik, atau chat tanpa kontrol.</li></ul>
<h3>Sinyal yang perlu diwaspadai</h3>
<ul><li>Lonjakan request yang tidak wajar dari integrasi.</li><li>Akses dari IP atau lokasi yang tidak biasa.</li><li>Permintaan ke endpoint sensitif yang tidak pernah dipakai sebelumnya.</li></ul>
<p>Dengan rotasi dan pengelolaan secret yang rapi, integrasi tetap aman, audit lebih mudah, dan risiko insiden berkurang signifikan.</p>',
                'status' => 'published',
                'published_at' => '2026-01-14 13:20:00',
                'featured_image' => 'https://example.com/images/posts/sec-rotasi-api-key.jpg',
                'seo_title' => 'Rotasi API Key dan Praktik Pengelolaan Rahasia',
                'seo_description' => 'Checklist keamanan API: rotasi key, batasi scope, hindari menyimpan secret di repo, dan langkah cepat saat insiden.',
                'canonical_url' => 'https://example.com/blog/keamanan-rotasi-api-key-dan-praktik-pengelolaan-rahasia',
                'meta' => [
                    'tags' => [
                        'keamanan',
                        'api',
                        'secret',
                        'integrasi',
                        'rotasi'
                    ],
                    'reading_time' => 11
                ],
                'category_key' => 'security',
            ],
            [
                'title' => 'Keamanan: Proses Pelaporan Kerentanan yang Bertanggung Jawab',
                'excerpt' => 'Kami menyediakan jalur pelaporan kerentanan agar isu keamanan dapat ditangani cepat dan terkoordinasi.',
                'content' => '<p>Keamanan adalah upaya bersama. Kami menyambut laporan kerentanan dengan prinsip responsible disclosure agar penanganan bisa cepat, terkoordinasi, dan tidak membahayakan pengguna.</p>
<h3>Apa yang termasuk kerentanan</h3>
<ul><li>Akses tanpa otorisasi ke data atau fungsi sensitif.</li><li>Bypass autentikasi atau eskalasi privilege.</li><li>Kebocoran informasi melalui konfigurasi yang salah.</li><li>Kerentanan yang memungkinkan eksekusi aksi tanpa izin.</li></ul>
<h3>Informasi yang dibutuhkan saat melapor</h3>
<ul><li>Deskripsi isu dan skenario dampak.</li><li>Langkah reproduksi yang jelas.</li><li>Bukti pendukung seperti screenshot atau sample request (tanpa data sensitif).</li><li>Jika ada, rekomendasi mitigasi awal.</li></ul>
<h3>Proses penanganan</h3>
<ol><li>Triase: verifikasi laporan dan klasifikasi tingkat keparahan.</li><li>Mitigasi cepat jika dampaknya tinggi.</li><li>Perbaikan permanen dan pengujian regresi.</li><li>Komunikasi status hingga isu tertutup.</li></ol>
<h3>Etika responsible disclosure</h3>
<ul><li>Hindari mengakses data pengguna yang tidak perlu.</li><li>Berikan waktu wajar untuk perbaikan sebelum publikasi.</li><li>Jangan melakukan tindakan yang mengganggu layanan (misalnya stress test tanpa izin).</li></ul>
<p>Dengan kerja sama yang bertanggung jawab, kita bisa membuat ekosistem digital lebih aman untuk semua pihak.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 11:00:00',
                'featured_image' => 'https://example.com/images/posts/sec-disclosure.jpg',
                'seo_title' => 'Proses Pelaporan Kerentanan yang Bertanggung Jawab',
                'seo_description' => 'Responsible disclosure: cara melapor kerentanan, info yang dibutuhkan, triase, update status, dan mitigasi.',
                'canonical_url' => 'https://example.com/blog/keamanan-proses-pelaporan-kerentanan-yang-bertanggung-jawab',
                'meta' => [
                    'tags' => [
                        'keamanan',
                        'vulnerability',
                        'disclosure',
                        'triage',
                        'responsible'
                    ],
                    'reading_time' => 10
                ],
                'category_key' => 'security',
            ],
            [
                'title' => 'Infrastruktur: Strategi Backup dan Disaster Recovery',
                'excerpt' => 'Backup dan DR plan memastikan layanan tetap pulih cepat saat terjadi gangguan atau kehilangan data.',
                'content' => '<p>Backup dan disaster recovery (DR) adalah fondasi reliability. Pertanyaannya bukan apakah insiden akan terjadi, tetapi kapan. DR plan yang baik membantu organisasi pulih cepat dengan dampak minimal.</p>
<h3>Dua metrik penting: RPO dan RTO</h3>
<ul><li><strong>RPO</strong> (Recovery Point Objective): seberapa banyak data yang boleh hilang (misalnya 15 menit).</li><li><strong>RTO</strong> (Recovery Time Objective): berapa lama layanan harus pulih (misalnya 2 jam).</li></ul>
<h3>Komponen strategi backup</h3>
<ul><li>Backup terjadwal dan terenkripsi.</li><li>Penyimpanan di lokasi terpisah (offsite) untuk menghindari single point of failure.</li><li>Retensi yang jelas: harian, mingguan, bulanan sesuai kebutuhan audit.</li></ul>
<h3>Kenapa uji pemulihan wajib</h3>
<p>Backup tanpa uji pemulihan adalah asumsi. Uji pemulihan membantu memastikan prosedur benar, kredensial tersedia, dan tim tahu langkah-langkahnya ketika situasi darurat.</p>
<h3>Ritme yang disarankan</h3>
<ul><li>Tabletop exercise: simulasi skenario dan keputusan, misalnya per kuartal.</li><li>DR drill: uji pemulihan teknis di lingkungan terkontrol, misalnya 2x setahun.</li><li>Review runbook: setiap ada perubahan arsitektur atau dependensi.</li></ul>
<h3>Kesalahan umum</h3>
<ul><li>Mengandalkan backup manual tanpa otomatisasi.</li><li>Tidak memisahkan kredensial backup dari sistem utama.</li><li>Tidak mendokumentasikan runbook sehingga pemulihan bergantung pada satu orang.</li></ul>
<p>Mulailah dari sistem paling kritikal, lalu perluas cakupan DR secara bertahap. Dengan cara ini, reliability meningkat tanpa membuat biaya dan kompleksitas meledak.</p>',
                'status' => 'published',
                'published_at' => '2026-01-07 09:00:00',
                'featured_image' => 'https://example.com/images/posts/infra-backup-dr.jpg',
                'seo_title' => 'Strategi Backup dan Disaster Recovery',
                'seo_description' => 'Panduan backup & DR: RPO/RTO, enkripsi, dan uji pemulihan berkala agar layanan cepat pulih saat insiden.',
                'canonical_url' => 'https://example.com/blog/infrastruktur-strategi-backup-dan-disaster-recovery',
                'meta' => [
                    'tags' => [
                        'infrastruktur',
                        'backup',
                        'disaster recovery',
                        'reliability',
                        'runbook'
                    ],
                    'reading_time' => 12
                ],
                'category_key' => 'infrastructure',
            ],
            [
                'title' => 'Infrastruktur: Scaling Database untuk Beban Tinggi',
                'excerpt' => 'Scaling database bisa dimulai dari optimasi query, index, read replica, hingga sharding sesuai kebutuhan.',
                'content' => '<p>Ketika beban meningkat, database sering menjadi bottleneck pertama. Kunci scaling database adalah urutan: mulai dari perbaikan yang paling murah, lalu lanjut ke perubahan arsitektur yang lebih besar jika benar-benar diperlukan.</p>
<h3>1) Mulai dari observasi</h3>
<ul><li>Identifikasi query lambat (slow query log).</li><li>Lihat pola lock dan contention.</li><li>Ukur latency per endpoint dan korelasikan dengan query.</li></ul>
<h3>2) Optimasi query dan index</h3>
<p>Banyak kasus performa membaik drastis hanya dengan index yang tepat atau perbaikan query. Pastikan juga Anda menghindari N+1 query di aplikasi.</p>
<h3>3) Caching dan connection pooling</h3>
<p>Caching mengurangi beban baca, sementara pooling menjaga koneksi tidak meledak saat traffic naik.</p>
<h3>4) Read replica dan pemisahan beban</h3>
<ul><li>Arahkan beban baca ke replica.</li><li>Pastikan aplikasi paham konsistensi data (replica ada lag).</li></ul>
<h3>5) Partitioning dan sharding</h3>
<p>Jika data sangat besar, partitioning membantu query lebih cepat. Sharding adalah langkah besar yang menambah kompleksitas operasional, sehingga harus dipertimbangkan matang.</p>
<h3>Checklist sebelum melangkah lebih jauh</h3>
<ul><li>Apakah masalahnya benar-benar database, bukan aplikasi atau cache.</li><li>Apakah query sudah dioptimasi dan index tepat.</li><li>Apakah pola akses data bisa diubah (misalnya pre-aggregation).</li></ul>
<p>Scaling yang sehat adalah kombinasi teknik dan disiplin operasional: ukur, perbaiki, uji, lalu rollout bertahap.</p>',
                'status' => 'published',
                'published_at' => '2026-01-12 09:30:00',
                'featured_image' => 'https://example.com/images/posts/infra-scaling-db.jpg',
                'seo_title' => 'Scaling Database untuk Beban Tinggi',
                'seo_description' => 'Scaling database: optimasi query & index, caching, read replica, hingga sharding—pilih berdasarkan metrik.',
                'canonical_url' => 'https://example.com/blog/infrastruktur-scaling-database-untuk-beban-tinggi',
                'meta' => [
                    'tags' => [
                        'infrastruktur',
                        'database',
                        'scaling',
                        'performa',
                        'ops'
                    ],
                    'reading_time' => 12
                ],
                'category_key' => 'infrastructure',
            ],
            [
                'title' => 'Infrastruktur: Migrasi Bertahap ke Kubernetes',
                'excerpt' => 'Migrasi ke Kubernetes lebih aman jika dilakukan bertahap: observability dulu, lalu layanan non-kritis, kemudian inti.',
                'content' => '<p>Kubernetes dapat membantu konsistensi deployment, autoscaling, dan standar operasional. Namun migrasi yang terburu-buru bisa menambah risiko. Karena itu, pendekatan bertahap adalah pilihan paling aman.</p>
<h3>Pra-syarat sebelum migrasi</h3>
<ul><li>CI/CD yang stabil dan repeatable.</li><li>Logging dan monitoring yang memadai (observability).</li><li>Standar container image dan security scanning.</li></ul>
<h3>Tahap migrasi yang disarankan</h3>
<ol><li>Mulai dari layanan non-kritis untuk membangun pengalaman tim.</li><li>Standarkan konfigurasi: resource request/limit, liveness/readiness probe.</li><li>Aktifkan autoscaling pada beban yang fluktuatif.</li><li>Migrasikan layanan inti setelah pola operasional stabil.</li></ol>
<h3>Hal yang sering menjadi jebakan</h3>
<ul><li>Tidak mengatur resource limit sehingga node cepat penuh.</li><li>Tidak menyiapkan strategi rollout dan rollback.</li><li>Mengabaikan observability sehingga debugging lebih sulit.</li></ul>
<h3>Operasional setelah migrasi</h3>
<ul><li>Tetapkan runbook incident: scaling, restart, dan mitigasi.</li><li>Review biaya: autoscaling perlu batas agar tidak boros.</li><li>Lakukan game day: simulasi kegagalan untuk melatih tim.</li></ul>
<p>Migrasi Kubernetes bukan tujuan akhir. Tujuan akhirnya adalah sistem yang lebih andal, deployment lebih konsisten, dan operasional lebih terukur.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 08:45:00',
                'featured_image' => 'https://example.com/images/posts/infra-kubernetes.jpg',
                'seo_title' => 'Migrasi Bertahap ke Kubernetes',
                'seo_description' => 'Strategi migrasi Kubernetes: observability, layanan non-kritis, standard resource, autoscaling, dan rollout terukur.',
                'canonical_url' => 'https://example.com/blog/infrastruktur-migrasi-bertahap-ke-kubernetes',
                'meta' => [
                    'tags' => [
                        'infrastruktur',
                        'kubernetes',
                        'deployment',
                        'devops',
                        'migration'
                    ],
                    'reading_time' => 12
                ],
                'category_key' => 'infrastructure',
            ],
        ];

        foreach ($posts as $postData) {
            $categoryKey = $postData['category_key'];
            unset($postData['category_key']);

            $post = Post::updateOrCreate(
                ['slug' => Str::slug($postData['title'])],
                array_merge($postData, [
                    'author_id' => $authorId,
                ])
            );

            // Populate pivot table
            if (isset($categoryIds[$categoryKey])) {
                DB::table('post_category')->updateOrInsert(
                    [
                        'post_id' => $post->id,
                        'post_category_id' => $categoryIds[$categoryKey],
                    ]
                );
            }
        }
    }
}
