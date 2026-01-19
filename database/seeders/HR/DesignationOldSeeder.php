<?php

namespace Database\Seeders\HR;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    private function bullets(array $items): string
    {
        return implode("\n", array_map(fn ($i) => "- {$i}", $items));
    }
    public function run(): void
    {
        $now = now();

        $families = DB::table('designation_families')->pluck('id', 'slug');
        $levels   = DB::table('job_levels')->pluck('id', 'slug');

        $defs = [
            // Executive (C-level)
            [
                'family_slug' => 'executive-leadership', 'level_slug' => 'c-level',
                'designation' => 'Chief Executive Officer (CEO)',
                'job_summary' => 'Own company vision, strategy, execution, and culture.',
                'responsibilities' => ['Set company direction and priorities', 'Lead exec team and drive alignment', 'Oversee P&L and major outcomes'],
                'skills' => ['Strategic thinking', 'Leadership & communication', 'Execution & prioritization'],
                'kpis' => ['Revenue growth', 'Runway / profitability', 'NPS / customer retention'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'executive-leadership', 'level_slug' => 'c-level',
                'designation' => 'Chief Technology Officer (CTO)',
                'job_summary' => 'Own engineering execution, architecture direction, and technology strategy.',
                'responsibilities' => ['Own engineering delivery & quality', 'Set architectural direction', 'Build scalable org & engineering culture'],
                'skills' => ['System design', 'Org design', 'Stakeholder management'],
                'kpis' => ['Delivery predictability', 'Platform reliability (SLO)', 'Engineering throughput'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Backend
            [
                'family_slug' => 'backend', 'level_slug' => 'junior',
                'designation' => 'Junior Backend Engineer',
                'job_summary' => 'Build backend services with guidance; focus on fundamentals and clean implementation.',
                'responsibilities' => ['Implement API endpoints', 'Write tests', 'Fix bugs and improve code quality'],
                'skills' => ['REST/JSON', 'SQL basics', 'Unit testing'],
                'kpis' => ['PR throughput', 'Bug rate', 'Test coverage contribution'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'backend', 'level_slug' => 'mid',
                'designation' => 'Backend Engineer',
                'job_summary' => 'Own small-to-medium backend scope end-to-end.',
                'responsibilities' => ['Design & implement services', 'Optimize DB queries', 'Collaborate with frontend/product'],
                'skills' => ['Laravel/Node/Go (sesuaikan)', 'SQL tuning', 'Observability basics'],
                'kpis' => ['Cycle time', 'Service error rate', 'Performance improvements'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'backend', 'level_slug' => 'senior',
                'designation' => 'Senior Backend Engineer',
                'job_summary' => 'Lead technical execution for a domain; mentor and raise code quality.',
                'responsibilities' => ['Own design decisions', 'Mentor engineers', 'Improve reliability & scalability'],
                'skills' => ['System design', 'Caching & queues', 'Incident response'],
                'kpis' => ['SLO attainment', 'Tech debt burn-down', 'Mentorship impact'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'backend', 'level_slug' => 'lead',
                'designation' => 'Lead Backend Engineer',
                'job_summary' => 'Drive architecture and delivery across multiple services/squads.',
                'responsibilities' => ['Architect core services', 'Coordinate cross-team delivery', 'Define best practices'],
                'skills' => ['Architecture', 'Technical leadership', 'Cross-team collaboration'],
                'kpis' => ['Delivery outcomes', 'Platform stability', 'Engineering productivity'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Frontend
            [
                'family_slug' => 'frontend', 'level_slug' => 'mid',
                'designation' => 'Frontend Engineer',
                'job_summary' => 'Build user-facing features with attention to UX and performance.',
                'responsibilities' => ['Implement UI features', 'State management & API integration', 'Improve performance'],
                'skills' => ['React/Vue', 'TypeScript', 'Web performance'],
                'kpis' => ['Feature adoption', 'Frontend performance metrics', 'Bug rate'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'frontend', 'level_slug' => 'senior',
                'designation' => 'Senior Frontend Engineer',
                'job_summary' => 'Own complex UI architecture and mentor others.',
                'responsibilities' => ['Define frontend architecture', 'Lead refactoring', 'Mentor engineers'],
                'skills' => ['Architecture', 'DX tooling', 'Accessibility'],
                'kpis' => ['Performance improvements', 'Accessibility compliance', 'Mentorship impact'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // DevOps/SRE
            [
                'family_slug' => 'devops-sre', 'level_slug' => 'mid',
                'designation' => 'Site Reliability Engineer (SRE)',
                'job_summary' => 'Improve reliability, observability, and delivery pipelines.',
                'responsibilities' => ['Maintain CI/CD', 'Define SLO/SLI', 'Incident response & postmortems'],
                'skills' => ['Kubernetes', 'CI/CD', 'Monitoring/alerting'],
                'kpis' => ['SLO compliance', 'MTTR', 'Deployment frequency'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'devops-sre', 'level_slug' => 'senior',
                'designation' => 'Senior SRE',
                'job_summary' => 'Lead reliability improvements and capacity planning.',
                'responsibilities' => ['Architect reliability patterns', 'Capacity planning', 'Coach on operational excellence'],
                'skills' => ['Distributed systems', 'Chaos testing', 'Cost optimization'],
                'kpis' => ['Incident reduction', 'Infra cost efficiency', 'MTTR improvements'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Security
            [
                'family_slug' => 'security-engineering', 'level_slug' => 'mid',
                'designation' => 'Security Engineer',
                'job_summary' => 'Build and operate security controls across products and infrastructure.',
                'responsibilities' => ['Vulnerability management', 'Security reviews', 'Implement security tooling'],
                'skills' => ['OWASP', 'Cloud security', 'Threat modeling'],
                'kpis' => ['Vuln SLA closure rate', 'Security incidents', 'Security coverage'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Product Management
            [
                'family_slug' => 'product-management', 'level_slug' => 'mid',
                'designation' => 'Product Manager',
                'job_summary' => 'Own product scope from discovery to delivery and iteration.',
                'responsibilities' => ['Write PRD & align stakeholders', 'Prioritize roadmap', 'Analyze metrics and iterate'],
                'skills' => ['Discovery', 'Prioritization', 'Analytics'],
                'kpis' => ['Adoption', 'Retention', 'Time-to-value'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'product-management', 'level_slug' => 'senior',
                'designation' => 'Senior Product Manager',
                'job_summary' => 'Lead product strategy for a domain and mentor PMs.',
                'responsibilities' => ['Define strategy', 'Drive alignment', 'Mentor PMs'],
                'skills' => ['Strategy', 'Stakeholder management', 'Data-informed decisions'],
                'kpis' => ['North star metric', 'Revenue impact', 'Delivery outcomes'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Product Design
            [
                'family_slug' => 'product-design', 'level_slug' => 'mid',
                'designation' => 'Product Designer',
                'job_summary' => 'Design end-to-end user experiences and UI.',
                'responsibilities' => ['User flows & wireframes', 'High-fidelity UI', 'Design QA with engineers'],
                'skills' => ['Figma', 'UX principles', 'Design systems'],
                'kpis' => ['Usability metrics', 'Design throughput', 'Stakeholder satisfaction'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Data
            [
                'family_slug' => 'data-engineering', 'level_slug' => 'mid',
                'designation' => 'Data Engineer',
                'job_summary' => 'Build data pipelines, models, and reliable datasets for analytics/ML.',
                'responsibilities' => ['ETL/ELT pipelines', 'Data modeling', 'Data quality checks'],
                'skills' => ['SQL', 'Airflow/dbt', 'Warehouse concepts'],
                'kpis' => ['Pipeline reliability', 'Freshness SLA', 'Data quality score'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'data-science', 'level_slug' => 'senior',
                'designation' => 'Senior Data Scientist',
                'job_summary' => 'Drive modeling/experimentation to improve product and business outcomes.',
                'responsibilities' => ['Build predictive models', 'Run experiments', 'Communicate insights'],
                'skills' => ['Statistics', 'Python', 'Experimentation'],
                'kpis' => ['Lift from experiments', 'Model performance', 'Time-to-insight'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Business
            [
                'family_slug' => 'sales-family', 'level_slug' => 'mid',
                'designation' => 'Account Executive',
                'job_summary' => 'Own pipeline and close deals; collaborate with solutions team.',
                'responsibilities' => ['Prospecting & pipeline', 'Run demos and proposals', 'Negotiate & close'],
                'skills' => ['Consultative selling', 'Negotiation', 'CRM discipline'],
                'kpis' => ['Quota attainment', 'Pipeline coverage', 'Win rate'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'customer-success', 'level_slug' => 'mid',
                'designation' => 'Customer Success Manager',
                'job_summary' => 'Drive adoption and retention for key accounts.',
                'responsibilities' => ['Onboarding & success plans', 'Renewal support', 'Voice-of-customer to product'],
                'skills' => ['Account management', 'Product knowledge', 'Communication'],
                'kpis' => ['Retention', 'Expansion', 'NPS'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],

            // Operations
            [
                'family_slug' => 'people-ops', 'level_slug' => 'mid',
                'designation' => 'People Operations Specialist',
                'job_summary' => 'Support HR operations, hiring ops, and employee lifecycle.',
                'responsibilities' => ['HR administration', 'Hiring coordination', 'Policy & compliance support'],
                'skills' => ['HR operations', 'Communication', 'Confidentiality'],
                'kpis' => ['Hiring cycle time', 'Employee satisfaction', 'Process SLA'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'finance-accounting', 'level_slug' => 'mid',
                'designation' => 'Finance Analyst',
                'job_summary' => 'Support budgeting, reporting, and financial analysis.',
                'responsibilities' => ['Monthly reporting', 'Budget tracking', 'Financial analysis'],
                'skills' => ['Accounting basics', 'Excel/Sheets', 'Analytical thinking'],
                'kpis' => ['Closing timeliness', 'Forecast accuracy', 'Cost savings initiatives'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
            [
                'family_slug' => 'legal-compliance', 'level_slug' => 'senior',
                'designation' => 'Legal Counsel',
                'job_summary' => 'Provide legal guidance on contracts, compliance, and risk.',
                'responsibilities' => ['Contract review', 'Compliance advisory', 'Risk mitigation'],
                'skills' => ['Contract law', 'Compliance', 'Stakeholder management'],
                'kpis' => ['Contract SLA', 'Compliance issues', 'Risk reduction'],
                'work_model' => 'Hybrid', 'employment_type' => 'Employee',
            ],
        ];

        $rows = [];
        foreach ($defs as $d) {
            $familyId = $families[$d['family_slug']] ?? null;
            $levelId  = $levels[$d['level_slug']] ?? null;

            if (!$familyId || !$levelId) {
                continue;
            }

            $resp = $d['responsibilities'] ?? [];
            $skills = $d['skills'] ?? [];
            $kpis = $d['kpis'] ?? [];

            $rows[] = [
                'designation_family_id' => $familyId,
                'job_level_id' => $levelId,
                'designation' => $d['designation'],
                'job_summary' => $d['job_summary'] ?? null,

                'key_responsibilities' => $resp ? $this->bullets($resp) : null,
                'key_responsibilities_items' => $resp ? json_encode($resp, JSON_UNESCAPED_UNICODE) : null,

                'core_skills' => $skills ? $this->bullets($skills) : null,
                'core_skills_items' => $skills ? json_encode($skills, JSON_UNESCAPED_UNICODE) : null,

                'typical_kpis' => $kpis ? $this->bullets($kpis) : null,
                'typical_kpis_items' => $kpis ? json_encode($kpis, JSON_UNESCAPED_UNICODE) : null,

                'work_model' => $d['work_model'] ?? null,
                'employment_type' => $d['employment_type'] ?? null,
                'career_band' => $d['career_band'] ?? null,
                'notes' => $d['notes'] ?? null,

                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('designations')->upsert(
            $rows,
            ['designation_family_id', 'job_level_id', 'designation'],
            [
                'job_summary',
                'key_responsibilities', 'key_responsibilities_items',
                'core_skills', 'core_skills_items',
                'typical_kpis', 'typical_kpis_items',
                'work_model', 'employment_type', 'career_band', 'notes',
                'updated_at',
            ]
        );
    }
}
