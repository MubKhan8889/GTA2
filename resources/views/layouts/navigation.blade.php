<nav x-data="{ open: false }" class="fixed h-full w-2xl bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="flex-column justify-start">
        <!-- Navigation Links -->
        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>
        
        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>
    </div>
</nav>
