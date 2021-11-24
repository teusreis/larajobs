@extends('layouts.main')

@section('content')
    <div class="container mx-auto max-w-6xl">
        <h2 class="my-8 mx-2 text-3xl font-bold tracking-wider text-purple-700">Job Applications</h2>

        <header>
            <x-job-card :job="$job" class="bg-white" />
        </header>

        <main class="grid grid-cols-1 gap-5">

            @forelse ($users as $user)
                <x-user-card :user="$user" class="">

                    <x-resume-card :resume="$user->resume" :selectedJob="$job->id" />
                </x-user-card>
            @empty
                <div class="p-2">
                    Ops. There is no application for this job!
                </div>
            @endforelse

        </main>

        <footer class="my-3 p-3 rounded-md">
            {{ $users->links() }}
        </footer>
    </div>
@endsection
