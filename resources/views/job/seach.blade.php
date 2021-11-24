@extends('layouts.main')

@section('content')
    <div class="bg-gray-200 py-5">

        <div class="container mx-auto mt-5 grid md:grid-cols-12 gap-8 lg:px-5 min-h-screen">

            <section id="filters" class="md:col-span-4 bg-white rounded-lg px-3 py-2">

                <div class="mb-2">
                    <label for="search" class="font-semibold">Jobs</label>
                    <input type="text" name="search" id="search" value="{{ $search ?? '' }}" class="w-full rounded">
                </div>
            </section>

            <section id="jobs" class="md:col-span-8">

                @forelse ($jobs as $job)

                    <div class="mb-3 p-5 bg-white rounded-lg">
                        <h2 class="text-2xl">{{ $job->title }}</h2>
                        <div class="mt-3">
                            {{ $job->salaryString }}
                        </div>
                        <div class="">
                            Location: São Paulo
                        </div>
                        <div class="">
                            Published at {{ $job->created_at }}
                        </div>
                        <div class="mt-2">
                            {{ $job->description }}
                        </div>

                        <div class="mt-3 flex">

                            @if (!auth()->user()->hasApplied($job->id))
                                <form action="{{ route('job.apply', $job->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="bg-purple-500 text-white font-semibold px-3 py-2 rounded hover:bg-purple-700 transition-all mr-2">
                                        Apply
                                    </button>
                                </form>
                            @else
                                <button class="bg-gray-400 text-white font-semibold px-3 py-2 mr-2 rounded hover:bg-gray-500 transition-all">Application sent</button>
                            @endif

                            <a href="{{ route('job.show', $job->id) }}" class="bg-gray-400 text-white font-semibold px-3 py-2 rounded hover:bg-gray-500 transition-all">
                                Read More
                            </a>
                        </div>
                    </div>

                @empty
                    <div class="text-left">
                        <h2 class="text-3xl">
                            Opssss! No job found!
                        </h2>
                    </div>
                @endforelse

            </section>
        </div>

    </div>
@endsection
