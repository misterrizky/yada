<?php

namespace Tests\Feature;

use App\Models\Master\BloodType;
use App\Models\Master\Degree;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class MasterReferenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_blood_types_index_shows_records(): void
    {
        $user = User::factory()->create();

        BloodType::create(['name' => 'A']);
        BloodType::create(['name' => 'B']);

        $response = $this->actingAs($user)
            ->get(route('app.blood-type'));

        $response->assertOk();
        $response->assertSee('A');
        $response->assertSee('B');
    }

    public function test_blood_types_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $bloodType = BloodType::create(['name' => 'AB']);

        Volt::actingAs($user)
            ->test('apps.master.blood-type.index')
            ->call('deleteBloodType', $bloodType->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('blood_types', [
            'id' => $bloodType->id,
        ]);
    }

    public function test_degrees_index_shows_records(): void
    {
        $user = User::factory()->create();

        Degree::create([
            'code' => 'BSC',
            'name' => 'Bachelor of Science',
            'order' => 1,
        ]);
        Degree::create([
            'code' => 'MSC',
            'name' => 'Master of Science',
            'order' => 2,
        ]);

        $response = $this->actingAs($user)
            ->get(route('app.degree'));

        $response->assertOk();
        $response->assertSee('Bachelor of Science');
        $response->assertSee('Master of Science');
    }

    public function test_degrees_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $degree = Degree::create([
            'code' => 'PHD',
            'name' => 'Doctor of Philosophy',
            'order' => 3,
        ]);

        Volt::actingAs($user)
            ->test('apps.master.degree.index')
            ->call('deleteDegree', $degree->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('degrees', [
            'id' => $degree->id,
        ]);
    }

    public function test_master_forms_create_records(): void
    {
        Volt::test('apps.form.master.blood-type')
            ->call('startCreate')
            ->set('name', 'O')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-blood-type');

        Volt::test('apps.form.master.degree')
            ->call('startCreate')
            ->set('code', 'AA')
            ->set('name', 'Associate of Arts')
            ->set('order', 4)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-degree');

        $this->assertDatabaseHas('blood_types', [
            'name' => 'O',
        ]);

        $this->assertDatabaseHas('degrees', [
            'code' => 'AA',
            'name' => 'Associate of Arts',
            'order' => 4,
        ]);
    }

    public function test_master_forms_require_fields(): void
    {
        Volt::test('apps.form.master.blood-type')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
            ]);

        Volt::test('apps.form.master.degree')
            ->call('save')
            ->assertHasErrors([
                'code' => 'required',
                'name' => 'required',
            ]);
    }
}
