<nav class="bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <x-application-logo class="fill-current block h-9 w-auto text-gray-800" />
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            @role('Admin|Operator')
                                <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                                    {{ __('index') }}
                                </x-nav-link>
                                <x-nav-link :href="route('products.index')" :active="request()->is('products')">
                                    {{ __('Products') }}
                                </x-nav-link>
                                <x-nav-link :href="route('organizations.index')" :active="request()->is('organizations')">
                                    {{ __('Organizations') }}
                                </x-nav-link>
                                <x-nav-link :href="route('users.index')" :active="request()->is('users')">
                                    {{ __('Users') }}
                                </x-nav-link>
                                <x-nav-link :href="route('tools.index')" :active="request()->is('tools')">
                                    {{ __('Tools') }}
                                </x-nav-link>
                            @endrole
                            @role('Admin')
                                <x-nav-link :href="route('logs.index')" :active="request()->is('logs')">
                                    {{ __('Logs') }}
                                </x-nav-link>
                            @endrole
                            <!--  HIDDEN WHEN ADMIN   -->
                            @role('Servicer|Organizer')
                                <x-nav-link :href="route('products.search')" :active="request()->is('product/search')">
                                    {{ __('Product search') }}
                                </x-nav-link>
                                <x-nav-link :href="route('products.myproducts')" :active="request()->is('product/myproducts')">
                                    {{ __('My products') }}
                                </x-nav-link>
                                <x-nav-link :href="route('products.create')" :active="request()->is('products/create')">
                                    {{ __('Device commissioning') }}
                                </x-nav-link>
                            @endrole
                            @role('Organizer')
                                <x-nav-link :href="route('organizations.myorganization')" :active="request()->is('organization/myorganization')">
                                    {{ __('My myorganization') }}
                                </x-nav-link>
                            @endrole
                        @else
                            <x-nav-link :href="route('login')" :active="request()->is('login')">
                                {{ __('Login') }}
                            </x-nav-link>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    @auth
                        <button
                            class="relative rounded-full bg-primary-500 p-1 text-white hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            type="button">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">{{ __('View notifications') }}</span>
                            <x-svg.search />
                        </button>
                    @endauth
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" id="">
                        @auth
                            <div>
                                <button
                                    class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" type="button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                </button>
                            </div>

                            <!--
                                                                                                                                                Dropdown menu, show/hide based on menu state.

                                                                                                                                                Entering: "transition ease-out duration-100"
                                                                                                                                                    From: "transform opacity-0 scale-95"
                                                                                                                                                    To: "transform opacity-100 scale-100"
                                                                                                                                                Leaving: "transition ease-in duration-75"
                                                                                                                                                    From: "transform opacity-100 scale-100"
                                                                                                                                                    To: "transform opacity-0 scale-95"
                                                                                                                                                -->

                            <div class="ring-black absolute right-0 z-10 mt-2 hidden w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-opacity-5 focus:outline-none"
                                id="profile-dropdown" role="menu" aria-orientation="vertical"
                                aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a class="block px-4 py-2 text-sm text-gray-700" id="user-menu-item-0"
                                    href="{{ route('profile.edit') }}" role="menuitem" tabindex="-1" wire:navigate>
                                    {{ __('Your Profile') }}
                                </a>
                                <form method="GET" action="{{ route('logout') }}">
                                    <a class="block px-4 py-2 text-sm text-gray-700" id="user-menu-item-2"
                                        href="{{ route('logout') }}" role="menuitem" tabindex="-1" wire:navigate
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        @csrf
                                        <!-- Authentication -->
                                        {{ __('Log Out') }}

                                    </a>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    id="menu-toggle" type="button" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block h-6 w-6" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden h-6 w-6" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden bg-gray-800 md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            @auth
                @role('Servicer|Organizer')
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <x-menu-item :href="route('products.search')" :active="request()->is('product/search')">
                        {{ __('product search') }}
                    </x-menu-item>
                    <x-menu-item :href="route('products.myproducts')" :active="request()->is('product/myproducts')">
                        {{ __('my products') }}
                    </x-menu-item>
                    @role('Organizer')
                        <x-menu-item :href="route('organizations.myorganization')" :active="request()->is('organization/myorganization')">
                            {{ __('my myorganization') }}
                        </x-menu-item>
                    @endrole
                @endrole
            @else
                <x-menu-item :href="route('login')" :active="request()->is('login')">
                    {{ __('login') }}
                </x-menu-item>
            @endauth
        </div>
        @auth
            <div class="border-t border-gray-700 pb-3 pt-4">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                    <button
                        class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        type="button">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <x-svg.search />
                    </button>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        href="{{ route('profile.edit') }}" wire:navigate>
                        {{ __('Your Profile') }}
                    </a>
                    <form method="GET" action="{{ route('logout') }}">
                        <a class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            id="user-menu-item-2" href="{{ route('logout') }}" role="menuitem" tabindex="-1" wire:navigate
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            @csrf
                            <!-- Authentication -->
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
