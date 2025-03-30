<nav x-data="{ open: false }" class="w-auto h-full w-2xl bg-gray-200 border-r-2 border-gray-400">
    <!-- Primary Navigation Menu -->
    <div class="flex-column justify-start">
        <!-- Navigation Links -->
        @php
            $user = Auth::user();

            // Create array of button with details
            $buttonRoutes = [
                'dashboard' => ['name' => 'Dashboard', 'route' => 'dashboard'],
                'apprentice_progress' => ['name' => 'Your Progress', 'route' => 'apprentice-progress'],
                'your_hours' => ['name' => 'Your Hours', 'route' => 'apprentice-hours'],
                'apprenticeship' => ['name' => 'Apprenticeship', 'route' => 'apprenticeship'],
                'learner_progress' => ['name' => 'Apprentice progress', 'route' => 'learners-progress'],
                'view_learners' => ['name' => 'Apprentices', 'route' => 'learners.index'],
                'archive_learners' => ['name' => 'Archive Apprentices', 'route' => 'learners.archived'],
                'view_accounts' => ['name' => 'View accounts', 'route' => 'accounts.index'],
                'edit_account_details' => ['name' => 'Edit account details', 'route' => 'accounts.show'],
                'view_tutors' => ['name' => 'Tutors', 'route' => 'tutors.index'],
                'post_job' => ['name' => 'Post New Job', 'route' => 'jobs.create'],
                'manage_jobs' => ['name' => 'Manage Jobs', 'route' => 'jobs.index'],
                'employer_profile' => ['name' => 'Profile', 'route' => 'employer.profile'],
                'view_employers' => ['name' => 'Employer', 'route' => 'employers.index'],
            ];

            // Create selected buttons to display
            $apprenticeButtons = array(
                'dashboard',
                'apprentice_progress',
                'your_hours',
                'apprenticeship'
            );

            $employerButtons = array(
                'view_learners',
                'learner_progress',
                'apprenticeship'
            );

            $tutorButtons = array(
                'view_learners',
                'learner_progress',
                'archive_learners',
                'apprenticeship'
            );

            $adminButtons = array(
                'view_learners',
                'archive_learners',
                'view_tutors',
                'view_employers'
            );

            $employerButtons = array(
                'post_job',
                'manage_jobs',
                'employer_profile'
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
