<?php

namespace Database\Seeders\HR;

use Illuminate\Support\Str;
use App\Models\HR\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // parent_slug dipakai untuk set parent_id setelah upsert
        $departments = [
            // ROOT
            [
                'code' => 'RUPS',
                'name' => 'RUPS / Pemegang Saham',
                'slug' => 'rups-pemegang-saham',
                'description' => 'Akar struktur governance',
                'parent_slug' => null
            ],
            [
                'code' => 'BOC',
                'name' => 'Board of Commissioners',
                'slug' => 'board-of-commissioners',
                'description' => '',
                'parent_slug' => 'rups-pemegang-saham'
            ],
            [
                'code' => 'CA',
                'name' => 'Komite Audit', 
                'slug' => 'committee-audit',
                'description' => 'Mengawasi pelaporan keuangan, kontrol internal, kepatuhan',
                'parent_slug' => 'board-of-commissioners'
            ],
            [
                'code' => 'BOD',
                'name' => 'Board of Directors',
                'slug' => 'board-of-directors',
                'description' => 'Struktur eksekutif; menjalankan operasional',
                'parent_slug' => 'rups-pemegang-saham'
            ],
            // DIREKSI
            [
                'code' => 'MGT',
                'name' => 'Management',
                'slug' => 'management',
                'description' => '',
                'parent_slug' => 'board-of-directors'
            ],
            [
                'code' => 'OCS',
                'name' => 'Operational & Corporate Services',
                'slug' => 'operational-corporate-services',
                'description' => '',
                'parent_slug' => 'management'
            ],
            [
                'code' => 'FIN',
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => '',
                'parent_slug' => 'management'
            ],
            [
                'code' => 'TECH',
                'name' => 'Technology & Engineering',
                'slug' => 'technology-engineering',
                'description' => '',
                'parent_slug' => 'management'
            ],
            [
                'code' => 'PD',
                'name' => 'Product & Design',
                'slug' => 'product-design',
                'description' => '',
                'parent_slug' => 'management'
            ],
            [
                'code' => 'COMM',
                'name' => 'Commercial',
                'slug' => 'commercial',
                'description' => '',
                'parent_slug' => 'management'
            ],
            // KOMITE AUDIT
            [
                'code' => 'IA',
                'name' => 'Internal Audit / SPI',
                'slug' => 'internal-audit-spi',
                'description' => 'Functional report ke Komite Audit/Dewan Komisaris; administratif ke CEO (opsional)',
                'parent_slug' => 'committee-audit'
            ],
            [
                'code' => 'ITA',
                'name' => 'IT Audit',
                'slug' => 'it-audit',
                'description' => '',
                'parent_slug' => 'internal-audit-spi'
            ],
            [
                'code' => 'OA',
                'name' => 'Operational Audit',
                'slug' => 'operational-audit',
                'description' => '',
                'parent_slug' => 'internal-audit-spi'
            ],
            [
                'code' => 'FA',
                'name' => 'Finance Audit',
                'slug' => 'finance-audit',
                'description' => '',
                'parent_slug' => 'internal-audit-spi'
            ],
            // OPERATIONAL & CORPORATE SERVICES
            [
                'code' => 'HR',
                'name' => 'People / HR',
                'slug' => 'people-hr',
                'description' => '',
                'parent_slug' => 'operational-corporate-services'
            ],
            [
                'code' => 'LEGAL',
                'name' => 'Legal',
                'slug' => 'legal',
                'description' => '',
                'parent_slug' => 'operational-corporate-services'
            ],
            [
                'code' => 'CER',
                'name' => 'Compliance & Enterprise Risk (non-audit)',
                'slug' => 'compliance-enterprise-risk',
                'description' => 'Bukan Internal Audit; fungsi risiko & kepatuhan harian',
                'parent_slug' => 'operational-corporate-services'
            ],
            [
                'code' => 'GA',
                'name' => 'General Affairs / Facilities',
                'slug' => 'general-affairs-facilities',
                'description' => '',
                'parent_slug' => 'operational-corporate-services'
            ],
            [
                'code' => 'PROC',
                'name' => 'Procurement / Purchasing',
                'slug' => 'procurement-purchasing',
                'description' => '',
                'parent_slug' => 'operational-corporate-services'
            ],
            [
                'code' => 'CPMO',
                'name' => 'Corporate PMO / Business Operations',
                'slug' => 'corporate-pmo-business-operations',
                'description' => '',
                'parent_slug' => 'operational-corporate-services'
            ],
            // FINANCE
            [
                'code' => 'ACCT',
                'name' => 'Accounting',
                'slug' => 'accounting',
                'description' => '',
                'parent_slug' => 'finance'
            ],
            [
                'code' => 'TAX',
                'name' => 'Tax',
                'slug' => 'tax',
                'description' => '',
                'parent_slug' => 'finance'
            ],
            [
                'code' => 'FPA',
                'name' => 'FP & A (Budgeting & Performance)',
                'slug' => 'fp-a-budgeting-performance',
                'description' => '',
                'parent_slug' => 'finance'
            ],
            [
                'code' => 'TRE',
                'name' => 'Treasury',
                'slug' => 'treasury',
                'description' => '',
                'parent_slug' => 'finance'
            ],
            [
                'code' => 'FCIC',
                'name' => 'Finance Control / Internal Control',
                'slug' => 'finance-control-internal-control',
                'description' => 'Kontrol harian; berbeda dengan Internal Audit/SPI',
                'parent_slug' => 'finance'
            ],
            // PRODUCT & DESIGN
            [
                'code' => 'PM',
                'name' => 'Product Management',
                'slug' => 'product-management',
                'description' => '',
                'parent_slug' => 'product-design'
            ],
            [
                'code' => 'PDUXUI',
                'name' => 'Product Design (UX/UI)',
                'slug' => 'product-design-ux-ui',
                'description' => '',
                'parent_slug' => 'product-design'
            ],
            [
                'code' => 'UXR',
                'name' => 'UX Researcher',
                'slug' => 'ux-researcher',
                'description' => '',
                'parent_slug' => 'product-design'
            ],
            [
                'code' => 'PRODOP',
                'name' => 'Product Operations',
                'slug' => 'product-operations',
                'description' => '',
                'parent_slug' => 'product-design'
            ],
            // TECHNOLOGY & ENGINEERING
            [
                'code' => 'STS',
                'name' => 'Shared Tech Services',
                'slug' => 'shared-tech-services',
                'description' => 'Fungsi shared untuk semua tribe',
                'parent_slug' => 'technology-engineering'
            ],
            [
                'code' => 'TB2B',
                'name' => 'Tribe: B2B SaaS Engineering',
                'slug' => 'tribe-b2b-saas-engineering',
                'description' => '',
                'parent_slug' => 'technology-engineering'
            ],
            [
                'code' => 'TB2C',
                'name' => 'Tribe: B2C Consumer Engineering',
                'slug' => 'tribe-b2c-consumer-engineering',
                'description' => '',
                'parent_slug' => 'technology-engineering'
            ],
            [
                'code' => 'TB2I',
                'name' => 'Tribe: IoT Platform Engineering',
                'slug' => 'tribe-iot-platform-engineering',
                'description' => '',
                'parent_slug' => 'technology-engineering'
            ],
            [
                'code' => 'TB2X',
                'name' => 'Tribe: AR/VR (XR) Engineering',
                'slug' => 'tribe-ar-vr-xr-engineering',
                'description' => '',
                'parent_slug' => 'technology-engineering'
            ],
            [
                'code' => 'TAAIE',
                'name' => 'Tribe: Applied AI Engineering',
                'slug' => 'tribe-applied-ai-engineering',
                'description' => '',
                'parent_slug' => 'technology-engineering'
            ],
            // COMMERCIAL
            [
                'code' => 'B2BSALES',
                'name' => 'B2B Sales',
                'slug' => 'b2b-sales',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            [
                'code' => 'MKG',
                'name' => 'Marketing & Growth',
                'slug' => 'marketing-growth',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            [
                'code' => 'PARTNERSHIPS',
                'name' => 'Partnerships',
                'slug' => 'partnerships',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            [
                'code' => 'CSB2B',
                'name' => 'Customer Success (B2B)',
                'slug' => 'customer-success-b2b',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            [
                'code' => 'CSB2BC',
                'name' => 'Support / Customer Care (B2B+B2C)',
                'slug' => 'support-customer-care-b2b-b2c',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            [
                'code' => 'REVOPS',
                'name' => 'RevOps (Revenue Operations)',
                'slug' => 'revops-revenue-operations',
                'description' => '',
                'parent_slug' => 'commercial'
            ],
            // PEOPLE / HR
            [
                'code' => 'TA',
                'name' => 'Talent Acquisition (Recruitment)',
                'slug' => 'talent-acquisition-recruitment',
                'description' => '',
                'parent_slug' => 'people-hr'
            ],
            [
                'code' => 'HRBP',
                'name' => 'HR Business Partner (HRBP)',
                'slug' => 'hr-business-partner-hrbp',
                'description' => '',
                'parent_slug' => 'people-hr'
            ],
            [
                'code' => 'C&B',
                'name' => 'Compensation & Benefits (C&B) / Payroll Ops',
                'slug' => 'compensation-benefits-cb-payroll-ops',
                'description' => '',
                'parent_slug' => 'people-hr'
            ],
            [
                'code' => 'L&D',
                'name' => 'Learning & Development (L&D)',
                'slug' => 'learning-development-ld',
                'description' => '',
                'parent_slug' => 'people-hr'
            ],
            // PRODUCT MANAGEMENT
            [
                'code' => 'PMB2B',
                'name' => 'B2B SaaS PM Group',
                'slug' => 'b2b-saas-pm-group',
                'description' => '',
                'parent_slug' => 'product-management'
            ],
            [
                'code' => 'PMB2C',
                'name' => 'B2C PM Group',
                'slug' => 'b2c-pm-group',
                'description' => '',
                'parent_slug' => 'product-management'
            ],
            [
                'code' => 'PMNTE',
                'name' => 'New Tech PM Group (IoT/XR/AI)',
                'slug' => 'new-tech-pm-group-iot-xr-ai',
                'description' => '',
                'parent_slug' => 'product-management'
            ],
            // PRODUCT DESIGN (UX/UI)
            [
                'code' => 'B2BDE',
                'name' => 'B2B Design',
                'slug' => 'b2b-design',
                'description' => '',
                'parent_slug' => 'product-design-ux-ui'
            ],
            [
                'code' => 'B2CDE',
                'name' => 'B2C Design',
                'slug' => 'b2c-design',
                'description' => '',
                'parent_slug' => 'product-design-ux-ui'
            ],
            [
                'code' => 'DESYS',
                'name' => 'Design System',
                'slug' => 'design-system',
                'description' => '',
                'parent_slug' => 'product-design-ux-ui'
            ],
            // SHARED TECH SERVICES
            [
                'code' => 'PEDEVEX',
                'name' => 'Platform Engineering / DevEx',
                'slug' => 'platform-engineering-devex',
                'description' => 'CI/CD, tooling, standards, release engineering',
                'parent_slug' => 'shared-tech-services'
            ],
            [
                'code' => 'SREOBS',
                'name' => 'SRE & Observability',
                'slug' => 'sre-observability',
                'description' => 'Reliability, incident, monitoring, capacity',
                'parent_slug' => 'shared-tech-services'
            ],
            [
                'code' => 'SECUR',
                'name' => 'Security',
                'slug' => 'security',
                'description' => 'AppSec, InfraSec, IAM, security governance',
                'parent_slug' => 'shared-tech-services'
            ],
            [
                'code' => 'DPLAT',
                'name' => 'Data Platform',
                'slug' => 'data-platform',
                'description' => 'DWH/lake, streaming, governance, BI enablement',
                'parent_slug' => 'shared-tech-services'
            ],
            [
                'code' => 'CORPIT',
                'name' => 'Corporate IT / Internal Systems',
                'slug' => 'corporate-it-internal-systems',
                'description' => 'Endpoint/devices, internal network, internal tools',
                'parent_slug' => 'shared-tech-services'
            ],
            // SECURITY
            [
                'code' => 'APPSEC',
                'name' => 'Application Security (AppSec)',
                'slug' => 'application-security-appsec',
                'description' => '',
                'parent_slug' => 'security'
            ],
            [
                'code' => 'INFRASEC',
                'name' => 'Infrastructure Security (InfraSec)',
                'slug' => 'infrastructure-security-infrasec',
                'description' => '',
                'parent_slug' => 'security'
            ],
            [
                'code' => 'IAMSEC',
                'name' => 'IAM / Security Engineering',
                'slug' => 'iam-security-engineering',
                'description' => '',
                'parent_slug' => 'security'
            ],
            [
                'code' => 'SGOV',
                'name' => 'Security Governance (policy/risk/vendor security)',
                'slug' => 'security-governance-policy-risk-vendor-security',
                'description' => '',
                'parent_slug' => 'security'
            ],
            // TRIBE: B2B SAAS ENGINEERING
            [
                'code' => 'SIAP',
                'name' => 'Squad: IAM/Admin & Permissions',
                'slug' => 'squad-iam-admin-permissions',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            [
                'code' => 'SBS',
                'name' => 'Squad: Billing/Subscription',
                'slug' => 'squad-billing-subscription',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            [
                'code' => 'SIPA',
                'name' => 'Squad: Integrations & Public API',
                'slug' => 'squad-integrations-public-api',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            [
                'code' => 'SRAB2B',
                'name' => 'Squad: Reporting/Analytics (B2B)',
                'slug' => 'squad-reporting-analytics-b2b',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            [
                'code' => 'SEPS',
                'name' => 'Squad: Enterprise Performance & Scalability',
                'slug' => 'squad-enterprise-performance-scalability',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            [
                'code' => 'SMB2B',
                'name' => 'Squad: B2B Mobile Companion',
                'slug' => 'squad-b2b-mobile-companion',
                'description' => '',
                'parent_slug' => 'tribe-b2b-saas-engineering'
            ],
            // TRIBE: B2C CONSUMER ENGINEERING
            [
                'code' => 'SCCM',
                'name' => 'Squad: Consumer Core Mobile',
                'slug' => 'squad-consumer-core-mobile',
                'description' => '',
                'parent_slug' => 'tribe-b2c-consumer-engineering'
            ],
            [
                'code' => 'SCWEB',
                'name' => 'Squad: Consumer Web',
                'slug' => 'squad-consumer-web',
                'description' => '',
                'parent_slug' => 'tribe-b2c-consumer-engineering'
            ],
            [
                'code' => 'SGM',
                'name' => 'Squad: Growth & Monetization',
                'slug' => 'squad-growth-monetization',
                'description' => '',
                'parent_slug' => 'tribe-b2c-consumer-engineering'
            ],
            [
                'code' => 'SECC',
                'name' => 'Squad: Engagement/Content',
                'slug' => 'squad-engagement-content',
                'description' => '',
                'parent_slug' => 'tribe-b2c-consumer-engineering'
            ],
            [
                'code' => 'STNS',
                'name' => 'Squad: Trust & Safety',
                'slug' => 'squad-trust-safety',
                'description' => '',
                'parent_slug' => 'tribe-b2c-consumer-engineering'
            ],
            // TRIBE: IOT PLATFORM ENGINEERING
            [
                'code' => 'SDCFM',
                'name' => 'Squad: Device Cloud & Fleet Management',
                'slug' => 'squad-device-cloud-fleet-management',
                'description' => '',
                'parent_slug' => 'tribe-iot-platform-engineering'
            ],
            [
                'code' => 'SESC',
                'name' => 'Squad: Edge/SDK & Connectivity',
                'slug' => 'squad-edge-sdk-connectivity',
                'description' => '',
                'parent_slug' => 'tribe-iot-platform-engineering'
            ],
            [
                'code' => 'SIOME',
                'name' => 'Squad: IoT Mobile Experience',
                'slug' => 'squad-iot-mobile-experience',
                'description' => '',
                'parent_slug' => 'tribe-iot-platform-engineering'
            ],
            // TRIBE: AR/VR (XR) ENGINEERING
            [
                'code' => 'SXRC',
                'name' => 'Squad: XR Client (Unity/Unreal/Native)',
                'slug' => 'squad-xr-client-unity-unreal-native',
                'description' => '',
                'parent_slug' => 'tribe-ar-vr-xr-engineering'
            ],
            [
                'code' => 'S3DP',
                'name' => 'Squad: 3D Pipeline & Tools',
                'slug' => 'squad-3d-pipeline-tools',
                'description' => '',
                'parent_slug' => 'tribe-ar-vr-xr-engineering'
            ],
            // TRIBE: APPLIED AI ENGINEERING
            [
                'code' => 'SMLOPS',
                'name' => 'Squad: MLOps & Model Serving',
                'slug' => 'squad-mlops-model-serving',
                'description' => '',
                'parent_slug' => 'tribe-applied-ai-engineering'
            ],
            [
                'code' => 'SAI',
                'name' => 'Squad: Applied AI (NLP/CV/Recommender)',
                'slug' => 'squad-applied-ai-nlp-cv-recommender',
                'description' => '',
                'parent_slug' => 'tribe-applied-ai-engineering'
            ],
            [
                'code' => 'SAIE',
                'name' => 'Squad: AI Enablement (SDK/internal consult)',
                'slug' => 'squad-ai-enablement-sdk-internal-consult',
                'description' => '',
                'parent_slug' => 'tribe-applied-ai-engineering'
            ],
            // COMMERCIAL - B2B SALES
            [
                'code' => 'SDR',
                'name' => 'SDR/BDR (Outbound/Lead Gen)',
                'slug' => 'sdr-bdr-outbound-lead-gen',
                'description' => '',
                'parent_slug' => 'b2b-sales'
            ],
            [
                'code' => 'AE',
                'name' => 'Account Executives (AE)',
                'slug' => 'account-executives-ae',
                'description' => '',
                'parent_slug' => 'b2b-sales'
            ],
            [
                'code' => 'SE',
                'name' => 'Sales Engineering / Pre-sales',
                'slug' => 'sales-engineering-pre-sales',
                'description' => '',
                'parent_slug' => 'b2b-sales'
            ],
            [
                'code' => 'KAE',
                'name' => 'Key Account / Enterprise',
                'slug' => 'key-account-enterprise',
                'description' => '',
                'parent_slug' => 'b2b-sales'
            ],
            // COMMERCIAL - MARKETING & GROWTH
            [
                'code' => 'B2BDG',
                'name' => 'B2B Demand Generation',
                'slug' => 'b2b-demand-generation',
                'description' => '',
                'parent_slug' => 'marketing-growth'
            ],
            [
                'code' => 'B2CGRW',
                'name' => 'B2C Growth (Performance/Activation/Retention)',
                'slug' => 'b2c-growth-performance-activation-retention',
                'description' => '',
                'parent_slug' => 'marketing-growth'
            ],
            [
                'code' => 'BRND',
                'name' => 'Brand/Content/PR',
                'slug' => 'brand-content-pr',
                'description' => '',
                'parent_slug' => 'marketing-growth'
            ],
            // COMMERCIAL - CUSTOMER SUCCESS (B2B)
            [
                'code' => 'ONB',
                'name' => 'Onboarding',
                'slug' => 'onboarding',
                'description' => '',
                'parent_slug' => 'customer-success-b2b'
            ],
            [
                'code' => 'ADPT',
                'name' => 'Adoption',
                'slug' => 'adoption',
                'description' => '',
                'parent_slug' => 'customer-success-b2b'
            ],
            [
                'code' => 'REX',
                'name' => 'Renewal/Expansion',
                'slug' => 'renewal-expansion',
                'description' => '',
                'parent_slug' => 'customer-success-b2b'
            ],
            // COMMERCIAL - SUPPORT / CUSTOMER CARE (B2B+B2C)
            [
                'code' => 'T1S',
                'name' => 'Tier 1 Support',
                'slug' => 'tier-1-support',
                'description' => '',
                'parent_slug' => 'support-customer-care-b2b-b2c'
            ],
            [
                'code' => 'T2S',
                'name' => 'Tier 2 Support',
                'slug' => 'tier-2-support',
                'description' => '',
                'parent_slug' => 'support-customer-care-b2b-b2c'
            ],
            [
                'code' => 'T3E',
                'name' => 'Tier 3 / Escalation',
                'slug' => 'tier-3-escalation',
                'description' => '',
                'parent_slug' => 'support-customer-care-b2b-b2c'
            ],
        ];

        // 1) Upsert base rows (tanpa parent_id dulu)
        $baseRows = array_map(function ($d) use ($now) {
            return [
                'ulid' => (string) Str::ulid(),
                'code' => $d['code'],
                'name' => $d['name'],
                'slug' => $d['slug'],
                'description' => $d['description'] ?? null,
                'parent_id' => null,
                'head_id' => null,
                'is_active' => true,
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $departments);

        DB::table('departments')->upsert(
            $baseRows,
            ['slug'],
            ['code', 'name', 'description', 'is_active', 'deleted_at', 'updated_at']
        );

        // 2) Set parent_id berdasarkan parent_slug
        $slugToId = DB::table('departments')
            ->whereIn('slug', array_column($departments, 'slug'))
            ->pluck('id', 'slug');

        foreach ($departments as $d) {
            if (!empty($d['parent_slug'])) {
                $childId = $slugToId[$d['slug']] ?? null;
                $parentId = $slugToId[$d['parent_slug']] ?? null;

                if ($childId && $parentId) {
                    DB::table('departments')->where('id', $childId)->update([
                        'parent_id' => $parentId,
                        'updated_at' => $now,
                    ]);
                }
            }
        }
    }
}
