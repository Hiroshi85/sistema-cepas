@php
    $navigation = [
        'Dashboard' => [
            'route' => 'rrhh.dashboard',
            'dropdown' => false,
            'permissions' => [],
        ],
        'Personal' => [
            'items' => [
                'Empleados' => [
                    'route' => 'empleados.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar empleados'],
                    'parent' => 'personal',
                ],
                'Contratos' => [
                    'route' => 'contratos.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar contratos'],
                    'parent' => 'personal',
                ],
                'Puestos' => [
                    'route' => 'puestos.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar puestos'],
                    'parent' => 'personal',
                ],
                'Equipos' => [
                    'route' => 'equipos.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar equipos'],
                    'parent' => 'personal',
                ],
            ],
            'dropdown' => true,
            'permissions' => ['gestionar empleados', 'gestionar contratos', 'gestionar puestos', 'gestionar equipos'],
            'name' => 'personal',
        ],
        'Reclutamiento' => [
            'items' => [
                'Candidatos' => [
                    'route' => 'candidatos.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar candidatos'],
                    'parent' => 'reclutamiento',
                ],
                'Plazas' => [
                    'route' => 'plazas.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar plazas'],
                    'parent' => 'reclutamiento',
                ],
                'Postulaciones' => [
                    'route' => 'postulaciones.index',
                    'dropdown' => false,
                    'permissions' => ['ver postulaciones'],
                    'parent' => 'reclutamiento',
                ],
                'Evaluaciones' => [
                    'route' => 'rrhh.evaluaciones.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar evaluaciones'],
                    'parent' => 'reclutamiento',
                ],
                'Entrevistas' => [
                    'route' => 'rrhh.entrevistas.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar entrevistas'],
                    'parent' => 'reclutamiento',
                ],
                'Ofertas' => [
                    'route' => 'ofertas.index',
                    'dropdown' => false,
                    'permissions' => ['gestionar ofertas'],
                    'parent' => 'reclutamiento',
                ],
            ],
    
            'dropdown' => true,
            'permissions' => [],
            'name' => 'reclutamiento',
        ],
        'Horarios' => [
            'route' => 'horarios.index',
            'dropdown' => false,
            'permissions' => [],
        ],
        'Nóminas' => [
            'route' => 'nominas.index',
            'dropdown' => false,
            'permissions' => [],
        ],
    ];
    function getBaseRoute($route)
    {
        $elements = explode('.', $route);
        array_pop($elements);
        return implode('.', $elements);
    }
    
    function isDropdownActive($items)
    {
        $ruta_actual = request()
            ->route()
            ->getName();
        $ruta_base_actual = getBaseRoute($ruta_actual);
    
        foreach ($items as $item) {
            $ruta_item = $item['route'];
            $ruta_base_item = getBaseRoute($ruta_item);
    
            if (request()->routeIs($item['route']) || $ruta_base_actual == $ruta_base_item) {
                return true;
            }
        }
    
        return false;
    }
    
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo-sm class="block h-12 w-auto fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach ($navigation as $nav_key => $nav_item)
                        @if ($nav_item['dropdown'])
                            @can($nav_item['permissions'])
                                <div
                                    class="{{ isDropdownActive($nav_item['items']) ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 dark:text-white focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-300 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out' }}">

                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                <div>{{ $nav_key }}</div>

                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            @foreach ($nav_item['items'] as $link_key => $link)
                                                @can($link['permissions'])
                                                    <x-dropdown-link :href="route($link['route'])">
                                                        {{ __($link_key) }}
                                                    </x-dropdown-link>
                                                @endcan
                                            @endforeach
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            @endcan
                        @else
                            @can($nav_item['permissions'])
                                <x-nav-link :href="route($nav_item['route'])" :active="request()->routeIs($nav_item['route'])">
                                    {{ __($nav_key) }}
                                </x-nav-link>
                            @endcan
                        @endif
                    @endforeach

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-200 bg-white dark:bg-gray-900 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <button disabled
                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-200">
                            {{ Auth::user()->roles()->first()->name }}
                        </button>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        <div class="flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{-- <x-darkmode-toggle /> --}}
                            @livewire('common.theme-toggle')
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($navigation as $nav_key => $nav_item)
                @if ($nav_item['dropdown'])
                    @can($nav_item['permissions'])
                        <x-responsive-dropdown-nav-link :active="isDropdownActive($nav_item['items'])">
                            <x-slot name="title">{{ __($nav_key) }}</x-slot>
                            <x-slot name="extraItems">
                                @foreach ($nav_item['items'] as $link_key => $link)
                                    @can($link['permissions'])
                                        <x-dropdown-link :href="route($link['route'])">
                                            {{ __($link_key) }}
                                        </x-dropdown-link>
                                    @endcan
                                @endforeach
                            </x-slot>
                        </x-responsive-dropdown-nav-link>
                    @endcan
                @else
                    @can($nav_item['permissions'])
                        <x-responsive-nav-link :href="route($nav_item['route'])" :active="request()->routeIs($nav_item['route'])">
                            {{ __($nav_key) }}
                        </x-responsive-nav-link>
                    @endcan
                @endif
            @endforeach
        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
