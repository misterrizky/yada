<?php

namespace Tests\Feature;

use App\Models\CRM\Source;
use App\Models\Finance\TaxRate;
use App\Models\HR\Certificate;
use App\Models\HR\JobLevel;
use App\Models\HR\Skill;
use App\Models\HR\SkillCategory;
use App\Models\Master\Industry;
use App\Models\Master\Pipeline;
use App\Models\Master\Religion;
use App\Models\Master\Stage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class MasterCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_pipelines_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makePipeline('Sales', 'sales');
        $this->makePipeline('Support', 'support');

        $response = $this->actingAs($user)
            ->get(route('app.pipeline'));

        $response->assertOk();
        $response->assertSee('Sales');
        $response->assertSee('Support');
    }

    public function test_pipelines_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $pipeline = $this->makePipeline('Inbound', 'inbound');

        Volt::actingAs($user)
            ->test('apps.master.pipelines.index')
            ->call('deletePipeline', $pipeline->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('pipelines', [
            'id' => $pipeline->id,
        ]);
    }

    public function test_stages_index_shows_records(): void
    {
        $user = User::factory()->create();
        $pipeline = $this->makePipeline('Hiring', 'hiring');

        $this->makeStage($pipeline, 'Screening');
        $this->makeStage($pipeline, 'Interview');

        $response = $this->actingAs($user)
            ->get(route('app.stage'));

        $response->assertOk();
        $response->assertSee('Screening');
        $response->assertSee('Interview');
    }

    public function test_stages_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $pipeline = $this->makePipeline('Deals', 'deals');
        $stage = $this->makeStage($pipeline, 'Negotiation');

        Volt::actingAs($user)
            ->test('apps.master.stages.index')
            ->call('deleteStage', $stage->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('stages', [
            'id' => $stage->id,
        ]);
    }

    public function test_certificates_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeCertificate('AWS', true);
        $this->makeCertificate('GCP', false);

        $response = $this->actingAs($user)
            ->get(route('app.certificate'));

        $response->assertOk();
        $response->assertSee('AWS');
        $response->assertSee('GCP');
    }

    public function test_certificates_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $certificate = $this->makeCertificate('Azure', true);

        Volt::actingAs($user)
            ->test('apps.master.certificates.index')
            ->call('deleteCertificate', $certificate->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('certificates', [
            'id' => $certificate->id,
        ]);
    }

    public function test_job_levels_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeJobLevel('Junior', 'junior', 1, '0.900');
        $this->makeJobLevel('Senior', 'senior', 2, '1.250');

        $response = $this->actingAs($user)
            ->get(route('app.job-level'));

        $response->assertOk();
        $response->assertSee('Junior');
        $response->assertSee('Senior');
    }

    public function test_job_levels_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $jobLevel = $this->makeJobLevel('Lead', 'lead', 3, '1.500');

        Volt::actingAs($user)
            ->test('apps.master.job-levels.index')
            ->call('deleteJobLevel', $jobLevel->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('job_levels', [
            'id' => $jobLevel->id,
        ]);
    }

    public function test_industries_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeIndustry('Technology', true);
        $this->makeIndustry('Finance', true);

        $response = $this->actingAs($user)
            ->get(route('app.industry'));

        $response->assertOk();
        $response->assertSee('Technology');
        $response->assertSee('Finance');
    }

    public function test_industries_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $industry = $this->makeIndustry('Retail', true);

        Volt::actingAs($user)
            ->test('apps.master.industries.index')
            ->call('deleteIndustry', $industry->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('industries', [
            'id' => $industry->id,
        ]);
    }

    public function test_religions_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeReligion('Christian');
        $this->makeReligion('Hindu');

        $response = $this->actingAs($user)
            ->get(route('app.religion'));

        $response->assertOk();
        $response->assertSee('Christian');
        $response->assertSee('Hindu');
    }

    public function test_religions_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $religion = $this->makeReligion('Buddhist');

        Volt::actingAs($user)
            ->test('apps.master.religions.index')
            ->call('deleteReligion', $religion->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('religions', [
            'id' => $religion->id,
        ]);
    }

    public function test_skill_categories_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeSkillCategory('Engineering', true);
        $this->makeSkillCategory('Design', true);

        $response = $this->actingAs($user)
            ->get(route('app.skill-category'));

        $response->assertOk();
        $response->assertSee('Engineering');
        $response->assertSee('Design');
    }

    public function test_skill_categories_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $category = $this->makeSkillCategory('Marketing', true);

        Volt::actingAs($user)
            ->test('apps.master.skill-categories.index')
            ->call('deleteSkillCategory', $category->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('skill_categories', [
            'id' => $category->id,
        ]);
    }

    public function test_skills_index_shows_records(): void
    {
        $user = User::factory()->create();
        $category = $this->makeSkillCategory('Product', true);

        $this->makeSkill('Scrum', $category, true);
        $this->makeSkill('Kanban', $category, true);

        $response = $this->actingAs($user)
            ->get(route('app.skill'));

        $response->assertOk();
        $response->assertSee('Scrum');
        $response->assertSee('Kanban');
    }

    public function test_skills_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $category = $this->makeSkillCategory('Ops', true);
        $skill = $this->makeSkill('Terraform', $category, true);

        Volt::actingAs($user)
            ->test('apps.master.skills.index')
            ->call('deleteSkill', $skill->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('skills', [
            'id' => $skill->id,
        ]);
    }

    public function test_sources_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeSource('LinkedIn', true);
        $this->makeSource('Referral', true);

        $response = $this->actingAs($user)
            ->get(route('app.source'));

        $response->assertOk();
        $response->assertSee('LinkedIn');
        $response->assertSee('Referral');
    }

    public function test_sources_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $source = $this->makeSource('Website', true);

        Volt::actingAs($user)
            ->test('apps.master.sources.index')
            ->call('deleteSource', $source->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('sources', [
            'id' => $source->id,
        ]);
    }

    public function test_tax_rates_index_shows_records(): void
    {
        $user = User::factory()->create();

        $this->makeTaxRate('VAT', '11.00', true, true);
        $this->makeTaxRate('Service', '5.00', false, true);

        $response = $this->actingAs($user)
            ->get(route('app.tax-rate'));

        $response->assertOk();
        $response->assertSee('VAT');
        $response->assertSee('Service');
    }

    public function test_tax_rates_index_deletes_record(): void
    {
        $user = User::factory()->create();
        $taxRate = $this->makeTaxRate('Luxury', '20.00', false, true);

        Volt::actingAs($user)
            ->test('apps.master.tax-rates.index')
            ->call('deleteTaxRate', $taxRate->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('tax_rates', [
            'id' => $taxRate->id,
        ]);
    }

    public function test_master_forms_create_records(): void
    {
        $pipeline = $this->makePipeline('Core', 'core');
        $parentCategory = $this->makeSkillCategory('Engineering', true);

        Volt::test('apps.form.master.pipeline')
            ->call('startCreate')
            ->set('name', 'Growth')
            ->set('flag', 'growth')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-pipeline');

        Volt::test('apps.form.master.stage')
            ->call('startCreate')
            ->set('pipelineId', $pipeline->id)
            ->set('name', 'Qualified')
            ->set('flag', 'qualified')
            ->set('color', '#112233')
            ->set('order', 1)
            ->set('probability', 25)
            ->set('is_default', 0)
            ->set('is_won', 0)
            ->set('is_lost', 0)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-stage');

        Volt::test('apps.form.master.certificate')
            ->call('startCreate')
            ->set('name', 'AWS')
            ->set('description', 'Cloud fundamentals')
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-certificate');

        Volt::test('apps.form.master.job-level')
            ->call('startCreate')
            ->set('name', 'Senior')
            ->set('slug', 'senior')
            ->set('sort_order', 2)
            ->set('multiplier', '1.250')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-job-level');

        Volt::test('apps.form.master.industry')
            ->call('startCreate')
            ->set('name', 'FinTech')
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-industry');

        Volt::test('apps.form.master.religion')
            ->call('startCreate')
            ->set('name', 'Islam')
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-religion');

        Volt::test('apps.form.master.skill-category')
            ->call('startCreate')
            ->set('parentId', $parentCategory->id)
            ->set('name', 'Backend')
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-skill-category');

        $createdCategory = SkillCategory::query()
            ->where('name', 'Backend')
            ->firstOrFail();

        Volt::test('apps.form.master.skill')
            ->call('startCreate')
            ->set('skillCategoryId', $createdCategory->id)
            ->set('name', 'Laravel')
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-skill');

        Volt::test('apps.form.master.source')
            ->call('startCreate')
            ->set('name', 'Referral')
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-source');

        Volt::test('apps.form.master.tax-rate')
            ->call('startCreate')
            ->set('name', 'VAT')
            ->set('rate', '11.00')
            ->set('is_default', 1)
            ->set('is_active', 1)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('modal-close', name: 'form-tax-rate');

        $this->assertDatabaseHas('pipelines', [
            'name' => 'Growth',
            'flag' => 'growth',
        ]);

        $this->assertDatabaseHas('stages', [
            'name' => 'Qualified',
            'pipeline_id' => $pipeline->id,
        ]);

        $this->assertDatabaseHas('certificates', [
            'name' => 'AWS',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('job_levels', [
            'name' => 'Senior',
            'slug' => 'senior',
        ]);

        $this->assertDatabaseHas('industries', [
            'name' => 'FinTech',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('religions', [
            'name' => 'Islam',
        ]);

        $this->assertDatabaseHas('skill_categories', [
            'name' => 'Backend',
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertDatabaseHas('skills', [
            'name' => 'Laravel',
            'skill_category_id' => $createdCategory->id,
        ]);

        $this->assertDatabaseHas('sources', [
            'name' => 'Referral',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('tax_rates', [
            'name' => 'VAT',
            'is_default' => 1,
        ]);
    }

    private function makePipeline(string $name, string $flag): Pipeline
    {
        $pipeline = new Pipeline;
        $pipeline->name = $name;
        $pipeline->flag = $flag;
        $pipeline->save();

        return $pipeline;
    }

    private function makeStage(Pipeline $pipeline, string $name): Stage
    {
        $stage = new Stage;
        $stage->pipeline_id = $pipeline->id;
        $stage->name = $name;
        $stage->flag = strtolower($name);
        $stage->color = '#3498db';
        $stage->order = 1;
        $stage->probability = '25';
        $stage->is_default = 0;
        $stage->is_won = 0;
        $stage->is_lost = 0;
        $stage->save();

        return $stage;
    }

    private function makeCertificate(string $name, bool $isActive): Certificate
    {
        $certificate = new Certificate;
        $certificate->name = $name;
        $certificate->description = $name.' Certification';
        $certificate->is_active = $isActive;
        $certificate->save();

        return $certificate;
    }

    private function makeJobLevel(string $name, string $slug, int $sortOrder, string $multiplier): JobLevel
    {
        $jobLevel = new JobLevel;
        $jobLevel->name = $name;
        $jobLevel->slug = $slug;
        $jobLevel->sort_order = $sortOrder;
        $jobLevel->multiplier = $multiplier;
        $jobLevel->save();

        return $jobLevel;
    }

    private function makeIndustry(string $name, bool $isActive): Industry
    {
        $industry = new Industry;
        $industry->name = $name;
        $industry->is_active = $isActive;
        $industry->save();

        return $industry;
    }

    private function makeReligion(string $name): Religion
    {
        $religion = new Religion;
        $religion->name = $name;
        $religion->save();

        return $religion;
    }

    private function makeSkillCategory(string $name, bool $isActive): SkillCategory
    {
        $category = new SkillCategory;
        $category->name = $name;
        $category->is_active = $isActive;
        $category->save();

        return $category;
    }

    private function makeSkill(string $name, SkillCategory $category, bool $isActive): Skill
    {
        $skill = new Skill;
        $skill->name = $name;
        $skill->skill_category_id = $category->id;
        $skill->is_active = $isActive;
        $skill->save();

        return $skill;
    }

    private function makeSource(string $name, bool $isActive): Source
    {
        $source = new Source;
        $source->name = $name;
        $source->is_active = $isActive;
        $source->save();

        return $source;
    }

    private function makeTaxRate(string $name, string $rate, bool $isDefault, bool $isActive): TaxRate
    {
        $taxRate = new TaxRate;
        $taxRate->name = $name;
        $taxRate->rate = $rate;
        $taxRate->is_default = $isDefault;
        $taxRate->is_active = $isActive;
        $taxRate->save();

        return $taxRate;
    }
}
