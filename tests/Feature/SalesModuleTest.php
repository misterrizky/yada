<?php

namespace Tests\Feature;

use App\Models\Sales\Order;
use App\Models\Sales\Quotation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;
use Tests\TestCase;

class SalesModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_quotation_item_form_creates_record(): void
    {
        $quotation = $this->makeQuotation('QTN-100');

        Volt::test('apps.form.sales.quotation-item')
            ->call('startCreate')
            ->set('quotationId', $quotation->id)
            ->set('item_name', 'License Fee')
            ->set('quantity', '2')
            ->set('unit_price', '1250')
            ->set('discount', '0')
            ->set('discount_type', 'fixed')
            ->set('tax_rate', '10')
            ->set('amount', '2500')
            ->set('order', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-quotation-item');

        $this->assertDatabaseHas('quotation_items', [
            'quotation_id' => $quotation->id,
            'item_name' => 'License Fee',
            'order' => 1,
        ]);
    }

    public function test_order_form_creates_record(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.form.sales.order')
            ->call('startCreate')
            ->set('order_number', 'ORD-100')
            ->set('order_date', now()->toDateString())
            ->set('status', 'pending')
            ->set('sub_total', '1500')
            ->set('discount', '0')
            ->set('discount_type', 'fixed')
            ->set('tax', '0')
            ->set('total', '1500')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-order');

        $this->assertDatabaseHas('orders', [
            'order_number' => 'ORD-100',
            'status' => 'pending',
        ]);
    }

    public function test_order_item_form_creates_record(): void
    {
        $order = $this->makeOrder('ORD-200');

        Volt::test('apps.form.sales.order-item')
            ->call('startCreate')
            ->set('orderId', $order->id)
            ->set('item_name', 'Implementation')
            ->set('quantity', '1')
            ->set('unit_price', '500')
            ->set('discount', '0')
            ->set('discount_type', 'fixed')
            ->set('tax_rate', '0')
            ->set('amount', '500')
            ->set('order_column', 2)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-order-item');

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'item_name' => 'Implementation',
            'order_column' => 2,
        ]);
    }

    public function test_contract_form_creates_record(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.form.sales.contract')
            ->call('startCreate')
            ->set('contract_number', 'CTR-100')
            ->set('subject', 'Managed Services')
            ->set('status', 'draft')
            ->set('contract_value', '5000')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-contract');

        $this->assertDatabaseHas('contracts', [
            'contract_number' => 'CTR-100',
            'status' => 'draft',
        ]);
    }

    public function test_sales_forms_require_fields(): void
    {
        Volt::test('apps.form.sales.quotation-item')
            ->call('save')
            ->assertHasErrors([
                'quotationId' => 'required',
                'item_name' => 'required',
            ]);

        Volt::test('apps.form.sales.order')
            ->call('save')
            ->assertHasErrors([
                'order_number' => 'required',
                'order_date' => 'required',
            ]);

        Volt::test('apps.form.sales.order-item')
            ->call('save')
            ->assertHasErrors([
                'orderId' => 'required',
                'item_name' => 'required',
            ]);

        Volt::test('apps.form.sales.contract')
            ->call('save')
            ->assertHasErrors([
                'contract_number' => 'required',
                'subject' => 'required',
            ]);
    }

    private function makeQuotation(string $number): Quotation
    {
        return Quotation::create([
            'ulid' => (string) Str::ulid(),
            'quotation_number' => $number,
            'title' => 'Sample Quotation',
            'status' => 'draft',
            'sub_total' => '2500',
            'discount' => '0',
            'discount_type' => 'fixed',
            'tax' => '0',
            'total' => '2500',
        ]);
    }

    private function makeOrder(string $number): Order
    {
        return Order::create([
            'ulid' => (string) Str::ulid(),
            'order_number' => $number,
            'order_date' => now()->toDateString(),
            'status' => 'pending',
            'sub_total' => '500',
            'discount' => '0',
            'discount_type' => 'fixed',
            'tax' => '0',
            'total' => '500',
        ]);
    }
}
