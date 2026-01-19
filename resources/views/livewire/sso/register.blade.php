<?php

use App\Models\CRM\Company;
use App\Models\CRM\CompanyAddress;
use App\Models\Regional\City;
use App\Models\Regional\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Livewire\Features\SupportRedirects\Redirector;

use function Livewire\Volt\state;

state([
    'step' => 1,

    'role' => null,
    'account_type' => null,

    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => '',
    'company_industry' => '',
    'company_name' => '',
    'company_email' => '',
    'company_phone' => '',
    'company_website' => '',
    'company_address_line1' => '',
    'company_country' => '',
    'company_state' => '',
    'company_city' => '',
    'company_postal_code' => '',
    'selected_country' => '',
    'selected_state' => '',

    'layout' => fn() => app(\App\Settings\AppearanceSettings::class)->layout_auth,
    'allow_registration' => fn() => app(\App\Settings\AuthSettings::class)->client_allow_registration,
]);

$rulesForStep = function (int $step): array {
    return match ($step) {
        1 => [
            'role' => ['required', Rule::in(['Client', 'Partner'])],
        ],
        2 => [
            'account_type' => ['required', 'exists:user_types,id'],
        ],
        3 => [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'], // kalau mau unique: -> 'unique:users,email'
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        4 => [
            'company_industry' => ['required'],
        ],
        5 => [
            'company_name' => ['required', 'string', 'max:255'],
            'company_email' => ['required', 'email', 'max:255'],
            'company_phone' => ['required', 'string', 'max:255'],
            'company_website' => ['nullable', 'string', 'max:255'],
        ],
        6 => [
            'company_address_line1' => ['required', 'string', 'max:255'],
            'company_country' => ['required'],
            'company_state' => ['required'],
            'company_city' => ['required'],
            'company_postal_code' => ['required', 'string', 'max:255'],
        ],
        default => [],
    };
};

$nextStep = function () use ($rulesForStep): void {
    // validasi step saat ini dulu, baru maju
    $this->validate($rulesForStep($this->step));

    $maxStep = $this->account_type === '1' ? 6 : 3;
    $this->step = min($maxStep, $this->step + 1);
};

$previousStep = function (): void {
    $this->step = max(1, $this->step - 1);
};

$signup = function (CreatesNewUsers $creator) use ($rulesForStep): Redirector {
    // dd($this->account_type);
    // pastikan semua step tervalidasi sebelum create
    $rules = array_merge(
        $rulesForStep(1),
        $rulesForStep(2),
        $rulesForStep(3),
    );

    if ($this->account_type === '1') {
        $rules = array_merge($rules, $rulesForStep(4), $rulesForStep(5));
    }

    $this->validate($rules);

    $user = $creator->create([
        // NOTE: kalau user_type_id kamu butuh integer, map dulu dari 'corporate/individual' -> id
        'user_type_id' => $this->account_type == '1' ? 1 : 2, // contoh mapping
        'name' => $this->name,
        'email' => $this->email,
        'password' => $this->password,
        'password_confirmation' => $this->password_confirmation,
    ]);

    if ($this->account_type === '1') {
        $company = new Company();
        $company->ulid = (string) Str::ulid();
        $company->name = $this->company_name;
        $base = Str::upper(trim($this->company_name));
        $hash = strtoupper(substr(md5($base), 0, 6));
        $company->code = "CMP-{$hash}";
        $company->email = $this->company_email;
        $company->phone = $this->company_phone;
        $company->website = $this->company_website;
        $company->industry_id = $this->company_industry;
        $company->currency_id = \App\Models\Regional\Currency::where('country_id',$this->company_country)->first()->id ?? null;
        $company->created_by = $user->id;
        $company->updated_by = $user->id;
        $company->save();
        
        $user->company()->associate($company);
        $user->save();

        $companyAddress = new CompanyAddress();
        $companyAddress->company_id = $company->id;
        $companyAddress->label = 'Main';
        $companyAddress->address_line1 = $this->company_address_line1;
        $companyAddress->country_id = $this->company_country;
        $companyAddress->state_id = $this->company_state;
        $companyAddress->city_id = $this->company_city;
        $companyAddress->postal_code = $this->company_postal_code;
        $companyAddress->is_default = true;
        $companyAddress->save();
    }

    $user->assignRole($this->role);

    Auth::login($user);

    return redirect()->intended('/onboarding');
};
$updatedCompanyCountry = function(){
    // dd($this->company_country);
    $this->selected_country = $this->company_country;
};
$updatedCompanyState = function(){
    $this->selected_state = $this->company_state;
};

?>

<div class="w-full">
    @if ($layout == 'card' || $layout == 'simple' || $layout == 'split')
        <div class="flex flex-col gap-6">
            <x-auth-header
                :title="__('Create an account')"
                :description="__('Enter your details below to create your account')"
            />

            <x-auth-session-status class="text-center" :status="session('status')" />

            @if (! $allow_registration)
                <div class="rounded-lg border p-4 text-sm text-zinc-700 dark:text-zinc-300">
                    Registration is currently disabled.
                </div>
            @else
                <form wire:submit="signup" class="flex flex-col gap-6">
                    {{-- STEP 1 --}}
                    @if ($step === 1)
                        <flux:radio.group
                            wire:model="role"
                            label="Choose your role"
                            variant="cards"
                            :indicator="false"
                            class="flex-col"
                        >
                            <flux:radio
                                value="Client"
                                icon="user"
                                label="Client"
                                description="I registered to use the service as a client."
                            />
                            <flux:radio
                                value="Partner"
                                icon="user-group"
                                label="Partner"
                                description="I registered to work together as a partner/affiliate."
                            />
                        </flux:radio.group>
                        <div class="flex items-center justify-end">
                            <flux:button
                                type="button"
                                wire:click="nextStep"
                                variant="primary"
                                class="w-full"
                                {{-- :disabled="blank($role)" --}}
                            >
                                {{ __('Next') }}
                            </flux:button>
                        </div>
                    @endif

                    {{-- STEP 2 --}}
                    @if ($step === 2)
                        <flux:radio.group
                            wire:model="account_type"
                            label="Choose account type"
                            variant="cards"
                            :indicator="false"
                            class="flex-col"
                        >
                            <flux:radio
                                value="1"
                                icon="building-office-2"
                                label="Corporate"
                                description="For companies/organizations (business account)."
                            />
                            <flux:radio
                                value="2"
                                icon="user"
                                label="Individual"
                                description="For individuals (personal account)."
                            />
                        </flux:radio.group>

                        <div class="flex items-center gap-3">
                            <flux:button
                                type="button"
                                wire:click="previousStep"
                                variant="outline"
                                class="w-full"
                            >
                                {{ __('Previous') }}
                            </flux:button>

                            <flux:button
                                type="button"
                                wire:click="nextStep"
                                variant="primary"
                                class="w-full"
                                {{-- :disabled="blank($account_type)" --}}
                            >
                                {{ __('Next') }}
                            </flux:button>
                        </div>
                    @endif

                    {{-- STEP 3 --}}
                    @if ($step === 3)
                        <flux:input
                            wire:model="name"
                            :label="__('Name')"
                            type="text"
                            required
                            autofocus
                            autocomplete="name"
                            :placeholder="__('Full name')"
                        />

                        <flux:input
                            wire:model="email"
                            :label="__('Email address')"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="email@example.com"
                        />

                        <flux:input
                            wire:model="password"
                            :label="__('Password')"
                            type="password"
                            required
                            autocomplete="new-password"
                            :placeholder="__('Password')"
                            viewable
                        />

                        <flux:input
                            wire:model="password_confirmation"
                            :label="__('Confirm password')"
                            type="password"
                            required
                            autocomplete="new-password"
                            :placeholder="__('Confirm password')"
                            viewable
                        />

                        <div class="flex items-center gap-3">
                            <flux:button
                                type="button"
                                wire:click="previousStep"
                                variant="outline"
                                class="w-full"
                            >
                                {{ __('Previous') }}
                            </flux:button>

                            @if ($account_type === '1')
                                <flux:button
                                    type="button"
                                    wire:click="nextStep"
                                    variant="primary"
                                    class="w-full"
                                >
                                    {{ __('Next') }}
                                </flux:button>
                            @else
                                <flux:button
                                    type="submit"
                                    variant="primary"
                                    class="w-full"
                                >
                                    {{ __('Create account') }}
                                </flux:button>
                            @endif
                        </div>
                    @endif

                    {{-- STEP 4 --}}
                    @if ($step === 4 && $account_type === '1')
                        <flux:select variant="listbox" wire:model="company_industry" :label="__('Company Industry')" searchable placeholder="Choose industries...">
                            @foreach (\App\Models\Master\Industry::get() as $item)
                                <flux:select.option value="{{ $item->id }}" wire:key="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                            @endforeach
                        </flux:select>
                        <div class="flex items-center gap-3">
                            <flux:button
                                type="button"
                                wire:click="previousStep"
                                variant="outline"
                                class="w-full"
                            >
                                {{ __('Previous') }}
                            </flux:button>

                            <flux:button
                                type="button"
                                wire:click="nextStep"
                                variant="primary"
                                class="w-full"
                            >
                                {{ __('Next') }}
                            </flux:button>
                        </div>
                    @endif
                    
                    @if ($step === 5 && $account_type === '1')
                        <flux:input
                            wire:model="company_name"
                            :label="__('Company Name')"
                            type="text"
                            required
                            autocomplete="organization"
                            :placeholder="__('Company Name')"
                        />

                        <flux:input
                            wire:model="company_email"
                            :label="__('Company email')"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="company@example.com"
                        />

                        <flux:input
                            wire:model="company_phone"
                            :label="__('Company Phone')"
                            type="tel"
                            required
                            autocomplete="tel"
                            :placeholder="__('Company phone')"
                        />

                        <flux:input
                            wire:model="company_website"
                            :label="__('Company Website')"
                            type="url"
                            autocomplete="url"
                            :placeholder="__('Company website')"
                        />

                        <div class="flex items-center gap-3">
                            <flux:button
                                type="button"
                                wire:click="previousStep"
                                variant="outline"
                                class="w-full"
                            >
                                {{ __('Previous') }}
                            </flux:button>

                            <flux:button
                                type="button"
                                wire:click="nextStep"
                                variant="primary"
                                class="w-full"
                            >
                                {{ __('Next') }}
                            </flux:button>
                        </div>
                    @endif

                    {{-- STEP 6 --}}
                    @if ($step === 6 && $account_type === '1')
                        <div class="flex flex-col gap-6">
                            <!-- Address line -->
                            <flux:input
                                wire:model="company_address_line1"
                                :label="__('Company Address')"
                                type="text"
                                required
                                autocomplete="address-line1"
                                :placeholder="__('886 Walter Street')"
                            />

                            <!-- Grid 2 columns -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- State (Select) -->
                                <flux:select
                                    wire:model.live="company_country"
                                    variant="listbox"
                                    :label="__('Company Country')"
                                    searchable
                                    placeholder="Choose Country..."
                                >
                                    @foreach (\App\Models\Regional\Country::get() as $item)
                                        <flux:select.option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                            {{ $item->name }}
                                        </flux:select.option>
                                    @endforeach
                                </flux:select>

                                <!-- State (Select) -->
                                <flux:select
                                    wire:model.live="company_state"
                                    variant="listbox"
                                    :label="__('Company State')"
                                    searchable
                                    placeholder="Choose State..."
                                >
                                    @if($this->selected_country)
                                        @foreach (\App\Models\Regional\State::where('country_id', $this->selected_country)->get() as $item)
                                            <flux:select.option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                                {{ $item->name }}
                                            </flux:select.option>
                                        @endforeach
                                    @endif
                                </flux:select>

                                <!-- City -->
                                <!-- State (Select) -->
                                <flux:select
                                    wire:model="company_city"
                                    variant="listbox"
                                    :label="__('Company City')"
                                    searchable
                                    placeholder="Choose City..."
                                >
                                    @if($this->selected_state)
                                        @foreach (\App\Models\Regional\City::where('state_id', $this->selected_state)->get() as $item)
                                            <flux:select.option value="{{ $item->id }}" wire:key="{{ $item->id }}">
                                                {{ $item->type ? $item->type . ' ' : '' }} {{ $item->name }}
                                            </flux:select.option>
                                        @endforeach
                                    @endif
                                </flux:select>

                                <!-- Postal Code -->
                                <flux:input
                                    wire:model="company_postal_code"
                                    :label="__('Company Postal Code')"
                                    type="text"
                                    required
                                    autocomplete="postal-code"
                                    :placeholder="__('12345')"
                                />
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <flux:button
                                type="button"
                                wire:click="previousStep"
                                variant="outline"
                                class="w-full"
                            >
                                {{ __('Previous') }}
                            </flux:button>

                            <flux:button
                                type="submit"
                                variant="primary"
                                class="w-full"
                            >
                                {{ __('Create account') }}
                            </flux:button>
                        </div>
                    @endif
                </form>

                <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Already have an account?') }}</span>
                    <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
                </div>
            @endif
        </div>
    @else
        <form wire:submit="signup" class="kt-card-content flex flex-col gap-5 p-10">
            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">Sign up</h3>
                <div class="flex items-center justify-center">
                    <span class="text-sm text-secondary-foreground me-1.5">Already have an Account ?</span>
                    <a class="text-sm link" href="{{ route('login') }}" wire:navigate>Sign In</a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2.5">
                <a class="kt-btn kt-btn-outline justify-center" href="#"><img alt=""
                        class="size-3.5 shrink-0" src="assets/media/brand-logos/google.svg" />Use Google</a>
                <a class="kt-btn kt-btn-outline justify-center" href="#"><img alt=""
                        class="size-3.5 shrink-0 dark:hidden" src="assets/media/brand-logos/apple-black.svg" /><img
                        alt="" class="size-3.5 shrink-0 light:hidden"
                        src="assets/media/brand-logos/apple-white.svg" />Use Apple</a>
            </div>
            <div class="flex items-center gap-2">
                <span class="border-t border-border w-full"></span>
                <span class="text-xs text-secondary-foreground uppercase">or</span>
                <span class="border-t border-border w-full"></span>
            </div>
            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">Name</label>
                <input wire:model="name" class="kt-input" placeholder="Full name" type="text" />
                @error('name')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono">Email</label>
                <input wire:model="email" class="kt-input" placeholder="email@email.com" type="email" />
                @error('email')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Password</label>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input wire:model="password" placeholder="Enter Password" type="password">
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true" type="button">
                        <span class="kt-toggle-password-active:hidden"><i
                                class="ki-filled ki-eye text-muted-foreground"></i></span>
                        <span class="hidden kt-toggle-password-active:block"><i
                                class="ki-filled ki-eye-slash text-muted-foreground"></i></span>
                    </button>
                </div>
                @error('password')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono">Confirm Password</label>
                <div class="kt-input" data-kt-toggle-password="true">
                    <input wire:model="password_confirmation" placeholder="Re-enter Password" type="password" />
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true" type="button">
                        <span class="kt-toggle-password-active:hidden"><i
                                class="ki-filled ki-eye text-muted-foreground"></i></span>
                        <span class="hidden kt-toggle-password-active:block"><i
                                class="ki-filled ki-eye-slash text-muted-foreground"></i></span>
                    </button>
                </div>
                @error('password_confirmation')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <label class="kt-checkbox-group">
                <input class="kt-checkbox kt-checkbox-sm" type="checkbox" value="1" />
                <span class="kt-checkbox-label">I accept <a class="text-sm link" href="#">Terms &
                        Conditions</a></span>
            </label>
            <button class="kt-btn kt-btn-primary flex justify-center grow">Sign up</button>
        </form>
    @endif
</div>
