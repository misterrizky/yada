<?php

namespace Tests\Feature;

use App\Models\Regional\City;
use App\Models\Regional\Country;
use App\Models\Regional\State;
use App\Models\Regional\Subdistrict;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class RegionalFormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_regional_forms_create_records_for_country(): void
    {
        $country = $this->makeCountry();

        Volt::test('apps.form.regional.state')
            ->call('startCreateFromCountry', $country->id)
            ->set('name', 'Jakarta')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-state');

        Volt::test('apps.form.regional.currency')
            ->call('startCreateFromCountry', $country->id)
            ->set('code', 'usd')
            ->set('name', 'US Dollar')
            ->set('precision', 2)
            ->set('symbol', '$')
            ->set('symbol_native', '$')
            ->set('symbol_first', 1)
            ->set('decimal_mark', '.')
            ->set('thousands_separator', ',')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-currency');

        Volt::test('apps.form.regional.timezone')
            ->call('startCreateFromCountry', $country->id)
            ->set('name', 'Asia/Jakarta')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-timezone');

        Volt::test('apps.form.regional.language')
            ->call('startCreate')
            ->set('code', 'id')
            ->set('name', 'Indonesian')
            ->set('name_native', 'Bahasa Indonesia')
            ->set('dir', 'ltr')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-language');

        $state = State::query()
            ->where('country_id', $country->id)
            ->where('name', 'Jakarta')
            ->firstOrFail();

        Volt::test('apps.form.regional.city')
            ->call('startCreateFromState', $state->id)
            ->set('name', 'Jakarta Selatan')
            ->set('code', 'JKT')
            ->set('type', 'Kota')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-city');

        $city = City::query()
            ->where('state_id', $state->id)
            ->where('name', 'Jakarta Selatan')
            ->firstOrFail();

        Volt::test('apps.form.regional.subdistrict')
            ->call('startCreateFromCity', $city->id)
            ->set('code', '3174')
            ->set('full_code', '3174.01')
            ->set('name', 'Kebayoran Baru')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-subdistrict');

        $subdistrict = Subdistrict::query()
            ->where('city_id', $city->id)
            ->where('name', 'Kebayoran Baru')
            ->firstOrFail();

        Volt::test('apps.form.regional.village')
            ->call('startCreateFromSubdistrict', $subdistrict->id)
            ->set('code', '3174010001')
            ->set('full_code', '3174010001')
            ->set('name', 'Senayan')
            ->set('poscode', '12190')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-village');

        $this->assertDatabaseHas('states', [
            'country_id' => $country->id,
            'country_code' => 'IDN',
            'name' => 'Jakarta',
        ]);

        $this->assertDatabaseHas('currencies', [
            'country_id' => $country->id,
            'code' => 'USD',
            'name' => 'US Dollar',
            'thousands_separator' => ',',
        ]);

        $this->assertDatabaseHas('timezones', [
            'country_id' => $country->id,
            'name' => 'Asia/Jakarta',
        ]);

        $this->assertDatabaseHas('languages', [
            'code' => 'id',
            'name' => 'Indonesian',
            'name_native' => 'Bahasa Indonesia',
            'dir' => 'ltr',
        ]);

        $this->assertDatabaseHas('cities', [
            'country_id' => $country->id,
            'state_id' => $state->id,
            'country_code' => 'IDN',
            'name' => 'Jakarta Selatan',
            'code' => 'JKT',
            'type' => 'Kota',
        ]);

        $this->assertDatabaseHas('subdistricts', [
            'city_id' => $city->id,
            'code' => '3174',
            'full_code' => '3174.01',
            'name' => 'Kebayoran Baru',
        ]);

        $this->assertDatabaseHas('villages', [
            'subdistrict_id' => $subdistrict->id,
            'code' => '3174010001',
            'full_code' => '3174010001',
            'name' => 'Senayan',
            'poscode' => '12190',
        ]);
    }

    public function test_regional_forms_require_basic_fields(): void
    {
        Volt::test('apps.form.regional.state')
            ->call('save')
            ->assertHasErrors([
                'countryId' => 'required',
                'name' => 'required',
            ]);

        Volt::test('apps.form.regional.currency')
            ->call('save')
            ->assertHasErrors([
                'countryId' => 'required',
                'code' => 'required',
                'name' => 'required',
            ]);

        Volt::test('apps.form.regional.timezone')
            ->call('save')
            ->assertHasErrors([
                'countryId' => 'required',
                'name' => 'required',
            ]);

        Volt::test('apps.form.regional.language')
            ->call('save')
            ->assertHasErrors([
                'code' => 'required',
                'name' => 'required',
                'name_native' => 'required',
            ]);

        Volt::test('apps.form.regional.city')
            ->call('save')
            ->assertHasErrors([
                'stateId' => 'required',
                'name' => 'required',
            ]);

        Volt::test('apps.form.regional.subdistrict')
            ->call('save')
            ->assertHasErrors([
                'cityId' => 'required',
                'code' => 'required',
                'full_code' => 'required',
                'name' => 'required',
            ]);

        Volt::test('apps.form.regional.village')
            ->call('save')
            ->assertHasErrors([
                'subdistrictId' => 'required',
                'code' => 'required',
                'full_code' => 'required',
                'name' => 'required',
                'poscode' => 'required',
            ]);
    }

    private function makeCountry(): Country
    {
        $country = new Country;
        $country->iso2 = 'ID';
        $country->iso3 = 'IDN';
        $country->name = 'Indonesia';
        $country->status = 1;
        $country->phone_code = '62';
        $country->region = 'Asia';
        $country->subregion = 'Southeast Asia';
        $country->save();

        return $country;
    }
}
