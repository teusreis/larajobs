@extends('layouts.main')

@section('content')
    <div class="container px-2 py-10 mx-auto max-w-6xl">

        <h2 class="mb-5 text-3xl font-bold tracking-wider text-purple-700">My Applications</h2>

        <header>
            <x-resume-card :resume="$resume" />
        </header>

        <main class="container mx-auto">
            @forelse ($jobs as $job)
                <x-job-card :job="$job">

                    <x-slot name="footer">
                        <div class="my-2">
                            <a href="{{ route("job.show", $job->id) }}"
                                class="text-purple-700 hover:text-purple-900 transition-all font-semibold">
                                Read more
                            </a>
                        </div>
                    </x-slot>
                </x-job-card>
            @empty
                <div>
                    <h3 class="text-lg">You haven't applied to any job yet!</h3>
                </div>
            @endforelse

            <div>
                {{ $jobs->links() }}
            </div>
        </main>

    </div>
@endsection
