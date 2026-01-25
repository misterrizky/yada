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
                'title' => 'International Grant Program Application Development Briefing - Phase 1',
                'excerpt' => 'The Phase 1 International Grant Program application briefing covered scope, end-to-end flow, and the implementation plan to speed up submissions, verification, monitoring, and reporting in a structured and transparent way.',
                'content' => '
                <p>
                    On Friday (12/17/2021), the team presented Phase 1 of the International Grant Program application as part of the effort to improve grant administration with clearer documentation and traceability. The briefing emphasized digitizing the process so submission, verification, monitoring, and reporting can move faster with fewer administrative errors.
                </p>
                <p>
                    Phase 1 focuses on the system foundation that includes master data management, submission flow, and multi-step verification and approval. With this approach, each step can be tracked in real time, including an audit trail to ensure accountability.
                </p>
                <p>
                    The Phase 1 scope includes:
                </p>
                <ul>
                    <li><strong>User and Role Management</strong>: access control aligned with responsibilities.</li>
                    <li><strong>Grant Submission</strong>: data entry, required document upload, and basic validation.</li>
                    <li><strong>Document Verification</strong>: structured checks for completeness and conformity.</li>
                    <li><strong>Multi-level Approval</strong>: SOP-based approvals with revision notes and comments.</li>
                    <li><strong>Monitoring Dashboard</strong>: status summaries, verification progress, and follow-up notifications.</li>
                    <li><strong>Initial Reporting</strong>: submission recaps and process status for internal evaluation.</li>
                </ul>
                <p>
                    On the technical side, the briefing also highlighted data security standards (access management, activity logging, and document control) and a staged integration plan with supporting systems if needed in later phases. The implementation is modular so it can be expanded for Phase 2 and beyond.
                </p>
                <p>
                    With the International Grant Program application, grant management is expected to become more orderly, transparent, and efficient - from submission and verification to approval and reporting. Phase 1 establishes a stable base that can be improved as operational needs evolve.
                </p>',
                'status' => 'published',
                'published_at' => '2021-12-17 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-hibah-luar-negeri-tahap-1.jpg',
                'seo_title' => 'International Grant Program Application Development Briefing - Phase 1',
                'seo_description' => 'Summary of the Phase 1 International Grant Program app briefing: submission, verification, multi-level approval, monitoring, and initial reporting for transparent grant governance.',
                'canonical_url' => 'https://yex.co.id/blogs/paparan-pengembangan-aplikasi-program-hibah-luar-negeri-tahap-1',
                'meta' => [
                    'tags' => ['international grants', 'grant application', 'digital transformation', 'governance', 'monitoring', 'reporting'],
                    'reading_time' => 5,
                    'event_date' => '2021-12-17',
                    'phase' => 'Phase 1',
                    'scope' => [
                        'User and role management',
                        'Grant submission and document upload',
                        'Document verification',
                        'Multi-level approval',
                        'Monitoring dashboard',
                        'Initial reporting',
                    ],
                    'notes' => [
                        'Phase 1 focuses on the end-to-end foundation and readiness for the next phase of development.',
                    ],
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => 'eOffice Dukcapil Application Development Briefing at the Ministry of Home Affairs',
                'excerpt' => 'The July 27, 2022 briefing covered eOffice Dukcapil, a web-based system to digitize correspondence, population data, and paperless administration for faster, safer services.',
                'content' => '
                <p>
                    On Wednesday (07/27/2022), the Ministry of Home Affairs held a briefing on the eOffice Dukcapil initiative as part of the public service transformation to make administrative work more efficient.
                </p>
                <p>
                    Electronic Office (eOffice) is a web-based application that digitizes correspondence and population administration. Official letters, staffing data, civil registration, and sensitive documents previously stored on paper can be accessed securely in digital form. Incoming and outgoing mail - from drafts and approvals to numbering and distribution - can be managed digitally.
                </p>
                <p>
                    The improvements benefit staff and leaders by enabling electronic signatures and monitoring regional performance progress.
                </p>
                <p>
                    The system supports online reporting in line with Ministry Regulation No. 53/2019 (Article 11(3) and Article 14), requiring reports to be submitted through SIAK by authorized users.
                </p>
                <p>
                    Additional benefits include better internal coordination and analytics to support promotion and retirement planning based on defined criteria.
                </p>
                <p>
                    The paperless approach also reduces printing costs (security printing for population documents) and supports sustainability by lowering paper usage.
                </p>
                <p>
                    Overall, the digital transformation is expected to raise service quality and help agencies deliver faster and more professional public services.
                </p>',
                'status' => 'published',
                'published_at' => '2022-07-27 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-eoffice-dukcapil-kemendagri.jpg',
                'seo_title' => 'eOffice Dukcapil Development Briefing (Ministry of Home Affairs)',
                'seo_description' => 'The Ministry of Home Affairs presented eOffice Dukcapil to digitize correspondence and population documents in a faster, safer, paperless workflow.',
                'canonical_url' => 'https://yex.co.id/blogs/paparan-pengembangan-aplikasi-eoffice-dukcapil-kementerian-dalam-negeri-republik-indonesia',
                'meta' => [
                    'tags' => ['eoffice', 'dukcapil', 'ministry of home affairs', 'digital transformation', 'paperless', 'siak'],
                    'reading_time' => 7,
                    'event_date' => '2022-07-27',
                    'institutions' => ['Ministry of Home Affairs', 'Dukcapil'],
                    'references' => [
                        'Permendagri 53/2019 Article 11(3)',
                        'Permendagri 53/2019 Article 14',
                    ],
                    'highlights' => [
                        'Digitized correspondence and population documents',
                        'Electronic signatures and performance monitoring',
                        'Paperless efficiency (security printing) about Rp450B per year',
                    ],
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => 'Defense Ministry Hosts Indo Defence 2022 Expo and Forum, an International Defense Industry Exhibition',
                'excerpt' => 'Indo Defence 2022 Expo and Forum took place Nov 2-5, 2022 at JIExpo Kemayoran, featuring hundreds of defense industries plus aircraft and naval ship displays.',
                'content' => '
                <p>
                    The Ministry of Defense announced the Indo Defence 2022 Expo and Forum, an international defense industry exhibition held on November 2-5, 2022 at JIExpo Kemayoran, Jakarta, under the theme "Peace, Prosperity, Strong Defence."
                </p>
                <p>
                    The main exhibition ran from Wednesday (11/02/2022) to Saturday (11/05/2022). Professional visitors were served from Wednesday to Friday, while the public day was Saturday with an entry fee of Rp 50,000.
                </p>
                <p>
                    Supporting events included an Aircraft Display at Halim Perdanakusuma Air Force Base and a Naval Ship Display at the Indonesian Navy Pondok Dayung Pier, both open to invited guests and the public with specific requirements. Registration and shuttle buses were provided at JIExpo Kemayoran.
                </p>
                <p>
                    The biennial exhibition was expected to involve more than 900 industries from 57 countries. Indonesia has 207 defense industries, with 151 confirmed to participate. Exhibits ranged from small arms to armored vehicles, aircraft, warships, and components.
                </p>
                <p>
                    Visitors were encouraged to register at https://visitorreg.id/q/IDD22 and find more information at the official sites.
                </p>
                <p>
                    Officials emphasized that the event supports domestic industry development, export opportunities, and collaboration across business-to-business and government-to-government channels.
                </p>
                <h3 class="qrt-mb-20">Opportunities for Indonesia</h3>
                <p>
                    The expo is positioned as a strategic platform to promote defense products and services and strengthen industry capacity through marketing and partnerships.
                </p>
                <p class="">
                    Officials noted the export potential of local products already used abroad, such as LPD-class landing platform docks, transport aircraft, and small arms. The event was expected to proceed despite global tensions, reinforcing the commitment of Indonesia to industry development.
                </p>
                <p class="">
                    The forum also enables communication, cooperation, and transactions among industry players, aligned with national defense procurement plans and budgets.
                </p>',
                'status' => 'published',
                'published_at' => '2022-11-02 00:00:00',
                'featured_image' => 'https://example.com/images/posts/indo-defence-2022-expo-forum.jpg',
                'seo_title' => 'Indo Defence 2022 Expo and Forum: Schedule, Venue, and Visitor Info',
                'seo_description' => 'Indo Defence 2022 Expo and Forum runs Nov 2-5, 2022 at JIExpo Kemayoran with professional and public sessions, supporting displays, and registration details.',
                'canonical_url' => 'https://yex.co.id/blogs/kementerian-pertahanan-gelar-indo-defence-2022-expo-forum-pameran-industri-pertahanan-bertaraf-internasional',
                'meta' => [
                    'tags' => ['indo defence', 'ministry of defense', 'exhibition', 'defense industry', 'armaments', 'jieexpo kemayoran'],
                    'reading_time' => 6,
                    'event' => [
                        'name' => 'Indo Defence 2022 Expo and Forum',
                        'theme' => 'Peace, Prosperity, Strong Defence',
                        'main_event_location' => 'JIExpo Kemayoran, Jakarta',
                        'main_event_dates' => ['2022-11-02', '2022-11-05'],
                        'supporting_events' => [
                            [
                                'name' => 'Aircraft Display',
                                'location' => 'Halim Perdanakusuma Air Force Base',
                                'dates' => ['2022-11-03', '2022-11-04'],
                            ],
                            [
                                'name' => 'Naval Ship Display',
                                'location' => 'Indonesian Navy Pondok Dayung Pier',
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
                        'Schedule and visitor sessions follow the article details.',
                    ],
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => 'Non-Permanent Resident Application Development Briefing (Dukcapil, Ministry of Home Affairs)',
                'excerpt' => 'The briefing covered digital data collection and mobility monitoring for non-permanent residents so reporting is more structured and accurate.',
                'content' => '
                <p>
                    On Wednesday (09/14/2022), Dukcapil at the Ministry of Home Affairs held a briefing on the Non-Permanent Resident application as part of efforts to strengthen population administration through structured digital data collection, verification, and reporting.
                </p>
                <p>
                    The application helps local offices record residents who temporarily live in an area, including identity data, temporary address, length of stay, and supporting information in line with regulations. A digital workflow is expected to improve efficiency, traceability, and reduce duplicate data.
                </p>
                <p>
                    The development scope includes:
                </p>
                <ul>
                    <li><strong>Data Management</strong>: non-permanent resident records, basic validation, and regional master data.</li>
                    <li><strong>Registration and Verification</strong>: data input flow and document completeness with verification status.</li>
                    <li><strong>Monitoring Dashboard</strong>: regional summaries, mobility trends, and oversight indicators.</li>
                    <li><strong>Reporting</strong>: periodic reports and data export for internal needs.</li>
                    <li><strong>Audit Trail</strong>: activity logs for data change accountability.</li>
                </ul>
                <p>
                    Operationally, the application supports cross-unit coordination with clear notifications and process status. Data security is a key focus, including role-based access control, document governance, and good practices for population data management.
                </p>
                <p>
                    The program aims to make data collection faster, more accurate, and transparent to support public service planning and data-driven decisions at the regional level.
                </p>',
                'status' => 'published',
                'published_at' => '2022-09-14 00:00:00',
                'featured_image' => 'https://example.com/images/posts/paparan-penduduk-non-permanen-dukcapil.jpg',
                'seo_title' => 'Non-Permanent Resident App Development Briefing (Dukcapil)',
                'seo_description' => 'Summary of the Non-Permanent Resident app briefing: digital data collection, verification, monitoring dashboards, and reporting for efficient population services.',
                'canonical_url' => 'https://yex.co.id/blogs/paparan-pengembangan-aplikasi-penduduk-non-permanen-dukcapil-kementerian-dalam-negeri-republik-indonesia',
                'meta' => [
                    'tags' => ['dukcapil', 'ministry of home affairs', 'non-permanent residents', 'population administration', 'digital transformation', 'monitoring'],
                    'reading_time' => 5,
                    'event_date' => '2022-09-14',
                    'institution' => 'Dukcapil, Ministry of Home Affairs of the Republic of Indonesia',
                    'highlights' => [
                        'Data collection and validation for non-permanent residents',
                        'Structured verification and process status',
                        'Monitoring dashboards and periodic reporting',
                        'Audit trail for accountability',
                    ],
                    'features_scope' => [
                        'Data management and regional master data',
                        'Registration and verification',
                        'Monitoring dashboard',
                        'Reporting and data export',
                        'Role-based access control',
                    ],
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => 'Announcement: Opening the Surabaya Branch Office',
                'excerpt' => 'We are expanding service coverage with a Surabaya branch to speed response and customer support in East Java.',
                'content' => '<p>Starting January 2026, we officially opened the Surabaya branch office. This decision comes from rising support demand in East Java and our commitment to deliver service that is closer, faster, and consistent.</p>
                <p>With a local team, customers do not need to wait for visits from other cities for onboarding, workshops, or process optimization discussions. The goal is simple: reduce friction, speed adoption, and ensure a clean implementation from day one.</p>
                <h3>Service focus in the Surabaya branch</h3>
                <ul><li><strong>Structured onboarding</strong>: initial configuration, role mapping, and template adjustments aligned with internal SOP</li><li><strong>Implementation support</strong>: review approval flows, notifications, and basic integrations if needed</li><li><strong>Operational support</strong>: daily issue handling, admin training, and monthly evaluations</li><li><strong>Process improvement workshops</strong>: identify bottlenecks and data-driven improvement recommendations</li></ul>
                <h3>Impact for customers</h3>
                <p>We target faster response for time-sensitive needs such as configuration changes that block workflows or training needs when admin roles change. A local team also helps keep customer documentation consistent and easy to audit.</p>
                <h3>Next steps</h3>
                <ol><li>If you are in East Java, our team will contact you to schedule an introduction and needs mapping.</li><li>For new customers, onboarding can be scheduled more flexibly (online or on-site).</li><li>For existing customers, we prepare a light configuration audit session to keep setups aligned with the latest SOP.</li></ol>
                <h3>Contact and schedule</h3>
                <p>Please contact the support team to schedule sessions. We will also announce monthly workshops that customers can join for free.</p>
                <p>Thank you for your trust. We grow with your needs, and Surabaya is an important step to deliver service that is closer and more impactful.</p>',
                'status' => 'published',
                'published_at' => '2026-01-10 09:00:00',
                'featured_image' => 'https://example.com/images/posts/cn-cabang-surabaya.jpg',
                'seo_title' => 'Announcement: Opening the Surabaya Branch Office',
                'seo_description' => 'We opened a Surabaya branch to speed service, onboarding, and customer support in East Java.',
                'canonical_url' => 'https://yex.co.id/blogs/pengumuman-pembukaan-kantor-cabang-surabaya',
                'meta' => [
                    'tags' => [
                        'announcement',
                        'expansion',
                        'customer support',
                        'surabaya',
                        'onboarding',
                    ],
                    'reading_time' => 9,
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => '2025 Performance Report: Higher Stability, Faster Response',
                'excerpt' => 'Throughout 2025 we improved system stability and support response time through process and tooling upgrades.',
                'content' => '<p>Year 2025 was a consolidation year: we strengthened service stability and built more disciplined operational habits. The focus was not only to add features, but to ensure existing capabilities run more reliably and are easier to monitor.</p>
                <h3>Key highlights</h3>
                <ul><li><strong>Monitoring improvements</strong>: alerts are more precise, reducing noise that is not actionable</li><li><strong>Incident response upgrades</strong>: clearer escalation paths, faster triage, and consistent postmortem documentation</li><li><strong>Support SOP standardization</strong>: repeat cases are handled faster with clear playbooks</li><li><strong>Performance gains</strong>: query optimization for critical dashboards and periodic reports</li></ul>
                <h3>How our work habits evolved</h3>
                <p>We adopted simple but impactful routines: weekly service metric reviews, runbook updates, and data-driven improvement prioritization. This helps recurring issues get solved at the root rather than with quick patches.</p>
                <h3>Key lessons from 2025</h3>
                <ul><li>Good alerts answer what is broken, how severe it is, and the first mitigation step.</li><li>Incident documentation helps new team members debug faster and reduces single points of knowledge.</li><li>Dashboard performance often signals query or index issues and should be monitored routinely.</li></ul>
                <h3>Focus areas for 2026</h3>
                <ol><li>Expand automation from initial triage to faster mitigation recommendations.</li><li>Improve transparency with a cleaner status page and incident communication.</li><li>Deepen security with stronger access control, audit trails, and credential rotation practices.</li></ol>
                <p>We will continue to share updates so customers can follow our service improvements and reliability work.</p>',
                'status' => 'published',
                'published_at' => '2026-01-12 11:30:00',
                'featured_image' => 'https://example.com/images/posts/cn-laporan-2025.jpg',
                'seo_title' => '2025 Performance Report: Higher Stability, Faster Response',
                'seo_description' => '2025 highlights: improved stability, monitoring, and support processes for faster response times.',
                'canonical_url' => 'https://yex.co.id/blogs/laporan-kinerja-2025-stabilitas-naik-respons-lebih-cepat',
                'meta' => [
                    'tags' => [
                        'report',
                        'performance',
                        'stability',
                        'support',
                        'operational excellence',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'company_news',
            ],

            [
                'title' => 'CSR Program: Digital Literacy Training for Communities',
                'excerpt' => 'We run digital literacy CSR programs to help communities improve productivity and online safety.',
                'content' => '<p>Wider digital access brings two sides: productivity opportunities and security risks. Through our CSR program, we provide digital literacy training for local communities so technology use becomes safer and more useful.</p>
                <h3>Why digital literacy matters</h3>
                <p>Many security incidents start from simple issues such as scam links, weak credentials, or careless data sharing. At the same time, many people do not yet use digital tools to save time, organize documents, and collaborate effectively.</p>
                <h3>Topics covered</h3>
                <ul><li><strong>Basic security</strong>: recognize scam links, avoid risky sources, and verify information</li><li><strong>Account protection</strong>: create strong credentials, use credential managers, and enable multi-factor authentication</li><li><strong>Productivity</strong>: document management, file naming, version control, and paperless practices</li><li><strong>Privacy</strong>: what data should not be shared and how to manage privacy settings</li></ul>
                <h3>Training format</h3>
                <p>Sessions are short, hands-on, and case-based. Participants practice enabling multi-factor authentication, organizing folders, and spotting common scam patterns.</p>
                <h3>Expected impact</h3>
                <ul><li>Communities build safer digital habits and stronger risk awareness.</li><li>Productivity improves because documents are organized and easier to find.</li><li>A learning network forms as participants share good practices after the training.</li></ul>
                <p>We believe the best contribution is consistent. This program will continue regularly and materials will be updated with new risk patterns in the field.</p>',
                'status' => 'published',
                'published_at' => '2026-01-15 15:00:00',
                'featured_image' => 'https://example.com/images/posts/cn-csr-literasi-digital.jpg',
                'seo_title' => 'CSR Program: Digital Literacy Training for Communities',
                'seo_description' => 'Digital literacy CSR program: online security, productivity habits, and paperless practices for communities.',
                'canonical_url' => 'https://yex.co.id/blogs/program-csr-pelatihan-literasi-digital-untuk-komunitas',
                'meta' => [
                    'tags' => [
                        'csr',
                        'digital literacy',
                        'community',
                        'security',
                        'productivity',
                    ],
                    'reading_time' => 9,
                ],
                'category_key' => 'company_news',
            ],
            [
                'title' => 'Product Packages Explained: Basic, Pro, and Enterprise',
                'excerpt' => 'A quick guide to choosing a plan based on team needs, usage scale, and access control requirements.',
                'content' => '<p>Choosing the right package makes implementation smoother and costs more efficient. Below is a practical guide to understand the differences between Basic, Pro, and Enterprise and when to upgrade.</p>
                <h3>Quick overview of each package</h3>
                <ul><li><strong>Basic</strong>: core features to get started and build clean working habits</li><li><strong>Pro</strong>: automation, integrations, and deeper analytics for growing teams</li><li><strong>Enterprise</strong>: stronger controls, auditing, and implementation support for organizations with strict governance</li></ul>
                <h3>How to choose based on needs</h3>
                <h4>1) Team size and process complexity</h4>
                <p>If your team is small and processes are simple, Basic is usually enough. When approvals grow, multiple units are involved, or documents go through many revisions, Pro becomes more valuable because automation and reporting are stronger.</p>
                <h4>2) Access control and compliance</h4>
                <p>Organizations that need audit trails, granular access policies, and compliance requirements usually fit Enterprise. It helps ensure every change is traceable and access does not exceed authority.</p>
                <h4>3) Reporting and insights</h4>
                <p>If you need routine reports for management or want to monitor bottlenecks, Pro and Enterprise offer stronger dashboards and export options.</p>
                <h3>Example scenarios</h3>
                <ul><li><strong>Basic</strong>: teams of 5-20, simple workflows, starting paperless practices.</li><li><strong>Pro</strong>: teams of 20-200, many request types, need integrations and reporting.</li><li><strong>Enterprise</strong>: cross-division, strict access policies, periodic audits, need SLA and implementation assistance.</li></ul>
                <h3>Implementation tips to avoid missteps</h3>
                <ol><li>Start with the most frequent process so adoption shows results quickly.</li><li>Assign process owners and admins responsible for templates and roles.</li><li>Collect feedback during the first 2-4 weeks, then refine configuration.</li><li>Upgrade when the need is clear, not only because a feature looks attractive.</li></ol>
                <p>If you want, our team can run a short assessment to map needs and recommend the most efficient package.</p>',
                'status' => 'published',
                'published_at' => '2026-01-08 10:00:00',
                'featured_image' => 'https://example.com/images/posts/pd-paket-produk.jpg',
                'seo_title' => 'Product Packages Explained: Basic, Pro, and Enterprise',
                'seo_description' => 'Choose Basic, Pro, or Enterprise based on team scale, access control, and reporting needs.',
                'canonical_url' => 'https://yex.co.id/blogs/mengenal-paket-produk-basic-pro-dan-enterprise',
                'meta' => [
                    'tags' => [
                        'product',
                        'pricing',
                        'packages',
                        'enterprise',
                        'onboarding',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'products',
            ],

            [
                'title' => 'Product: API Integrations for Workflow Automation',
                'excerpt' => 'Integrate with other systems via API to automate approvals, sync data, and send notifications.',
                'content' => '<p>Connect the product with ERP, CRM, HRIS, or internal portals through APIs to automate approvals, sync master data, and trigger notifications. Start with one critical flow, test in staging, then roll out gradually while monitoring error rate and latency.</p>',
                'status' => 'published',
                'published_at' => '2026-01-11 13:00:00',
                'featured_image' => 'https://example.com/images/posts/pd-integrasi-api.jpg',
                'seo_title' => 'API Integration for Workflow Automation',
                'seo_description' => 'Use APIs for approval automation, data synchronization, and notifications with a staged rollout.',
                'canonical_url' => 'https://yex.co.id/blogs/integrasi-api-untuk-otomasi-alur-kerja',
                'meta' => [
                    'tags' => [
                        'product',
                        'api',
                        'integration',
                        'automation',
                        'webhook',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'products',
            ],
            [
                'title' => 'Product: KPI Dashboard for Process Monitoring',
                'excerpt' => 'KPI dashboards help track bottlenecks and performance trends over time.',
                'content' => '<p>KPI dashboards help teams monitor process health without opening each item. With the right KPIs, you can see bottlenecks, prioritize improvements, and report progress to stakeholders clearly.</p>
                <h3>Common KPIs</h3>
                <ul><li><strong>Completion time</strong> by process type and unit.</li><li><strong>Request volume</strong> per period (daily, weekly, monthly).</li><li><strong>Revision ratio</strong> and the stage most often causing revisions.</li><li><strong>SLA compliance</strong> if service targets are defined.</li></ul>
                <h3>How to read dashboards correctly</h3>
                <ul><li>Do not only look at averages; check distribution and outliers.</li><li>Compare equivalent periods (this month vs last month) to avoid seasonal bias.</li><li>Look for correlations: higher volume often drives longer completion time if capacity does not increase.</li></ul>
                <h3>Make dashboards more actionable</h3>
                <ol><li>Define metrics consistently (for example, when time starts counting).</li><li>Segment by unit, request type, and approval stage.</li><li>Add common filters so users can find insights quickly.</li><li>Include recommendations, such as the five slowest processes.</li></ol>
                <h3>Example improvements from KPI findings</h3>
                <ul><li>If revisions are high in verification, improve templates and add completeness checklists.</li><li>If bottlenecks are with a specific approver, consider delegation or routing rules.</li><li>If dashboards are slow, review caching and report query performance.</li></ul>
                <p>Use KPI dashboards as a process improvement tool, not just a report. The most value appears when data turns into decisions and cleaner work habits.</p>',
                'status' => 'published',
                'published_at' => '2026-01-16 09:30:00',
                'featured_image' => 'https://example.com/images/posts/pd-dashboard-kpi.jpg',
                'seo_title' => 'KPI Dashboard for Process Monitoring',
                'seo_description' => 'Track bottlenecks and performance trends with KPI dashboards: completion time, volume, and revision ratios.',
                'canonical_url' => 'https://yex.co.id/blogs/dashboard-kpi-untuk-monitoring-proses',
                'meta' => [
                    'tags' => [
                        'product',
                        'dashboard',
                        'kpi',
                        'monitoring',
                        'analytics',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'products',
            ],
            [
                'title' => 'Technology: Observability Principles for Modern Apps',
                'excerpt' => 'Observability helps teams understand system behavior through logs, metrics, and traces.',
                'content' => '<p>Observability is the ability to understand internal system conditions from the signals the system produces. It is more than monitoring; observability helps explain why an issue happened, not only that it happened.</p>
                <h3>The three pillars of observability</h3>
                <ul><li><strong>Logs</strong>: event records with context for detailed investigation.</li><li><strong>Metrics</strong>: aggregated numbers such as latency, throughput, and error rate for trends and alerts.</li><li><strong>Traces</strong>: request journeys across services to locate bottlenecks and dependencies.</li></ul>
                <h3>Start with what matters most</h3>
                <p>If you are new to observability, do not instrument everything at once. Choose critical endpoints or flows, such as login, submission, or approval. Set simple SLOs like success rate and latency thresholds.</p>
                <h3>Healthy alerting</h3>
                <ul><li>Actionable: a clear first step exists.</li><li>Low noise: avoid notification spam.</li><li>Based on SLOs: focus on user experience, not irrelevant internal metrics.</li></ul>
                <h3>Good practices often missed</h3>
                <ul><li>Add correlation IDs so logs and traces can be linked.</li><li>Standardize log format and levels (info, warn, error).</li><li>Keep runbooks near alerts so responders know what to do.</li></ul>
                <h3>Example investigation flow</h3>
                <ol><li>An error rate alert increases for a specific endpoint.</li><li>Check traces to see which service is slow or failing.</li><li>Review logs for the same correlation IDs to get context.</li><li>Apply mitigation, then document a postmortem and permanent fix.</li></ol>
                <p>Good observability keeps teams calm: issues are detected faster, investigations are shorter, and fixes are more targeted.</p>',
                'status' => 'published',
                'published_at' => '2026-01-07 14:00:00',
                'featured_image' => 'https://example.com/images/posts/tech-observability.jpg',
                'seo_title' => 'Observability Principles for Modern Apps',
                'seo_description' => 'Learn observability with logs, metrics, and traces, starting from critical endpoints and SLO-based alerting.',
                'canonical_url' => 'https://yex.co.id/blogs/prinsip-observability-untuk-aplikasi-modern',
                'meta' => [
                    'tags' => [
                        'technology',
                        'observability',
                        'monitoring',
                        'sre',
                        'tracing',
                    ],
                    'reading_time' => 12,
                ],
                'category_key' => 'technology',
            ],

            [
                'title' => 'Technology: Event-Driven Architecture for Scalable Processes',
                'excerpt' => 'Event-driven approaches break large workflows into scalable, observable events.',
                'content' => '<p>Event-driven architecture (EDA) publishes important state changes as events, and other services react to those events. It works well for long, multi-stage, and cross-system workflows.</p>
                <h3>Why event-driven improves scalability</h3>
                <ul><li><strong>Decoupling</strong>: producers do not need to know their consumers.</li><li><strong>Asynchronous work</strong>: heavy processing can run in the background without blocking users.</li><li><strong>Extensible</strong>: add new consumers by subscribing to events without changing producers.</li></ul>
                <h3>Common EDA components</h3>
                <ul><li>Event broker or message queue for distribution.</li><li>Stable, documented event schemas.</li><li>Idempotent consumers with retry strategy.</li><li>Dead-letter queues for failed events.</li></ul>
                <h3>Design decisions to make early</h3>
                <ul><li><strong>Idempotency</strong>: repeated events must not corrupt data.</li><li><strong>Ordering</strong>: decide if event order must be preserved.</li><li><strong>Delivery semantics</strong>: at-least-once vs exactly-once and the trade-offs.</li><li><strong>Observability</strong>: trace events end-to-end from publish to completion.</li></ul>
                <h3>When EDA is not a fit</h3>
                <p>If a process is simple and synchronous flow is enough, EDA can add unnecessary complexity. Use EDA when decoupling and async execution are clearly needed.</p>
                <h3>Gradual adoption</h3>
                <ol><li>Start with one important event (for example, RequestCreated).</li><li>Build a simple consumer (for example, send notifications).</li><li>Add monitoring and processing metrics.</li><li>Expand use cases gradually.</li></ol>
                <p>With a clean design, EDA makes systems more resilient to spikes, easier to grow, and easier to audit through event trails.</p>',
                'status' => 'published',
                'published_at' => '2026-01-13 10:15:00',
                'featured_image' => 'https://example.com/images/posts/tech-event-driven.jpg',
                'seo_title' => 'Event-Driven Architecture for Scalable Processes',
                'seo_description' => 'Understand event-driven workflows: decoupling, audit trails, and why idempotency and retry matter.',
                'canonical_url' => 'https://yex.co.id/blogs/event-driven-architecture-untuk-proses-yang-skalabel',
                'meta' => [
                    'tags' => [
                        'technology',
                        'event-driven',
                        'architecture',
                        'scaling',
                        'message queue',
                    ],
                    'reading_time' => 12,
                ],
                'category_key' => 'technology',
            ],

            [
                'title' => 'Technology: Caching Strategies to Keep Apps Responsive',
                'excerpt' => 'Effective caching reduces database load and speeds responses, especially for dashboards and reports.',
                'content' => '<p>Caching stores frequently accessed data or computed results so later requests return faster. Poor caching can cause stale data or hard-to-trace bugs, so strategy matters.</p>
                <h3>Best places to cache</h3>
                <ul><li>Dashboards and reports accessed repeatedly.</li><li>Reference data that rarely changes (for example, unit and role lists).</li><li>Expensive aggregations (for example, monthly KPIs).</li></ul>
                <h3>Common caching patterns</h3>
                <ul><li><strong>Read-through</strong>: read from cache first, fall back to database when missing.</li><li><strong>Write-through</strong>: update cache when writing to the database.</li><li><strong>Cache-aside</strong>: application explicitly manages cache invalidation.</li></ul>
                <h3>Choosing a reasonable TTL</h3>
                <p>TTL depends on data characteristics. Reference data can use longer TTLs, while process status data may need short TTLs or invalidation on change. It is better to be slightly fresher than fast but wrong.</p>
                <h3>Metrics to monitor</h3>
                <ul><li><strong>Hit rate</strong>: how often cache is used versus database access.</li><li><strong>Latency</strong>: response time before and after caching.</li><li><strong>Staleness</strong>: how often users see out-of-date data.</li></ul>
                <h3>Common mistakes</h3>
                <ul><li>Not invalidating cache when data changes.</li><li>Inconsistent cache keys that overlap data.</li><li>Caching very dynamic data where invalidation is costlier than the benefit.</li></ul>
                <p>Good caching is a measured trade-off: fast but still correct and easy to operate.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 16:20:00',
                'featured_image' => 'https://example.com/images/posts/tech-caching.jpg',
                'seo_title' => 'Caching Strategies to Keep Apps Responsive',
                'seo_description' => 'Caching essentials: read-through, write-through, TTL choices, and evaluation with hit rate and latency.',
                'canonical_url' => 'https://yex.co.id/blogs/strategi-caching-agar-aplikasi-tetap-responsif',
                'meta' => [
                    'tags' => [
                        'technology',
                        'caching',
                        'performance',
                        'database',
                        'latency',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'technology',
            ],

            [
                'title' => 'Business & Strategy: Prioritizing with the RICE Framework',
                'excerpt' => 'RICE helps prioritize initiatives using Reach, Impact, Confidence, and Effort.',
                'content' => '<p>RICE (Reach, Impact, Confidence, Effort) helps teams compare initiatives with a consistent scoring method. Define reach and impact, set confidence, estimate effort, then review results together to make trade-offs transparent.</p>',
                'status' => 'published',
                'published_at' => '2026-01-06 09:45:00',
                'featured_image' => 'https://example.com/images/posts/biz-rice-framework.jpg',
                'seo_title' => 'Prioritizing with the RICE Framework',
                'seo_description' => 'Use RICE (Reach, Impact, Confidence, Effort) to prioritize initiatives more objectively.',
                'canonical_url' => 'https://yex.co.id/blogs/menentukan-prioritas-dengan-rice-framework',
                'meta' => [
                    'tags' => [
                        'business',
                        'strategy',
                        'prioritization',
                        'product management',
                        'framework',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'business',
            ],

            [
                'title' => 'Business & Strategy: Simple CAC and LTV Calculations',
                'excerpt' => 'CAC and LTV show acquisition efficiency and customer value over time.',
                'content' => '<p>CAC measures the cost to acquire a customer, while LTV measures the value you earn over the customer lifetime. Track both to judge channel efficiency, retention health, and how much you can invest in growth.</p>',
                'status' => 'published',
                'published_at' => '2026-01-09 12:10:00',
                'featured_image' => 'https://example.com/images/posts/biz-cac-ltv.jpg',
                'seo_title' => 'Simple CAC and LTV Calculations',
                'seo_description' => 'A simple way to calculate CAC and LTV to assess acquisition efficiency and customer value.',
                'canonical_url' => 'https://yex.co.id/blogs/mengukur-cac-dan-ltv-dengan-cara-sederhana',
                'meta' => [
                    'tags' => [
                        'business',
                        'metrics',
                        'cac',
                        'ltv',
                        'growth',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'business',
            ],

            [
                'title' => 'Business & Strategy: B2B Go-to-Market Playbook',
                'excerpt' => 'A B2B go-to-market playbook covering segmentation, positioning, channels, and feedback loops.',
                'content' => '<p>A strong B2B go-to-market plan starts with the right ICP, clear positioning, and a focused channel strategy. Build feedback loops from sales and onboarding so messaging and product keep improving.</p>',
                'status' => 'published',
                'published_at' => '2026-01-17 10:40:00',
                'featured_image' => 'https://example.com/images/posts/biz-gtm-b2b.jpg',
                'seo_title' => 'B2B Go-to-Market Playbook',
                'seo_description' => 'B2B go-to-market playbook: ICP, positioning, channel strategy, and feedback loops to speed growth.',
                'canonical_url' => 'https://yex.co.id/blogs/playbook-go-to-market-untuk-produk-b2b',
                'meta' => [
                    'tags' => [
                        'business',
                        'gtm',
                        'b2b',
                        'sales',
                        'marketing',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'business',
            ],

            [
                'title' => 'Career: Our Work Culture - Fast, Tidy, and Transparent',
                'excerpt' => 'How we work: clear documentation, open communication, and a focus on impact.',
                'content' => '<p>Our culture is built on fast execution without shortcuts, tidy processes that are easy to audit, and transparent communication that keeps teams aligned. We value clarity, feedback, and measurable impact.</p>',
                'status' => 'published',
                'published_at' => '2026-01-05 16:00:00',
                'featured_image' => 'https://example.com/images/posts/career-budaya-kerja.jpg',
                'seo_title' => 'Our Work Culture - Fast, Tidy, and Transparent',
                'seo_description' => 'Work culture built on transparency, tidy processes, and a focus on measurable impact.',
                'canonical_url' => 'https://yex.co.id/blogs/karier-budaya-kerja-kami-cepat-rapi-dan-transparan',
                'meta' => [
                    'tags' => [
                        'career',
                        'culture',
                        'team',
                        'collaboration',
                        'work style',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'career',
            ],

            [
                'title' => 'Career: 2026 Internship Program - Learn Through Real Projects',
                'excerpt' => 'The 2026 internship offers real project experience with mentoring and clear learning goals.',
                'content' => '<p>The 2026 internship program offers real project work with mentors and clear goals. Participants learn end-to-end delivery, from understanding the problem to presenting results.</p>',
                'status' => 'published',
                'published_at' => '2026-01-14 08:30:00',
                'featured_image' => 'https://example.com/images/posts/career-magang-2026.jpg',
                'seo_title' => '2026 Internship Program - Learn Through Real Projects',
                'seo_description' => 'Internship 2026: mentoring, learning goals, and hands-on project experience from start to finish.',
                'canonical_url' => 'https://yex.co.id/blogs/karier-program-magang-2026-belajar-dari-proyek-nyata',
                'meta' => [
                    'tags' => [
                        'career',
                        'internship',
                        'talent',
                        'learning',
                        'program',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'career',
            ],

            [
                'title' => 'Career: Interview Tips - What We Look For',
                'excerpt' => 'We assess thinking, communication, and execution, not memorized answers.',
                'content' => '<p>We look for structured thinking, clear communication, and the ability to execute. Bring real examples, explain your decisions, and show how you learn from results.</p>',
                'status' => 'published',
                'published_at' => '2026-01-20 19:00:00',
                'featured_image' => 'https://example.com/images/posts/career-tips-interview.jpg',
                'seo_title' => 'Interview Tips - What We Look For',
                'seo_description' => 'Interview tips: structured thinking, communication, and execution with real examples and lessons learned.',
                'canonical_url' => 'https://yex.co.id/blogs/karier-tips-interview-apa-yang-kami-nilai',
                'meta' => [
                    'tags' => [
                        'career',
                        'interview',
                        'recruiting',
                        'tips',
                        'hiring',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'career',
            ],

            [
                'title' => 'Event: Paperless Workflow Webinar for Operations Teams',
                'excerpt' => 'Practical webinar on paperless workflows, approvals, and reporting.',
                'content' => '<p>Practical webinar on templates, approvals, and reporting for operations teams.</p>',
                'status' => 'published',
                'published_at' => '2026-01-09 09:00:00',
                'featured_image' => 'https://example.com/images/posts/event-webinar-paperless.jpg',
                'seo_title' => 'Paperless Workflow Webinar for Operations Teams',
                'seo_description' => 'Paperless workflow webinar for templates, approvals, and reporting.',
                'canonical_url' => 'https://yex.co.id/blogs/event-webinar-paperless-workflow-untuk-tim-operasional',
                'meta' => [
                    'tags' => [
                        'event',
                        'webinar',
                        'paperless',
                        'operations',
                        'workflow',
                    ],
                    'reading_time' => 9,
                    'event_date' => '2026-02-05',
                ],
                'category_key' => 'event',
            ],

            [
                'title' => 'Event: Developer Community Meetup - Observability and Scaling',
                'excerpt' => 'Community session sharing observability practices, tracing, and scaling strategies.',
                'content' => '<p>Meetup focused on observability, tracing, and scaling patterns that teams can apply to improve reliability.</p>',
                'status' => 'published',
                'published_at' => '2026-01-16 18:00:00',
                'featured_image' => 'https://example.com/images/posts/event-meetup-observability.jpg',
                'seo_title' => 'Developer Community Meetup - Observability and Scaling',
                'seo_description' => 'Developer meetup on observability, tracing, and scaling strategies.',
                'canonical_url' => 'https://yex.co.id/blogs/event-meetup-komunitas-developer-observability-dan-scaling',
                'meta' => [
                    'tags' => [
                        'event',
                        'meetup',
                        'developer',
                        'observability',
                        'scaling',
                    ],
                    'reading_time' => 9,
                    'event_date' => '2026-02-12',
                ],
                'category_key' => 'event',
            ],

            [
                'title' => 'Event: Admin Training Roadshow - Access Control and Audit Trail',
                'excerpt' => 'Admin training on role-based access, audit trails, and governance basics.',
                'content' => '<p>Roadshow training for admins to strengthen access control and audit readiness.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 10:00:00',
                'featured_image' => 'https://example.com/images/posts/event-roadshow-admin.jpg',
                'seo_title' => 'Admin Training Roadshow - Access Control and Audit Trail',
                'seo_description' => 'Training on role-based access and audit trails for stronger governance.',
                'canonical_url' => 'https://yex.co.id/blogs/event-roadshow-pelatihan-admin-kontrol-akses-dan-audit-trail',
                'meta' => [
                    'tags' => [
                        'event',
                        'training',
                        'admin',
                        'governance',
                        'audit',
                    ],
                    'reading_time' => 10,
                    'event_date' => '2026-02-20',
                ],
                'category_key' => 'event',
            ],

            [
                'title' => 'Feature Release: Audit Trail for Data Changes',
                'excerpt' => 'Audit trails record critical changes for accountability and audits.',
                'content' => '<p>The audit trail release records who changed what and when, making reviews and investigations faster.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 09:15:00',
                'featured_image' => 'https://example.com/images/posts/fr-audit-trail.jpg',
                'seo_title' => 'Feature Release: Audit Trail for Data Changes',
                'seo_description' => 'Audit trails record who changed what and when, supporting accountability and audits.',
                'canonical_url' => 'https://yex.co.id/blogs/rilis-fitur-audit-trail-untuk-perubahan-data',
                'meta' => [
                    'tags' => [
                        'release',
                        'audit trail',
                        'accountability',
                        'compliance',
                        'log',
                    ],
                    'reading_time' => 10,
                    'changelog' => [
                        'Added audit trail for critical events',
                        'Added export audit log',
                        'Added filters by action and actor',
                    ],
                ],
                'category_key' => 'feature_release',
            ],

            [
                'title' => 'Feature Release: Real-Time Notifications for Approvals',
                'excerpt' => 'Real-time notifications keep approvers updated on new requests and revisions.',
                'content' => '<p>Real-time notifications alert approvers on new requests, revisions, and status changes to reduce waiting time.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 10:10:00',
                'featured_image' => 'https://example.com/images/posts/fr-notifikasi-realtime.jpg',
                'seo_title' => 'Feature Release: Real-Time Notifications for Approvals',
                'seo_description' => 'Real-time approval notifications for new requests, revisions, comments, and status changes.',
                'canonical_url' => 'https://yex.co.id/blogs/rilis-fitur-notifikasi-real-time-untuk-approval',
                'meta' => [
                    'tags' => [
                        'release',
                        'notifications',
                        'approval',
                        'productivity',
                        'workflow',
                    ],
                    'reading_time' => 9,
                    'changelog' => [
                        'Added real-time notifications',
                        'Added notification preferences',
                        'Added daily digest option',
                    ],
                ],
                'category_key' => 'feature_release',
            ],

            [
                'title' => 'Feature Release: Export Reports to CSV and Excel',
                'excerpt' => 'Report exports enable deeper analysis and periodic reporting for stakeholders.',
                'content' => '<p>Export to CSV and Excel makes it easier to analyze reports and share periodic updates with stakeholders.</p>',
                'status' => 'published',
                'published_at' => '2026-01-21 11:40:00',
                'featured_image' => 'https://example.com/images/posts/fr-export-csv-excel.jpg',
                'seo_title' => 'Feature Release: Export Reports to CSV and Excel',
                'seo_description' => 'Export reports to CSV and Excel with filters for focused analysis and reporting.',
                'canonical_url' => 'https://yex.co.id/blogs/rilis-fitur-ekspor-laporan-ke-csv-dan-excel',
                'meta' => [
                    'tags' => [
                        'release',
                        'reports',
                        'export',
                        'excel',
                        'csv',
                    ],
                    'reading_time' => 9,
                    'changelog' => [
                        'Added CSV export',
                        'Added Excel export',
                        'Improved filter before export',
                        'Added column selector',
                    ],
                ],
                'category_key' => 'feature_release',
            ],

            [
                'title' => 'Tips & Tutorials: Building Consistent Document Templates',
                'excerpt' => 'Consistent templates reduce revisions and speed approvals.',
                'content' => '<p>Start with key document types, define required sections, and add a short completeness checklist.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 09:00:00',
                'featured_image' => 'https://example.com/images/posts/tt-template-konsisten.jpg',
                'seo_title' => 'Building Consistent Document Templates',
                'seo_description' => 'Template checklist for structure, approvals, and revision notes.',
                'canonical_url' => 'https://yex.co.id/blogs/tips-tutorial-menyusun-template-dokumen-yang-konsisten',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'template',
                        'documents',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'tips_tutorial',
            ],

            [
                'title' => 'Tips & Tutorials: Setting Roles and Permissions Safely',
                'excerpt' => 'Design roles and permissions around job functions for secure access.',
                'content' => '<p>Map roles by function, apply least privilege, and review access regularly to keep workflows secure.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 14:30:00',
                'featured_image' => 'https://example.com/images/posts/tt-role-permission.jpg',
                'seo_title' => 'Setting Roles and Permissions Safely',
                'seo_description' => 'Role and permission guide focused on least privilege and regular access reviews.',
                'canonical_url' => 'https://yex.co.id/blogs/tips-tutorial-mengatur-role-dan-permission-dengan-aman',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'access',
                        'security',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'tips_tutorial',
            ],

            [
                'title' => 'Tips & Tutorials: Reading KPI Dashboards to Find Bottlenecks',
                'excerpt' => 'Learn how to read KPI dashboards to find bottlenecks and target improvements.',
                'content' => '<p>Review cycle time, rework rate, and WIP trends to spot bottlenecks, then prioritize small fixes.</p>',
                'status' => 'published',
                'published_at' => '2026-01-20 10:00:00',
                'featured_image' => 'https://example.com/images/posts/tt-dashboard-bottleneck.jpg',
                'seo_title' => 'Reading KPI Dashboards to Find Bottlenecks',
                'seo_description' => 'How to read KPIs to find bottlenecks and target improvements.',
                'canonical_url' => 'https://yex.co.id/blogs/tips-tutorial-membaca-dashboard-kpi-untuk-menemukan-bottleneck',
                'meta' => [
                    'tags' => [
                        'tutorial',
                        'kpi',
                        'process',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'tips_tutorial',
            ],

            [
                'title' => 'Security: Enabling MFA to Protect Accounts',
                'excerpt' => 'MFA adds an important layer to prevent account takeovers.',
                'content' => '<p>Enable MFA for admins and approvers to reduce the risk of account takeover and unauthorized access.</p>',
                'status' => 'published',
                'published_at' => '2026-01-11 09:10:00',
                'featured_image' => 'https://example.com/images/posts/sec-mfa.jpg',
                'seo_title' => 'Enabling MFA to Protect Accounts',
                'seo_description' => 'Enable MFA for sensitive roles to strengthen account protection.',
                'canonical_url' => 'https://yex.co.id/blogs/keamanan-mengaktifkan-mfa-untuk-melindungi-akun',
                'meta' => [
                    'tags' => [
                        'security',
                        'mfa',
                        'accounts',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'security',
            ],

            [
                'title' => 'Security: API Key Rotation and Secret Management Practices',
                'excerpt' => 'Regular API key rotation and proper secret handling reduce breach risk.',
                'content' => '<p>Rotate API keys regularly, limit scope, and store secrets in a secure vault to reduce exposure.</p>',
                'status' => 'published',
                'published_at' => '2026-01-14 13:20:00',
                'featured_image' => 'https://example.com/images/posts/sec-rotasi-api-key.jpg',
                'seo_title' => 'API Key Rotation and Secret Management Practices',
                'seo_description' => 'Rotate keys and manage secrets safely to reduce integration risk.',
                'canonical_url' => 'https://yex.co.id/blogs/keamanan-rotasi-api-key-dan-praktik-pengelolaan-rahasia',
                'meta' => [
                    'tags' => [
                        'security',
                        'api',
                        'secrets',
                    ],
                    'reading_time' => 11,
                ],
                'category_key' => 'security',
            ],

            [
                'title' => 'Security: Responsible Vulnerability Disclosure Process',
                'excerpt' => 'We provide a disclosure path so security issues are handled quickly and responsibly.',
                'content' => '<p>Submit vulnerabilities with clear steps and impact so we can triage, fix, and communicate updates quickly.</p>',
                'status' => 'published',
                'published_at' => '2026-01-18 11:00:00',
                'featured_image' => 'https://example.com/images/posts/sec-disclosure.jpg',
                'seo_title' => 'Responsible Vulnerability Disclosure Process',
                'seo_description' => 'Guidelines for reporting vulnerabilities and coordinating fixes responsibly.',
                'canonical_url' => 'https://yex.co.id/blogs/keamanan-proses-pelaporan-kerentanan-yang-bertanggung-jawab',
                'meta' => [
                    'tags' => [
                        'security',
                        'vulnerability',
                        'disclosure',
                    ],
                    'reading_time' => 10,
                ],
                'category_key' => 'security',
            ],

            [
                'title' => 'Infrastructure: Backup Strategy and Disaster Recovery',
                'excerpt' => 'Backups and DR plans ensure services recover quickly from incidents or data loss.',
                'content' => '<p>Define RPO and RTO, automate backups, and test recovery regularly to keep services resilient.</p>',
                'status' => 'published',
                'published_at' => '2026-01-07 09:00:00',
                'featured_image' => 'https://example.com/images/posts/infra-backup-dr.jpg',
                'seo_title' => 'Backup Strategy and Disaster Recovery',
                'seo_description' => 'Backup and DR essentials: RPO, RTO, encryption, and recovery testing.',
                'canonical_url' => 'https://yex.co.id/blogs/infrastruktur-strategi-backup-dan-disaster-recovery',
                'meta' => [
                    'tags' => [
                        'infrastructure',
                        'backup',
                        'disaster recovery',
                    ],
                    'reading_time' => 12,
                ],
                'category_key' => 'infrastructure',
            ],

            [
                'title' => 'Infrastructure: Scaling Databases for High Load',
                'excerpt' => 'Database scaling starts with query optimization and indexes, then replicas and sharding when needed.',
                'content' => '<p>Start with query and index tuning, add caching and read replicas, then consider partitioning or sharding when data grows.</p>',
                'status' => 'published',
                'published_at' => '2026-01-12 09:30:00',
                'featured_image' => 'https://example.com/images/posts/infra-scaling-db.jpg',
                'seo_title' => 'Scaling Databases for High Load',
                'seo_description' => 'Database scaling roadmap: optimize queries, add replicas, and scale storage as needed.',
                'canonical_url' => 'https://yex.co.id/blogs/infrastruktur-scaling-database-untuk-beban-tinggi',
                'meta' => [
                    'tags' => [
                        'infrastructure',
                        'database',
                        'scaling',
                    ],
                    'reading_time' => 12,
                ],
                'category_key' => 'infrastructure',
            ],

            [
                'title' => 'Infrastructure: Gradual Migration to Kubernetes',
                'excerpt' => 'Kubernetes migration is safer when staged: observability first, then non-critical services, then core.',
                'content' => '<p>Prepare CI/CD and observability, migrate non-critical services first, then scale the approach to core workloads.</p>',
                'status' => 'published',
                'published_at' => '2026-01-19 08:45:00',
                'featured_image' => 'https://example.com/images/posts/infra-kubernetes.jpg',
                'seo_title' => 'Gradual Migration to Kubernetes',
                'seo_description' => 'A staged Kubernetes migration focused on observability and controlled rollout.',
                'canonical_url' => 'https://yex.co.id/blogs/infrastruktur-migrasi-bertahap-ke-kubernetes',
                'meta' => [
                    'tags' => [
                        'infrastructure',
                        'kubernetes',
                        'migration',
                    ],
                    'reading_time' => 12,
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
            $post->update([
                'featured_image' => "blogs/{$post->id}/image1.jpg",
            ]);
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
