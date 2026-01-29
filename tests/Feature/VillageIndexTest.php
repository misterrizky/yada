<?php

namespace Tests\Feature;

use App\Models\Regional\City;
use App\Models\Regional\Country;
use App\Models\Regional\State;
use App\Models\Regional\Subdistrict;
use App\Models\Regional\Village;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VillageIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_village_index_shows_villages_for_selected_subdistrict(): void
    {
        $user = User::factory()->create();
        $country = $this->makeCountry('ID', 'IDN', 'Indonesia');
        $otherCountry = $this->makeCountry('US', 'USA', 'United States');

        $state = $this->makeState($country, 'Jakarta');
        $otherState = $this->makeState($otherCountry, 'California');

        $city = $this->makeCity($country, $state, 'Jakarta Selatan');
        $otherCity = $this->makeCity($otherCountry, $otherState, 'Los Angeles');

        $subdistrict = $this->makeSubdistrict($city, '3174', '3174.01', 'Kebayoran Baru');
        $otherSubdistrict = $this->makeSubdistrict($otherCity, '0603', '0603.10', 'Hollywood');

        $this->makeVillage($subdistrict, '3174010001', '3174010001', 'Senayan', '12190');
        $this->makeVillage($otherSubdistrict, '0603010001', '0603010001', 'Beverly Hills', '90210');

        $response = $this->actingAs($user)
            ->get(route('app.subdistrict.show-village', ['subdistrict' => $subdistrict->id]));

        $response->assertOk();
        $response->assertSee('Senayan');
        $response->assertDontSee('Beverly Hills');
    }

    private function makeCountry(string $iso2, string $iso3, string $name): Country
    {
        $country = new Country;
        $country->iso2 = $iso2;
        $country->iso3 = $iso3;
        $country->name = $name;
        $country->status = 1;
        $country->phone_code = '62';
        $country->region = 'Asia';
        $country->subregion = 'Southeast Asia';
        $country->save();

        return $country;
    }

    private function makeState(Country $country, string $name): State
    {
        $state = new State;
        $state->country_id = $country->id;
        $state->country_code = (string) $country->iso3;
        $state->name = $name;
        $state->save();

        return $state;
    }

    private function makeCity(Country $country, State $state, string $name): City
    {
        $city = new City;
        $city->country_id = $country->id;
        $city->state_id = $state->id;
        $city->country_code = (string) $country->iso3;
        $city->name = $name;
        $city->code = null;
        $city->type = null;
        $city->save();

        return $city;
    }

    private function makeSubdistrict(City $city, string $code, string $fullCode, string $name): Subdistrict
    {
        $subdistrict = new Subdistrict;
        $subdistrict->city_id = $city->id;
        $subdistrict->code = $code;
        $subdistrict->full_code = $fullCode;
        $subdistrict->name = $name;
        $subdistrict->save();

        return $subdistrict;
    }

    private function makeVillage(Subdistrict $subdistrict, string $code, string $fullCode, string $name, string $poscode): Village
    {
        $village = new Village;
        $village->subdistrict_id = $subdistrict->id;
        $village->code = $code;
        $village->full_code = $fullCode;
        $village->name = $name;
        $village->poscode = $poscode;
        $village->save();

        return $village;
    }
}
