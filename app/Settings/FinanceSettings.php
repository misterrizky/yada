<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FinanceSettings extends Settings
{
    public string $logo;
    public string $signatory_signature;
    public string $language;
    public int $due_after;
    public int $send_reminder_before;
    public string $reminder_type;
    public int $send_reminder_after;
    public bool $show_tax_number_on_invoice;
    public bool $hsn_sac_code_show;
    public bool $show_tax_calculation_message;
    public bool $show_status;
    public bool $show_authorised_signatory;
    public bool $show_client_name;
    public bool $show_client_email;
    public bool $show_client_phone;
    public bool $show_company_name;
    public bool $show_client_address;
    public bool $show_project_on_invoice;
    public string $terms_and_conditions;
    public string $other_information;
    public string $invoice_template;
    public string $invoice_prefix;
    public string $invoice_number_separator;
    public int $invoice_digit;
    public string $credit_note_prefix;
    public string $credit_note_number_separator;
    public int $credit_note_digit;
    public string $estimate_prefix;
    public string $estimate_number_separator;
    public int $estimate_digit;
    public string $estimate_request_prefix;
    public string $estimate_request_number_separator;
    public int $estimate_request_digit;
    public string $order_prefix;
    public string $order_number_separator;
    public int $order_digit;
    public string $proposal_prefix;
    public string $proposal_number_separator;
    public int $proposal_digit;
    public int $default_unit_type_id;
    public array $units;
    public bool $quickbooks_status;
    public array $payment_details;
    public static function group(): string
    {
        return 'finance';
    }
}
