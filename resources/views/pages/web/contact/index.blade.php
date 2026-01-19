<?php

use function Laravel\Folio\name;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

name('web.contact');

new class extends Component {
    #[Validate('required')]
    public $first_name;
    #[Validate('required')]
    public $last_name;
    #[Validate('required|email')]
    public $email;
    #[Validate('required')]
    public $budget;

    public $website;
    #[Validate('required')]
    public $message;

    public function send()
    {
        $this->validate();

        \App\Models\Support\ContactMessage::create([
            'name' => $this->first_name . ' ' . $this->last_name,
            'email' => $this->email,
            'budget' => $this->budget,
            'website' => $this->website,
            'messages' => $this->message,
        ]);

        $this->reset();

        session()->flash('message', 'Message sent successfully!');
    }
}
?>
<x-layouts.web :title="__('Contact YE: Your Tech Partner for Business Growth')" :description="__('')">
    @volt
    <div>
        <div class="relative isolate overflow-hidden bg-white py-24 sm:py-32 dark:bg-black">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=screen"
                alt="" class="absolute inset-0 -z-10 size-full object-cover opacity-10 dark:hidden" />
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&crop=focalpoint&fp-y=.8&w=2830&h=1500&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply"
                alt="" class="absolute inset-0 -z-10 size-full object-cover not-dark:hidden" />
            <div aria-hidden="true"
                class="hidden sm:absolute sm:-top-10 sm:right-1/2 sm:-z-10 sm:mr-10 sm:block sm:transform-gpu sm:blur-3xl">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                    class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-15 dark:opacity-20">
                </div>
            </div>
            <div aria-hidden="true"
                class="absolute -top-52 left-1/2 -z-10 -translate-x-1/2 transform-gpu blur-3xl sm:-top-112 sm:ml-16 sm:translate-x-0">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                    class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-15 dark:opacity-20">
                </div>
            </div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl dark:text-white">Support
                        center</h2>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-700 sm:text-xl/8 dark:text-gray-400">Our Support Center delivers reliable and responsive technical support to maintain system stability, resolve issues efficiently, and ensure your business operations run smoothly and without interruption.</p>
                </div>
            </div>
        </div>
        <div class="relative isolate px-6 py-24 sm:py-32 lg:px-8">
            <svg aria-hidden="true"
                class="absolute inset-0 -z-10 size-full mask-[radial-gradient(100%_100%_at_top_right,white,transparent)] stroke-gray-200 dark:stroke-white/10">
                <defs>
                    <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="50%" y="-64"
                        patternUnits="userSpaceOnUse">
                        <path d="M100 200V.5M.5 .5H200" fill="none" />
                    </pattern>
                </defs>
                <svg x="50%" y="-64" class="overflow-visible fill-gray-50 dark:fill-gray-800/40">
                    <path
                        d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M299.5 800h201v201h-201Z"
                        stroke-width="0" />
                </svg>
                <rect width="100%" height="100%" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" stroke-width="0" />
            </svg>
            <div class="mx-auto max-w-xl lg:max-w-4xl">
                <h2 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl">
                    Let’s talk
                    about your project
                </h2>
                <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-400">
                    We help companies and individuals build out
                    their brand
                    guidelines.
                </p>
                <div class="mt-16 flex flex-col gap-16 sm:gap-y-20 lg:flex-row">
                    <form wire:submit="send" class="lg:flex-auto">
                        @if (session()->has('message'))
                            <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm/6 font-semibold">
                                    First name
                                </label>
                                <div class="mt-2.5">
                                    <input id="first-name" type="text" wire:model="first_name" autocomplete="given-name"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                                </div>
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm/6 font-semibold">Last
                                    name</label>
                                <div class="mt-2.5">
                                    <input id="last-name" type="text" wire:model="last_name" autocomplete="family-name"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                                </div>
                                @error('last_name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm/6 font-semibold">Email</label>
                                <div class="mt-2.5">
                                    <input id="email" type="email" wire:model="email" autocomplete="email"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="budget" class="block text-sm/6 font-semibold">Budget</label>
                                <div class="mt-2.5">
                                    <select id="budget" wire:model="budget"
                                        class="block w-full rounded-md bg-white/5 px-3 py-2 text-base text-black dark:text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 [&>option]:text-black">
                                        <option value="">Select a budget</option>
                                        <option value="<$50k"><$50k</option>
                                        <option value="$50k - $100k">$50k - $100k</option>
                                        <option value="$100k - $200k">$100k - $200k</option>
                                        <option value=">$200k">>$200k</option>
                                        <option value="Lets Discuss">Lets Discuss</option>
                                    </select>
                                </div>
                                @error('budget')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="website" class="block text-sm/6 font-semibold">Website</label>
                                <div class="mt-2.5">
                                    <input id="website" type="url" wire:model="website"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                                </div>
                                @error('website')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="message" class="block text-sm/6 font-semibold">Message</label>
                                <div class="mt-2.5">
                                    <textarea id="message" wire:model="message" rows="4"
                                        class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
                                </div>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit"
                                class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white dark:text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">Let’s
                                talk</button>
                        </div>
                        <p class="mt-4 text-sm/6 text-gray-500 dark:text-gray-400">
                            By submitting this form, I agree to the
                            <a href="#" class="font-semibold whitespace-nowrap text-indigo-600 dark:text-indigo-400">
                                privacy policy
                            </a>.
                        </p>
                    </form>
                    <div class="lg:mt-6 lg:w-80 lg:flex-none">
                        <img src="/plus-assets/img/logos/workcation-logo-indigo-600.svg" alt=""
                            class="h-12 w-auto dark:hidden" />
                        <img src="/plus-assets/img/logos/workcation-logo-indigo-500.svg" alt=""
                            class="h-12 w-auto not-dark:hidden" />
                        <figure class="">
                            <blockquote class="text-lg/8 font-semibold">
                                <p>“We recently engaged Yada Ekidanta to help us with a complex IT project and were blown away by their level of service and expertise. The team was able to quickly understand our needs and provide innovative solutions that exceeded our expectations. They were always available to answer our questions and provide guidance, and they went above and beyond to ensure the project was delivered on time and within budget.”</p>
                            </blockquote>
                            <figcaption class="mt-10 flex gap-x-6">
                                <img src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=96&h=96&q=80"
                                    alt="" class="size-12 flex-none rounded-full bg-gray-50 dark:bg-gray-800" />
                                <div>
                                    <div class="text-base font-semibold">H. Nasution
                                    </div>
                                    <div class="text-sm/6 text-gray-600 dark:text-gray-400">CEO of Finance Director of PT Perkebunan Sumatera Utara</div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 sm:py-5">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl divide-y divide-gray-100 lg:mx-0 lg:max-w-none dark:divide-white/10">
                    <div class="grid grid-cols-1 gap-10 py-16 lg:grid-cols-3">
                        <div>
                            <h2 class="text-4xl font-semibold tracking-tight text-pretty">
                                Get in touch</h2>
                            <p class="mt-4 text-base/7 text-gray-600 dark:text-gray-400">Have a project in mind or want to explore opportunities with us? Get in touch with our team and we’ll be happy to guide you in the right direction.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                            <div class="rounded-2xl bg-gray-50 p-10 dark:bg-black">
                                <h3 class="text-base/7 font-semibold dark:text-white">Collaborate</h3>
                                <dl class="mt-3 space-y-1 text-sm/6 text-gray-600 dark:text-gray-400">
                                    <div>
                                        <dt class="sr-only">Email</dt>
                                        <dd><a href="mailto:collaborate@yex.co.id"
                                                class="font-semibold text-indigo-600 dark:text-indigo-400">collaborate@yex.co.id</a>
                                        </dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Phone number</dt>
                                        <dd>+62 817 321 025</dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-10 dark:bg-black">
                                <h3 class="text-base/7 font-semibold">Press</h3>
                                <dl class="mt-3 space-y-1 text-sm/6 text-gray-600 dark:text-gray-400">
                                    <div>
                                        <dt class="sr-only">Email</dt>
                                        <dd><a href="mailto:press@yex.co.id"
                                                class="font-semibold text-indigo-600 dark:text-indigo-400">press@yex.co.id</a>
                                        </dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Phone number</dt>
                                        <dd>+62 817 321 025</dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-10 dark:bg-black">
                                <h3 class="text-base/7 font-semibold">Join our team</h3>
                                <dl class="mt-3 space-y-1 text-sm/6 text-gray-600 dark:text-gray-400">
                                    <div>
                                        <dt class="sr-only">Email</dt>
                                        <dd><a href="mailto:careers@yex.co.id"
                                                class="font-semibold text-indigo-600 dark:text-indigo-400">careers@yex.co.id</a>
                                        </dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Phone number</dt>
                                        <dd>+62 817 321 025</dd>
                                    </div>
                                </dl>
                            </div>
                            <div class="rounded-2xl bg-gray-50 p-10 dark:bg-black">
                                <h3 class="text-base/7 font-semibold">Say hello</h3>
                                <dl class="mt-3 space-y-1 text-sm/6 text-gray-600 dark:text-gray-400">
                                    <div>
                                        <dt class="sr-only">Email</dt>
                                        <dd><a href="mailto:hello@yex.co.id"
                                                class="font-semibold text-indigo-600 dark:text-indigo-400">hello@yex.co.id</a>
                                        </dd>
                                    </div>
                                    <div class="mt-1">
                                        <dt class="sr-only">Phone number</dt>
                                        <dd>+62 817 321 025</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5 sm:py-5">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-4xl font-semibold tracking-tight text-pretty sm:text-5xl">
                        Our
                        offices</h2>
                    <p class="mt-6 text-lg/8 text-gray-600 dark:text-gray-400">
                        Our offices serve as collaborative hubs where ideas are transformed into impactful digital solutions, supporting seamless coordination and service delivery.</p>
                </div>
                <div
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base/7 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <h3 class="border-l border-indigo-600 pl-6 font-semibold dark:border-indigo-500">
                            HEADQUARTER
                        </h3>
                        <address
                            class="border-l border-gray-200 pt-2 pl-6 text-gray-600 not-italic dark:border-white/10 dark:text-gray-400">
                            <p>Jl. Pangeran Tubagus Angke No.24B</p>
                            <p>Jakarta Barat, D.K.I Jakarta 11460</p>
                        </address>
                    </div>
                    <div>
                        <h3 class="border-l border-indigo-600 pl-6 font-semibold dark:border-indigo-500">
                            TECH CENTER
                        </h3>
                        <address
                            class="border-l border-gray-200 pt-2 pl-6 text-gray-600 not-italic dark:border-white/10 dark:text-gray-400">
                            <p>Komplek Permata Buah Batu Blok C 15B</p>
                            <p>Bandung, Jawa Barat 40287</p>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endvolt
</x-layouts.web>