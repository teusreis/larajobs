@extends('layouts.main')

@section('content')
    <div class="container px-2 py-10 mx-auto">
        <header class="flex justify-between items-center mb-3 p-2">
            <h2 class="text-2xl font-semibold text-purple-700 hover:text-purple-800">My jobs</h2>

            <a href="{{ route('job.crate') }}" class="font-semibold text-purple-700 hover:text-purple-800">
                Create new Job!
            </a>
        </header>

        <main>

            @livewire('company-job-list', ['search' => $search, 'salary' => $salary, 'location' => $location])

        </main>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/company-jobs.js') }}"></script>
@endsection
