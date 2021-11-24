@extends('layouts.main')

@section('content')
    <header class="flex justify-center items-center">
        <form action="{{ route('job.index') }}" method="get"
            class="w-full p-5 flex flex-col md:flex-row grid-cols-4 gap-3 md:gap-0 justify-center">
            <div class="relative flex items-center">
                <x-form.input class="rounded md:rounded-r-none w-full md:w-64 pl-8" type="search" name="search" id="search"
                    placeholder="Job title" />

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-1 text-purple-400" fill="none" styles="top: calc(50% - 21px);"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="relative flex items-center">
                <x-form.input class="rounded md:rounded-r-none md:rounded-l-none w-full md:w-64 pl-8" type="text" name="location"
                    id="location" placeholder="Address or state" />

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-1 text-purple-400" styles="top: calc(50% - 21px);"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative flex items-center">
                <x-form.select class="  md:rounded-r-md md:rounded-l-none pl-8" name="salary" id="salary"
                    placeholder="Salary range">
                    <option value="0">0 to $1.000,00</option>
                    <option value="1">$1.000,00 to $2.000,00</option>
                    <option value="2">$2.000,01 to $3.000,00</option>
                    <option value="3">$3.000,01 to $5.000,00</option>
                    <option value="4">$5.000,01 to $10.000,00</option>
                    <option value="5">$10.000,00 or more!</option>
                </x-form.select>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-1 text-purple-400" styles="top: calc(50% - 21px);"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            <x-ui.button type="submit" class="md:ml-5">
                Search
            </x-ui.button>
        </form>
    </header>

    <main class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 max-w-5xl mx-auto px-2 py-4">
        @foreach ($jobs as $job)
            <div class="rounded-lg bg-white p-3 shadow-md">
                <p class="text-gray-500 text-sm">
                    {{ $job->created_at }} ( {{ $job->salaryString }} )
                </p>
                <h2 class="text-md tracking-wider font-semibold my-2">
                    {{ $job->title }}
                </h2>
                <p class="text-gray-500 text-sm">
                    {{ $job->company->user->name }}
                </p>

                <div class="mt-5">
                    <a href="{{ route('job.show', $job->id) }}">
                        <x-ui.button variant="outline-primary" type="button">
                            Read more
                        </x-ui.button>
                    </a>
                </div>
            </div>
        @endforeach
    </main>


@endsection
