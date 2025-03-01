<nav x-data="{ open: false }" class="w-auto h-full w-2xl bg-gray-200 border-r-2 border-gray-400">
    <!-- Primary Navigation Menu -->
    <div class="flex-column justify-start">
        <!-- Navigation Links -->
        @php
            $user = Auth::user();

            // Create array of button with details
            $buttonRoutes = array(
                'dashboard' => array('name' => 'Dashboard', 'route' => 'dashboard'),
                'view_duties_rag' => array('name' => 'View duties RAG', 'route' => 'duties'),
                'view_hours' => array('name' => 'View hours', 'route' => 'hours'),
                'view_apprenticeship' => array('name' => 'View apprenticeship', 'route' => 'apprenticeship'),
                'learner_progress' => array('name' => 'Apprentice progress', 'route' => 'learners_progress'),
                'view_learners' => array('name' => 'Edit apprentice info', 'route' => 'learners.index'),
                'archive_learners' => array('name' => 'Archive apprentices', 'route' => 'learners_archive'),
                'view_accounts' => array('name' => 'View accounts', 'route' => 'accounts.index'),
                'edit_account_details' => array('name' => 'Edit account details', 'route' => 'accounts.show')
            );

            // Create selected buttons to display
            $apprenticeButtons = array(
                'dashboard',
                'view_duties_rag',
                'view_hours',
                'view_apprenticeship'
            );

            $tutorButtons = array(
                'dashboard',
                'view_learners',
                'learner_progress',
                'archive_learners'
            );

            $adminButtons = array(
                'dashboard',
                'view_accounts',
                'edit_account_details',
                'view_learners',
                'archive_learners'
            );

            // Assign buttons to each role
            $roleButtons = array(
                'apprentice' => $apprenticeButtons,
                'tutor' => $tutorButtons,
                'admin' => $adminButtons
            );
        @endphp

        @foreach ($roleButtons[$user->role] as $button)
            @php
                // Check if route exists, otherwise route it back to dashboard
                $route = Route::has($buttonRoutes[$button]['route']) ? $buttonRoutes[$button]['route'] : 'dashboard';
            @endphp

            <div class="hidden sm:flex">
                <x-nav-link :href="route($route)" :active="request()->routeIs($buttonRoutes[$button]['route'])">
                    {{ __($buttonRoutes[$button]['name']) }}
                </x-nav-link>
            </div>
        @endforeach
    </div>
</nav>
