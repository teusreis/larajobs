@extends('layouts.main')

@section('content')

    <x-auth-card class="mt-5" subClass="md:max-w-2xl">

        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        <form action="{{ route('company.store') }}" method="post" class="grid md:grid-cols-2 gap-4">
            @csrf

            <div>
                <label for="name">Name</label>
                <x-form.input type="text" name="name" id="name" value="{{ old('name') }}" />
                @error('name')
                    {{ $message }}
                @enderror
            </div>

            <div>
                <label for="email">E-mail</label>
                <x-form.input type="text" name="email" id="email" value="{{ old('email') }}" />
                @error('email')
                    {{ $message }}
                @enderror
            </div>

            <div class=" col-span-2">
                <label for="description">Description</label>
                <x-form.textarea name="description" id="description">{{ old('description') }}
                </x-form.textarea>
                @error('description')
                    {{ $message }}
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <x-form.input type="password" name="password" id="password" value="" />
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirm password</label>
                <x-form.input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full rounded border" value="" />
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </div>

            <div>
                <label for="number_of_employees">Number of employees</label>
                <x-form.select name="number_of_employees" id="number_of_employees">
                    <option value="0">0 - 10 employees</option>
                    <option value="1">10 - 20 employees</option>
                    <option value="3">20 - 50 employees</option>
                    <option value="4">50 - 100 employees</option>
                    <option value="5">101 or more employees</option>
                </x-form.select>
                @error('number_of_employees')
                    {{ $message }}
                @enderror
            </div>

            <div class="col-span-2">
                <x-ui.button type="submit">
                    Submit
                </x-ui.button>
            </div>

        </form>

    </x-auth-card>
@endsection
