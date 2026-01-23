<footer class="bg-white dark:bg-black relative isolate overflow-hidden">
    <div class="mx-auto max-w-7xl px-6 pt-16 pb-8 sm:pt-24 lg:px-8 lg:pt-32">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8">
                <a href="{{ route('web.home') }}" wire:navigate class="group inline-flex min-w-0 items-center gap-2">
                    <img src="{{ asset('icon.png') }}" alt="" class="h-8 w-auto block dark:hidden" />
                    <img src="{{ asset('icon-dark.png') }}" alt="" class="h-8 w-auto hidden dark:block" />
                    <div class="min-w-0 leading-tight">
                        <div class="text-sm font-semibold tracking-wide truncate">Yada Ekidanta</div>
                        <div class="text-[11px] dark:text-white/60 text-black/60 truncate hidden sm:block">Tech
                            Innovation Partner</div>
                    </div>
                </a>
                <p class="text-sm/6 text-balance text-gray-600 dark:text-gray-400">
                    Making the world a better place
                    through constructing elegant hierarchies.
                </p>
                <div class="flex gap-x-6">
                    <a href="https://www.facebook.com/YadaEkidanta" target="_blank"
                        class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="size-6">
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/yadaekidanta" target="_blank"
                        class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="size-6">
                            <path
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/yada-ekidanta/" target="_blank"
                        class="text-gray-800 hover:text-gray-500 dark:text-blue-700 dark:hover:text-gray-600">
                        <span class="sr-only">LinkedIn</span>
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="size-6">
                            <!-- Background -->
                            <rect x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />

                            <!-- "in" text -->
                            <path fill="#ffffff" d="
            M7.2 10.2h2.1v6.6H7.2z
            M8.25 6.8a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z

            M11.2 10.2h2v.9h.03c.28-.53.96-1.1 1.97-1.1
            2.1 0 2.5 1.38 2.5 3.17v3.63h-2.1v-3.22
            c0-.77-.01-1.76-1.07-1.76
            -1.08 0-1.25.84-1.25 1.71v3.27h-2.1z
        " />
                        </svg>
                    </a>


                </div>
            </div>
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm/6 font-semibold dark:text-white">HEADQUARTER</h3>
                        <a href="https://maps.app.goo.gl/TxpTJKfpX3HSY3KQ9" target="_blank"
                            class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                            <address>
                                Jl. Pangeran Tubagus Angke No.24B, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta
                                11460
                            </address>
                        </a>
                        <h3 class="text-sm/6 font-semibold dark:text-white mt-5">TECH CENTER</h3>
                        <a href="https://maps.app.goo.gl/RCXuLikGxU7TKKig9" target="_blank"
                            class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                            <address>
                                Komplek Permata Buah Batu Blok C 15B, Bandung, Jawa Barat 40287
                            </address>
                        </a>
                        <a href="https://wa.me/62817321025" target="_blank"
                            class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                            +62 817 321 025
                        </a>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm/6 font-semibold dark:text-white">Solutions</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('web.solutions.ai-development') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    AI Development
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.software-development') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Software Development
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.information-system') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Information System
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.cyber-security') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Cyber Security
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.cloud-solution') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Cloud Solutions
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm/6 font-semibold dark:text-white">Company</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('web.about') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.blogs') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.careers') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Career
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.works') }}" wire:navigate
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Works
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm/6 font-semibold dark:text-white">Legal</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#"
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Terms of service
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    Privacy policy
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="text-sm/6 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300">
                                    License
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24 dark:border-white/10">
            <p class="text-sm/6 text-gray-600 dark:text-gray-400">
                &copy; 2021 {{ __('Yada Ekidanta') }}. All rights reserved.
            </p>
        </div>
    </div>
    <svg viewBox="0 0 1024 1024" aria-hidden="true"
        class="absolute top-1/2 left-1/2 -z-10 size-256 -translate-x-1/2 mask-[radial-gradient(closest-side,white,transparent)]">
        <circle r="512" cx="512" cy="512" fill="url(#8d958450-c69f-4251-94bc-4e091a323369)" fill-opacity="0.7" />
        <defs>
            <radialGradient id="8d958450-c69f-4251-94bc-4e091a323369">
                <stop stop-color="#7775D6" />
                <stop offset="1" stop-color="#191970" />
            </radialGradient>
        </defs>
    </svg>
</footer>
