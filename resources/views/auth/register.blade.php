<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Sponsor Username -->
        <div>
            <x-input-label for="sponsor_username" :value="__('Sponsor Username (optional)')" />
            <x-text-input id="sponsor_username" class="block mt-1 w-full"
                          type="text" name="sponsor_username" :value="old('sponsor_username')" />
            <x-input-error :messages="$errors->get('sponsor_username')" class="mt-2" />
        </div>

        <!-- Full Name -->
        <div class="mt-4">
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" class="block mt-1 w-full"
                          type="text" name="full_name" :value="old('full_name')" required autofocus />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Country Code -->
        <div class="mt-4">
            <x-input-label for="country_code" :value="__('Country Code')" />
            <x-text-input id="country_code" class="block mt-1 w-full"
                          type="text" name="country_code" :value="old('country_code')" required />
            <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
        </div>

        <!-- Mobile -->
        <div class="mt-4">
            <x-input-label for="mobile" :value="__('Mobile')" />
            <x-text-input id="mobile" class="block mt-1 w-full"
                          type="text" name="mobile" :value="old('mobile')" required />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
