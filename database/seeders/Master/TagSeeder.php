<?php

namespace Database\Seeders\Master;

use Spatie\Tags\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // ASSET
            [
                'name' => 'Asset Register',
                'type' => 'asset',
            ],
            [
                'name' => 'Asset Maintenance',
                'type' => 'asset',
            ],
            [
                'name' => 'Asset Handover',
                'type' => 'asset',
            ],
            [
                'name' => 'Asset Warranty',
                'type' => 'asset',
            ],
            [
                'name' => 'Asset Disposal',
                'type' => 'asset',
            ],
            [
                'name' => 'Article',
                'type' => 'blog',
            ],
            [
                'name' => 'News',
                'type' => 'blog',
            ],
            [
                'name' => 'Tutorial',
                'type' => 'blog',
            ],
            [
                'name' => 'Customer',
                'type' => 'crm',
            ],
            [
                'name' => 'Cold Lead',
                'type' => 'crm',
            ],
            [
                'name' => 'Hot Lead',
                'type' => 'crm',
            ],
            [
                'name' => 'Warm Lead',
                'type' => 'crm',
            ],
            [
                'name' => 'Agreement',
                'type' => 'document',
            ],
            [
                'name' => 'Contract',
                'type' => 'document',
            ],
            [
                'name' => 'Invoice',
                'type' => 'finance',
            ],
            [
                'name' => 'Proposal',
                'type' => 'document',
            ],
            [
                'name' => 'Quotation',
                'type' => 'document',
            ],
            [
                'name' => 'Report',
                'type' => 'document',
            ],
            [
                'name' => 'Specification',
                'type' => 'document',
            ],
            [
                'name' => 'Terms and Conditions',
                'type' => 'document',
            ],
            [
                'name' => 'User Manual',
                'type' => 'document',
            ],
            [
                'name' => 'Whitepaper',
                'type' => 'document',
            ],
            // FINANCE
            [
                'name' => 'Budget',
                'type' => 'finance',
            ],
            [
                'name' => 'Expense',
                'type' => 'finance',
            ],
            [
                'name' => 'Payment',
                'type' => 'finance',
            ],
            [
                'name' => 'Receipt',
                'type' => 'finance',
            ],
            [
                'name' => 'Tax',
                'type' => 'finance',
            ],
            // HR
            [
                'name' => 'Attendance',
                'type' => 'hr',
            ],
            [
                'name' => 'Employee',
                'type' => 'hr',
            ],
            [
                'name' => 'Leave Request',
                'type' => 'hr',
            ],
            [
                'name' => 'Performance Review',
                'type' => 'hr',
            ],
            [
                'name' => 'Recruitment',
                'type' => 'hr',
            ],
            [
                'name' => 'Training',
                'type' => 'hr',
            ],
            // PROCUREMENT
            [
                'name' => 'Delivery Note',
                'type' => 'procurement',
            ],
            [
                'name' => 'Goods Receipt',
                'type' => 'procurement',
            ],
            [
                'name' => 'Purchase Order',
                'type' => 'procurement',
            ],
            [
                'name' => 'Purchase Request',
                'type' => 'procurement',
            ],
            [
                'name' => 'Quotation Request',
                'type' => 'procurement',
            ],
            [
                'name' => 'Vendor',
                'type' => 'procurement',
            ],
            // PROJECT
            [
                'name' => 'Change Request',
                'type' => 'project',
            ],
            [
                'name' => 'Meeting Minutes',
                'type' => 'project',
            ],
            [
                'name' => 'Milestone',
                'type' => 'project',
            ],
            [
                'name' => 'Project Plan',
                'type' => 'project',
            ],
            [
                'name' => 'Risk Register',
                'type' => 'project',
            ],
            [
                'name' => 'Task',
                'type' => 'project',
            ],
            [
                'name' => 'Timeline',
                'type' => 'project',
            ],
            // QA
            [
                'name' => 'Bug Report',
                'type' => 'qa',
            ],
            [
                'name' => 'Defect',
                'type' => 'qa',
            ],
            [
                'name' => 'QA Report',
                'type' => 'qa',
            ],
            [
                'name' => 'Test Case',
                'type' => 'qa',
            ],
            [
                'name' => 'Test Plan',
                'type' => 'qa',
            ],
            [
                'name' => 'UAT',
                'type' => 'qa',
            ],
            // RESOURCE
            [
                'name' => 'Capacity Planning',
                'type' => 'resource',
            ],
            [
                'name' => 'Equipment',
                'type' => 'resource',
            ],
            [
                'name' => 'Resource Allocation',
                'type' => 'resource',
            ],
            [
                'name' => 'Resource Request',
                'type' => 'resource',
            ],
            [
                'name' => 'Timesheet',
                'type' => 'resource',
            ],
            // SALES
            [
                'name' => 'Opportunity',
                'type' => 'sales',
            ],
            [
                'name' => 'Pipeline',
                'type' => 'sales',
            ],
            [
                'name' => 'Sales Order',
                'type' => 'sales',
            ],
            [
                'name' => 'Follow Up',
                'type' => 'sales',
            ],
            [
                'name' => 'Sales Report',
                'type' => 'sales',
            ],
            // SUPPORT
            [
                'name' => 'Incident',
                'type' => 'support',
            ],
            [
                'name' => 'Knowledge Base',
                'type' => 'support',
            ],
            [
                'name' => 'Problem',
                'type' => 'support',
            ],
            [
                'name' => 'Service Request',
                'type' => 'support',
            ],
            [
                'name' => 'SLA',
                'type' => 'support',
            ],
            [
                'name' => 'Ticket',
                'type' => 'support',
            ],
        ];
        foreach ($tags as $tag) {
            $t = Tag::firstOrCreate(
                [
                    'name' => $tag['name'],
                    'type' => $tag['type'],
                ],
            );
            $t->slug;
            // $t->order_column; //returns 1
            $t->save();
        }

    }
}
