<?php

namespace Tests\Feature;

use App\Models\Regional\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CountryIndexSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.debug' => false]);
    }

    #[DataProvider('searchProvider')]
    public function test_country_index_search_filters_results(string $search, string $expectedName, string $unexpectedName): void
    {
        $this->seedCountries();
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.master.regional.country.index')
            ->set('search', $search)
            ->assertSee($expectedName)
            ->assertDontSee($unexpectedName);
    }

    public function test_country_index_includes_loading_skeleton_markup(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.master.regional.country.index')
            ->assertSee('wire:loading', false)
            ->assertSee('wire:loading.remove', false);
    }

    public function test_country_index_renders_notification_component(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('app.country'))
            ->assertOk()
            ->assertSeeLivewire('apps.shared.notification.form');
    }

    public function test_country_index_renders_header_dropdown_items(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.master.regional.country.index')
            ->assertSee('Import Countries')
            ->assertSee('Export Countries');
    }

    public function test_country_index_view_settings_can_hide_columns(): void
    {
        $user = User::factory()->create();

        Volt::actingAs($user)
            ->test('apps.master.regional.country.index')
            ->call('openViewSettings')
            ->set('viewSettingsDraft.visibleColumns', ['name'])
            ->call('saveViewSettings')
            ->assertSet('visibleColumns', ['name'])
            ->assertSee('Action')
            ->assertDontSee('Code');
    }

    public function test_country_index_deletes_country(): void
    {
        $user = User::factory()->create();
        $country = new Country;
        $country->iso2 = 'ID';
        $country->name = 'Indonesia';
        $country->status = 1;
        $country->phone_code = '62';
        $country->iso3 = 'IDN';
        $country->region = 'Asia';
        $country->subregion = 'South East Asia';
        $country->save();

        Volt::actingAs($user)
            ->test('apps.master.regional.country.index')
            ->call('deleteCountry', $country->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('countries', [
            'id' => $country->id,
        ]);
    }

    /**
     * @return array<int, array{0: string, 1: string, 2: string}>
     */
    public static function searchProvider(): array
    {
        return [
            ['AA', 'AlphaLand', 'BetaRepublic'],
            ['Beta', 'BetaRepublic', 'AlphaLand'],
            ['777', 'AlphaLand', 'BetaRepublic'],
            ['SouthRealm', 'BetaRepublic', 'AlphaLand'],
            ['NorthwestReach', 'AlphaLand', 'BetaRepublic'],
        ];
    }

    private function seedCountries(): void
    {
        $alpha = new Country;
        $alpha->iso2 = 'AA';
        $alpha->name = 'AlphaLand';
        $alpha->status = 1;
        $alpha->phone_code = '777';
        $alpha->iso3 = 'AAA';
        $alpha->region = 'NorthRealm';
        $alpha->subregion = 'NorthwestReach';
        $alpha->save();

        $beta = new Country;
        $beta->iso2 = 'BB';
        $beta->name = 'BetaRepublic';
        $beta->status = 1;
        $beta->phone_code = '888';
        $beta->iso3 = 'BBB';
        $beta->region = 'SouthRealm';
        $beta->subregion = 'SoutheastReach';
        $beta->save();
    }
}
