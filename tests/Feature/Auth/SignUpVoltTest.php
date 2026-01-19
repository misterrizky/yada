<?php

namespace Tests\Feature\Auth;

use App\Models\CRM\Company;
use App\Models\Regional\City;
use App\Models\Regional\Country;
use App\Models\Regional\State;
use App\Models\User\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SignUpVoltTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedRoles();
        $this->seedUserTypes();
    }

    public function test_new_individual_users_can_register_using_volt(): void
    {
        Volt::test('sso.register')
            ->set('role', 'Client')
            ->set('account_type', '2')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('signup')
            ->assertHasNoErrors()
            ->assertRedirect(route('app.onboarding', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'user_type_id' => 2,
        ]);
        $this->assertDatabaseCount('companies', 0);
    }

    public function test_corporate_users_can_register_using_volt_with_company_and_address(): void
    {
        ['state' => $state, 'city' => $city] = $this->seedLocation();

        Volt::test('sso.register')
            ->set('role', 'Client')
            ->set('account_type', '1')
            ->set('name', 'Corporate User')
            ->set('email', 'corp@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('company_name', 'Acme Inc')
            ->set('company_email', 'contact@acme.test')
            ->set('company_phone', '628123456789')
            ->set('company_website', 'https://acme.test')
            ->set('company_address_line1', 'Jl. Merdeka No. 1')
            ->set('company_state', $state->name)
            ->set('company_city', $city->name)
            ->set('company_postal_code', '40123')
            ->call('signup')
            ->assertHasNoErrors()
            ->assertRedirect(route('app.onboarding', absolute: false));

        $this->assertAuthenticated();

        $company = Company::query()->where('name', 'Acme Inc')->first();

        $this->assertNotNull($company);
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name' => 'Acme Inc',
            'email' => 'contact@acme.test',
            'phone' => '628123456789',
            'website' => 'https://acme.test',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'corp@example.com',
            'company_id' => $company->id,
        ]);
        $this->assertDatabaseHas('company_addresses', [
            'company_id' => $company->id,
            'address_line1' => 'Jl. Merdeka No. 1',
            'state_id' => $state->id,
            'city_id' => $city->id,
            'postal_code' => '40123',
            'is_default' => 1,
        ]);
    }

    public function test_registration_requires_validation(): void
    {
        Volt::test('sso.register')
            ->set('name', '')
            ->set('email', '')
            ->set('password', '')
            ->set('password_confirmation', '')
            ->call('signup')
            ->assertHasErrors(['role', 'account_type', 'name', 'email', 'password']);
    }

    public function test_corporate_registration_requires_company_fields(): void
    {
        Volt::test('sso.register')
            ->set('role', 'Client')
            ->set('account_type', '1')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('signup')
            ->assertHasErrors([
                'company_name',
                'company_email',
                'company_phone',
                'company_website',
                'company_address_line1',
                'company_state',
                'company_city',
                'company_postal_code',
            ]);
    }

    private function seedRoles(): void
    {
        Role::firstOrCreate([
            'name' => 'Client',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'Partner',
            'guard_name' => 'web',
        ]);
    }

    private function seedUserTypes(): void
    {
        $corporate = new UserType;
        $corporate->name = 'Corporate';
        $corporate->save();

        $individual = new UserType;
        $individual->name = 'Individual';
        $individual->save();
    }

    /**
     * @return array{state: State, city: City}
     */
    private function seedLocation(): array
    {
        $country = new Country;
        $country->iso2 = 'ID';
        $country->name = 'Indonesia';
        $country->status = 1;
        $country->phone_code = '62';
        $country->iso3 = 'IDN';
        $country->region = 'Asia';
        $country->subregion = 'Southeast Asia';
        $country->save();

        $state = new State;
        $state->country_id = $country->id;
        $state->country_code = $country->iso3;
        $state->name = 'Jawa Barat';
        $state->save();

        $city = new City;
        $city->country_id = $country->id;
        $city->state_id = $state->id;
        $city->code = 'BDG';
        $city->name = 'Bandung';
        $city->type = 'City';
        $city->country_code = $country->iso3;
        $city->save();

        return ['state' => $state, 'city' => $city];
    }
}
