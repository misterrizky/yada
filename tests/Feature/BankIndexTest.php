<?php

namespace Tests\Feature;

use App\Models\Master\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class BankIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_bank_index_shows_banks(): void
    {
        $user = User::factory()->create();

        $this->makeBank('BCA', 'Bank Central Asia', 'CENAIDJA', true);
        $this->makeBank('BRI', 'Bank Rakyat Indonesia', null, true);

        $response = $this->actingAs($user)
            ->get(route('app.bank'));

        $response->assertOk();
        $response->assertSee('Bank Central Asia');
        $response->assertSee('Bank Rakyat Indonesia');
    }

    public function test_bank_index_deletes_bank(): void
    {
        $user = User::factory()->create();
        $bank = $this->makeBank('BTN', 'Bank Tabungan Negara', null, true);

        Volt::actingAs($user)
            ->test('apps.master.banks.index')
            ->call('deleteBank', $bank->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('banks', [
            'id' => $bank->id,
        ]);
    }

    private function makeBank(string $code, string $name, ?string $swiftCode, bool $isActive): Bank
    {
        $bank = new Bank;
        $bank->code = $code;
        $bank->name = $name;
        $bank->swift_code = $swiftCode;
        $bank->is_active = $isActive;
        $bank->save();

        return $bank;
    }
}
