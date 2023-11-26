<x-app-layout>
    <x-slot name="header">
        <h2 class="sm:text-3xl text-2xl mb-2 text-fourth">{{ __('Register') }}</h2>
        <x-message :message="session('message')" />
    </x-slot>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="items-center mx-auto">
        <div class="flex flex-col w-full max-w-md mx-auto mt-12 px-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Password Confirmation" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-16">
                    <button type="submit" class="w-full items-center py-4 bg-fourth hover:scale-105 text-md font-medium text-center text-white transition duration-300 ease-in-out transform shadow-md rounded-full">
                        <div class="flex items-center justify-center">
                            {{ __('Register') }}
                        </div>
                    </button>
                </div>
            </form>
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 text-third bg-first">{{ __('Or continue with') }}</span>
                </div>
            </div>
            <a href="#" class="block py-4 w-full text-center shadow-lg transition duration-200 hover:scale-105 rounded-full cursor-pointer">
                <div class="flex items-center justify-center">
                    <i class="fa-brands fa-google"></i>
                    <span class="ml-4">{{ __('Sign up with Google') }}</span>
                </div>
            </a>
            <div class="relative mt-20 mb-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 text-third bg-first">{{ __('Already registered?') }}</span>
                </div>
            </div>
            <div>
                <a href="{{ route('login' )}}" class="block py-4 w-full text-center bg-fourth text-white  transition duration-200 hover:scale-105 rounded-full cursor-pointer">
                    <span>{{ __('Login') }}</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>