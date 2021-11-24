@extends('layouts.main')

@section('content')

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block">Name</label>

                <x-form.input id="name"  type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block">E-mail</label>

                <x-form.input id="email"  type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block">Password</label>

                <x-form.input id="password"  type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block">Confirm Password</label>

                <x-form.input id="password_confirmation"  type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}x'
                </a>

                <x-ui.button class="ml-4" type="submit" variant="danger">
                    Register
                </x-ui.button>
            </div>
        </form>
    </x-auth-card>

@endsection
