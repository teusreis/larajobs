@extends('layouts.main')

@section('content')
    <div class="container mx-auto max-w-6xl py-5 px-2">

        <header class="mb-4">
            <h2 class="text-3xl text-purple-600 font-semibold tracking-wider">
                Invites
            </h2>
        </header>

        <main class="grid lg:grid-cols-2 gap-5">
            @forelse ($invites as $invite)
                @php
                    $d = Carbon\Carbon::create($invite->pivot->created_at->toDateTimeString());
                    $createdAt = $d->toFormattedDateString();
                @endphp

                <div class="p-2 rounded-md shadow-md bg-white">
                    <header class=" text-purple-600">
                        <h3 class="text-2xl">
                            {{ $invite->title }}
                        </h3>

                    </header>

                    <p class="leading-6 text-gray-600 my-2">
                        {{ $invite->pivot->message }}
                    </p>

                    <footer class="flex justify-between items-center text-purple-600">

                        <p>{{ $createdAt }}</p>
                        <a href="{{ route('job.show', $invite->id) }}">Show details</a>

                    </footer>
                </div>
            @empty

                <div class="lg:col-span-2">
                    You haven't received any invite yet!
                </div>

            @endforelse

        </main>

        <footer class="py-2">
            {{ $invites->links() }}
        </footer>

    </div>

@endsection
