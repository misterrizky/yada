<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('finance.invoice_logo', '');
        $this->migrator->add('finance.invoice_signatory_signature', '');
        $this->migrator->add('finance.language', 'en');
        $this->migrator->add('finance.due_after', 15);
        $this->migrator->add('finance.send_reminder_before', 0);
        $this->migrator->add('finance.reminder_type', 'after');
        $this->migrator->add('finance.send_reminder_after', 0);
        $this->migrator->add('finance.show_tax_number_on_invoice', true);
        $this->migrator->add('finance.hsn_sac_code_show', false);
        $this->migrator->add('finance.show_tax_calculation_message', true);
        $this->migrator->add('finance.show_status', true);
        $this->migrator->add('finance.show_authorised_signatory', true);
        $this->migrator->add('finance.show_client_name', true);
        $this->migrator->add('finance.show_client_email', true);
        $this->migrator->add('finance.show_client_phone', true);
        $this->migrator->add('finance.show_company_name', true);
        $this->migrator->add('finance.show_client_address', true);
        $this->migrator->add('finance.show_project_on_invoice', true);
        $this->migrator->add('finance.terms_and_conditions', 'Thank you for your business.');
        $this->migrator->add('finance.other_information', '');
        $this->migrator->add('finance.invoice_template', 'invoice-5');
        $this->migrator->add('finance.invoice_prefix', 'INV');
        $this->migrator->add('finance.invoice_number_separator', '#');
        $this->migrator->add('finance.invoice_digit', 3);
        $this->migrator->add('finance.credit_note_prefix', 'CN');
        $this->migrator->add('finance.credit_note_number_separator', '#');
        $this->migrator->add('finance.credit_note_digit', 3);
        $this->migrator->add('finance.estimate_prefix', 'EST');
        $this->migrator->add('finance.estimate_number_separator', '#');
        $this->migrator->add('finance.estimate_digit', 3);
        $this->migrator->add('finance.estimate_request_prefix', 'ESTRQ');
        $this->migrator->add('finance.estimate_request_number_separator', '#');
        $this->migrator->add('finance.estimate_request_digit', 3);
        $this->migrator->add('finance.order_prefix', 'ORD');
        $this->migrator->add('finance.order_number_separator', '#');
        $this->migrator->add('finance.order_digit', 3);
        $this->migrator->add('finance.proposal_prefix', 'QUO');
        $this->migrator->add('finance.proposal_number_separator', '#');
        $this->migrator->add('finance.proposal_digit', 3);
        $this->migrator->add('finance.default_unit_type_id', 1);
        $this->migrator->add('finance.units', [
            [
                'id' => 1,
                'unit_name' => 'Pcs',
                'is_default' => true,
            ],
        ]);
        $this->migrator->add('finance.quickbooks_status', false);
        $this->migrator->add('finance.payment_details', []);
    }
};
