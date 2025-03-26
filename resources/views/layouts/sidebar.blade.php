<nav x-data="{ open: false }" class="w-auto h-full w-2xl bg-gray-200 border-r-2 border-gray-400">
    <!-- Primary Navigation Menu -->
    <div class="flex-column justify-start">
        <!-- Navigation Links -->
        @php
            $user = Auth::user();

            // Create array of button with details
            $buttonRoutes = array(
                'dashboard' => array('name' => 'Dashboard', 'route' => 'dashboard'),
                'apprentice_progress' => array('name' => 'Your Progress', 'route' => 'apprentice-progress'),
                'your_hours' => array('name' => 'Your Hours', 'route' => 'apprentice-hours'),
                'apprenticeship' => array('name' => 'Apprenticeship', 'route' => 'apprenticeship'),
                'learner_progress' => array('name' => 'Apprentice progress', 'route' => 'learners-progress'),
                'view_learners' => array('name' => 'Apprentices', 'route' => 'learners.index'),
                'archive_learners' => array('name' => 'Archive Apprentices', 'route' => 'learners.archived'),
                'view_accounts' => array('name' => 'View accounts', 'route' => 'accounts.index'),
                'edit_account_details' => array('name' => 'Edit account details', 'route' => 'accounts.show'),
                'view_tutors' => array('name' => 'Tutors', 'route' => 'tutors.index'),
            );

            // Create selected buttons to display
            $apprenticeButtons = array(
                'dashboard',
                'apprentice_progress',
                'your_hours',
                'apprenticeship'
            );

            $tutorButtons = array(
                'dashboard',
                'view_learners',
                'learner_progress',
                'archive_learners',
                'apprenticeship'
            );

            $adminButtons = array(
                'dashboard',
                'view_accounts',
                'edit_account_details',
                'view_learners',
                'archive_learners',
                'view_tutors'
            );

            $employerButtons = array(
                'dashboard',
                'view_learners',
                'learner_progress',
                'apprenticeship',
                'archive_learners'
            );

            // Assign buttons to each role
            $roleButtons = array(
                'apprentice' => $apprenticeButtons,
                'tutor' => $tutorButtons,
                'admin' => $adminButtons,
                'employer' => $employerButtons,
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
