<?php

namespace Tests\Feature;

use App\Models\CRM\Company;
use App\Models\CRM\Lead;
use App\Models\CRM\LostReason;
use App\Models\CRM\Source;
use App\Models\Master\Industry;
use App\Models\Master\Stage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;
use Tests\TestCase;

class CrmModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_lost_reasons_index_shows_records(): void
    {
        $user = User::factory()->create();

        LostReason::create(['name' => 'Budget']);
        LostReason::create(['name' => 'Timing']);

        $response = $this->actingAs($user)
            ->get(route('app.crm.lost-reason'));

        $response->assertOk();
        $response->assertSee('Budget');
        $response->assertSee('Timing');
    }

    public function test_lost_reasons_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $lostReason = LostReason::create(['name' => 'Competitor']);

        Volt::actingAs($user)
            ->test('apps.crm.lost-reason.index')
            ->call('deleteLostReason', $lostReason->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('lost_reasons', [
            'id' => $lostReason->id,
        ]);
    }

    public function test_leads_index_shows_records(): void
    {
        $user = User::factory()->create();
        Lead::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Acme Lead',
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.crm.leads'));

        $response->assertOk();
        $response->assertSee('Acme Lead');
    }

    public function test_leads_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $lead = Lead::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Delete Lead',
        ]);

        Volt::actingAs($user)
            ->test('apps.crm.leads.index')
            ->call('deleteLead', $lead->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('leads', [
            'id' => $lead->id,
        ]);
    }

    public function test_companies_index_shows_records(): void
    {
        $user = User::factory()->create();
        Company::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Acme Corp',
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.crm.companies'));

        $response->assertOk();
        $response->assertSee('Acme Corp');
    }

    public function test_companies_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Delete Company',
        ]);

        Volt::actingAs($user)
            ->test('apps.crm.companies.index')
            ->call('deleteCompany', $company->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
        ]);
    }

    public function test_crm_forms_create_records(): void
    {
        $user = User::factory()->create();
        $industry = Industry::create(['name' => 'Technology', 'is_active' => 1]);
        $source = Source::create(['name' => 'Referral', 'is_active' => 1]);
        $company = Company::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Nova LLC',
        ]);
        $stage = Stage::create([
            'name' => 'Qualified',
            'flag' => 'qualified',
            'color' => '#3498db',
            'order' => 1,
            'probability' => '25',
            'is_default' => 0,
            'is_won' => 0,
            'is_lost' => 0,
        ]);

        Volt::test('apps.form.crm.lost-reason')
            ->call('startCreate')
            ->set('name', 'Pricing')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-lost-reason');

        Volt::actingAs($user)
            ->test('apps.form.crm.company')
            ->call('startCreate')
            ->set('name', 'Synapse Inc')
            ->set('industryId', $industry->id)
            ->set('sourceId', $source->id)
            ->set('status', 'active')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-company');

        Volt::actingAs($user)
            ->test('apps.form.crm.lead')
            ->call('startCreate')
            ->set('name', 'Lead One')
            ->set('value', '1500')
            ->set('sourceId', $source->id)
            ->set('industryId', $industry->id)
            ->set('stageId', $stage->id)
            ->set('companyId', $company->id)
            ->set('userId', $user->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-lead');

        $this->assertDatabaseHas('lost_reasons', [
            'name' => 'Pricing',
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Synapse Inc',
        ]);

        $this->assertDatabaseHas('leads', [
            'name' => 'Lead One',
        ]);
    }

    public function test_crm_forms_require_fields(): void
    {
        Volt::test('apps.form.crm.lost-reason')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
            ]);

        Volt::test('apps.form.crm.company')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'status' => 'required',
            ]);

        Volt::test('apps.form.crm.lead')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'value' => 'required',
            ]);
    }
}
