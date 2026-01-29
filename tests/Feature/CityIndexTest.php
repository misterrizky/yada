<?php

namespace Tests\Feature;

use App\Models\Regional\City;
use App\Models\Regional\Country;
use App\Models\Regional\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_city_index_shows_cities_for_selected_state(): void
    {
        $user = User::factory()->create();
        $country = $this->makeCountry('ID', 'IDN', 'Indonesia');
        $otherCountry = $this->makeCountry('US', 'USA', 'United States');

        $state = $this->makeState($country, 'Jakarta');
        $otherState = $this->makeState($otherCountry, 'California');

        $this->makeCity($country, $state, 'Jakarta Selatan');
        $this->makeCity($otherCountry, $otherState, 'Los Angeles');

        $response = $this->actingAs($user)
            ->get(route('app.state.show-city', ['state' => $state->id]));

        $response->assertOk();
        $response->assertSee('Jakarta Selatan');
        $response->assertDontSee('Los Angeles');
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
}
