<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Title -->
        <div class="mb-8">
            <h1 class="text-2xl">Login</h1>
            <hr class="my-2 h-0.5 border-t-0 bg-gray-400" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="username" :value="__('Username')" />

            <x-text-input id="username" class="block mt-1 w-full"
                    type="text"
                    name="username"
                    :value="old('username')"
                    required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center mb-6">
                <input id="remember_me" class="rounded border-2 border-gray-400 text-sky-400 focus:ring-sky-400"
                        type="checkbox"
                        name="remember">
                        
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-neutral-600 hover:text-sky-400 focus:text-sky-300" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
