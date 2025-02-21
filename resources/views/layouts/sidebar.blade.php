<nav x-data="{ open: false }" class="w-auto h-full w-2xl bg-gray-200 border-r-2 border-gray-400">
    <!-- Primary Navigation Menu -->
    <div class="flex-column justify-start">
        <!-- Navigation Links -->
        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard2')">
                {{ __('Example 1') }}
            </x-nav-link>
        </div>
        
        <div class="hidden sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard2')">
                {{ __('Example 12') }}
            </x-nav-link>
        </div>

        <div class="hidden sm:flex">
            <x-nav-link :href="route('learners.index')" :active="request()->routeIs('learners.index')">
                {{ __('Learners') }}
            </x-nav-link>

        </div>
    </div>
</nav>
