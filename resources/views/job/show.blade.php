@extends('layouts.main')

@section('content')
    <div class="container mx-auto">

        <main class="my-5 max-w-4xl mx-auto flex flex-col gap-5 px-2">

            <x-job.job-section class="">
                <h2 class="text-3xl font-semibold text-gray-900 tracking-wide">{{ $job->title }}</h2>
                <div class="mt-3">
                    {{ $job->salaryString }}
                </div>
                <div>
                    Location: {{ $job->location }}
                </div>
                <div>
                    Published at {{ $job->created_at }}
                </div>
            </x-job.job-section>

            <x-job.job-section>
                <h2 class="text-xl font-semibold text-gray-900 tracking-wide mb-2">Description</h2>

                <p>
                    {{ $job->description }}
                </p>
            </x-job.job-section>

            <x-job.job-section>
                <h3 class="text-xl mb-3 font-semibold">Required Skills</h3>

                <ul class="flex gap-3">
                    @foreach ($job->required_skills as $skill)
                        <li class="p-2 text-white bg-purple-400 hover:bg-purple-600 transition rounded-lg">
                            {{ $skill }}
                        </li>
                    @endforeach
                </ul>
            </x-job.job-section>

            <x-job.job-section>
                <h3 class="text-xl my-3 font-semibold">Optional Skills</h3>

                <ul class="flex gap-3">
                    @foreach ($job->optional_skills as $skill)
                        <li class="p-2 text-white bg-purple-400 hover:bg-purple-600 transition rounded-lg">
                            {{ $skill }}
                        </li>
                    @endforeach
                </ul>
            </x-job.job-section>

            <div class="mt-3 mb-5 flex justify-end gap-2">


                @guest

                    <a href="{{ route('login') }}">
                        <x-ui.button type="button">
                            Sign in to apply!
                        </x-ui.button>
                    </a>

                @else

                    @if (auth()->user()->isCompany)

                        @can('update', $job)

                            <form action="{{ route('job.toggle', $job->id) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <x-ui.button variant="outline-danger" type="submit">
                                    {{ $job->status ? 'Disable job' : 'Activate job' }}
                                </x-ui.button>
                            </form>

                            <a href="{{ route('job.edit', $job->id) }}">
                                <x-ui.button type="button">
                                    Edit it
                                </x-ui.button>
                            </a>

                        @endcan

                    @else

                        @if (!auth()->user()->hasApplied($job->id))
                            <form action="{{ route('job.apply', $job->id) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="bg-purple-500 text-white font-semibold px-3 py-2 rounded hover:bg-purple-700 transition-all">
                                    Apply
                                </button>
                            </form>
                        @else
                            <button
                                class="bg-gray-400 text-white font-semibold px-3 py-2 rounded hover:bg-gray-500 transition-all">Application
                                sent</button>
                        @endif

                    @endif

                @endguest

            </div>

            {{-- Posible section to add later... --}}

            {{-- <h2>About the company</h2>

            <h3>Company name</h3>

            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloribus quaerat nihil quasi ipsa sequi dolorem deleniti minus, iste quod officia enim. Qui obcaecati consequatur, neque unde ea facere tempora placeat, debitis, totam sequi animi sapiente quos possimus. Placeat possimus veritatis at fugit voluptatum vel, perspiciatis optio quod repellendus? At, iure?
            </p> --}}

        </main>
    </div>
@endsection
