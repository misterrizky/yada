<?php

namespace Tests\Feature;

use App\Models\Regional\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class CountryDrawerFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_country_form_creates_country(): void
    {
        Volt::test('apps.form.country')
            ->set('iso2', 'US')
            ->set('iso3', 'USA')
            ->set('phone_code', '1')
            ->set('name', 'United States')
            ->set('region', 'Americas')
            ->set('subregion', 'Northern America')
            ->set('status', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-country');

        $this->assertDatabaseHas('countries', [
            'iso2' => 'US',
            'iso3' => 'USA',
            'phone_code' => '1',
            'name' => 'United States',
            'region' => 'Americas',
            'subregion' => 'Northern America',
            'status' => 1,
        ]);
    }

    public function test_country_form_updates_country(): void
    {
        $country = new Country;
        $country->iso2 = 'ID';
        $country->iso3 = 'IDN';
        $country->phone_code = '62';
        $country->name = 'Indonesia';
        $country->region = 'Asia';
        $country->subregion = 'South East Asia';
        $country->status = 1;
        $country->save();

        Volt::test('apps.form.country')
            ->call('startEdit', $country->id)
            ->assertDispatched('modal-show', name: 'form-country')
            ->set('name', 'Indonesia Raya')
            ->set('status', 0)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-country');

        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'name' => 'Indonesia Raya',
            'status' => 0,
        ]);
    }

    public function test_country_form_requires_required_fields(): void
    {
        Volt::test('apps.form.country')
            ->call('save')
            ->assertHasErrors([
                'iso2' => 'required',
                'iso3' => 'required',
                'phone_code' => 'required',
                'name' => 'required',
                'region' => 'required',
                'subregion' => 'required',
            ]);
    }

    public function test_country_form_validates_field_lengths_and_status(): void
    {
        Volt::test('apps.form.country')
            ->set('iso2', 'A')
            ->set('iso3', 'US')
            ->set('phone_code', '123456')
            ->set('name', 'Test Country')
            ->set('region', 'Test Region')
            ->set('subregion', 'Test Subregion')
            ->set('status', 3)
            ->call('save')
            ->assertHasErrors([
                'iso2' => 'size',
                'iso3' => 'size',
                'phone_code' => 'max',
                'status' => 'in',
            ]);
    }
}
