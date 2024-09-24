<nav class="sticky top-0 z-10">
    <div class="bg-gray-800 border-gray-200 dark:bg-gray-900 sticky top-0 z-10">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <x-application-mark class="block h-9 w-auto" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Mysoftcare</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- Dropdown menu -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
    <div class="bg-white shadow dark:bg-gray-700">
        <div class="max-w-screen-xl p-4 mx-auto">
            <div class="flex items-center">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse">
                    <li>
                        <x-mysoftcare.navigations.navbar-sublink href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Utama</x-mysoftcare.navigations.navbar-sublink>
                    </li>
                    @php
                    if (Auth::user()->hasRole('admin')) {
                    $links = [
                    ['name' => 'Senarai Projek', 'route' => 'admin.project.index'],
                    ['name' => 'Senarai Agensi', 'route' => 'admin.agency.index'],
                    ['name' => 'Senarai PIC', 'route' => 'admin.agency.pic.index'],
                    ];

                    } else {
                    $links = [
                    ['name' => 'Utama', 'route' => 'dashboard']
                    ];

                    }
                    @endphp
                    @role('admin')
                    <x-mysoftcare.navigations.navbar-dropdown :active="request()->routeIs('admin.project.index')">

                        <x-slot:name>
                            Pengurusan Projek
                        </x-slot:name>
                        @foreach ($links as $link)
                        <li>
                            <x-mysoftcare.navigations.dropdown-link href="{{ route( $link['route'] ) }}">
                                {{ $link['name'] }}
                            </x-mysoftcare.navigations.dropdown-link>
                        </li>
                        @endforeach
                    </x-mysoftcare.navigations.navbar-dropdown>
                    @endrole
                </ul>
            </div>
        </div>
    </div>
</nav>
