<?php

namespace Tests\Feature;

use App\Models\Regional\Country;
use App\Models\Regional\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StateIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_state_index_shows_states_for_selected_country(): void
    {
        $user = User::factory()->create();
        $country = $this->makeCountry('ID', 'IDN', 'Indonesia');
        $otherCountry = $this->makeCountry('US', 'USA', 'United States');

        $this->makeState($country, 'Jakarta');
        $this->makeState($otherCountry, 'California');

        $response = $this->actingAs($user)
            ->get(route('app.country.show-state', ['country' => $country->id]));

        $response->assertOk();
        $response->assertSee('Jakarta');
        $response->assertDontSee('California');
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
}
