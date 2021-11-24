@extends('layouts.main')

@section('content')
    <div x-data="{ modalOpen: false }">
        <main class="container mx-auto max-w-5xl px-2">
            <h2 class="mt-8 text-3xl font-bold tracking-wider text-purple-700">{{ $resume->user->name }}</h2>

            <x-resume.resume-show :resume="$resume" />

            <footer class="w-full p-2 bg-white rounded flex justify-end items-center mb-3">
                <button type="button" x-on:click="modalOpen = true"
                    class="bg-purple-600 hover:bg-purple-800 rounded text-white font-semibold transition-all px-3 py-2">
                    Invite
                </button>
            </footer>
        </main>

        <x-modal header="Invite!" x-cloak x-show="modalOpen">
            <form action="{{ route('invite.create') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $resume->user->id }}">

                <x-form.form-group>
                    <label for="job" class="font-semibold mb-2">Select a job</label>
                    <x-form.select name="job" class="w-full rounded-md">
                        @forelse ($jobs as $job)
                            <option
                                value="{{ $job->id }}"
                                @if ($selectedJob == $job->id && !$job->hasInvited) selected @endif
                                @if ($job->hasInvited) disabled @endif
                            >
                                {{ $job->title }} {{ $job->hasInvited ? '(Invite sent!)' : '' }}
                            </option>
                        @empty
                            <option value="">You haven't posted any job yet!</option>
                        @endforelse
                    </x-form.select>
                </x-form.form-group>

                <x-form.form-group>
                    <label for="message" class="font-semibold">Message</label>
                    <x-form.textarea name="message" />
                </x-form.form-group>

                <div class="flex justify-end gap-4 align-middle">
                    <x-ui.button variant="secondary" x-on:click="modalOpen = false">
                        Cancel
                    </x-ui.button>
                    <x-ui.button type="submit">
                        Send invite
                    </x-ui.button>
                </div>

                <x-slot name="footer"></x-slot>
            </form>
        </x-modal>
    </div>
@endsection
