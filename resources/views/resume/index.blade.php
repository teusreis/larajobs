@extends('layouts.main')

@section('content')
    <div x-data="{ modalOpen: false }">
        <main class="container mx-auto max-w-5xl px-2">

            <h2 class="mt-8 text-3xl font-bold tracking-wider text-purple-700">My Resume</h2>
            @if ($resume)

                <x-resume.resume-show :resume="$resume" />

                <div id="actions" class="flex justify-end gap-2 mb-5 text-white">

                    <button type="button" class="bg-red-500 hover:bg-red-700 transition-all px-3 py-2 font-semibold rounded"
                        x-on:click="modalOpen = true">
                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete
                    </button>

                    @can('update', $resume)
                        <a href="{{ route('resume.edit', $resume->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 transition-all px-3 py-2 font-semibold rounded">
                            <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                            Edit
                        </a>
                    @endcan
                </div>
            @else
                <div class="text-center py-5">
                    <a href="{{ route('resume.create') }}"
                        class="text-purple-600 hover:text-purple-800 transition-all text-lg font-semibold tracking-wider">
                        Create resume!
                    </a>
                </div>
            @endif

        </main>

        <x-modal header="Delete Resume">
            <div class="">
                <h2 class=" text-lg font-semibold">Are you sure that you want to delete your
                resume entirely?</h2>
            </div>
            <x-slot name="footer">
                <button class="bg-gray-500 hover:bg-gray-700 transition-all px-3 py-2 font-semibold rounded mr-2 text-white"
                    x-on:click="modalOpen = false">
                    Cancel
                </button>
                <form action="{{ route('resume.destroy', $resume->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 transition-all px-3 py-2 font-semibold rounded text-white">
                        <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete
                    </button>
                </form>
            </x-slot>
        </x-modal>
    </div>
@endsection
