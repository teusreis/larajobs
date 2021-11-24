<x-job-card :job="$job">

    <x-slot name="footer">
        <div class="mt-3 flex">


            @auth

                @if (!auth()->user()->isCompany)

                    @if (!auth()->user()->hasApplied($job->id))
                        <form wire:submit.prevent method="post">
                            @csrf
                            <input type="hidden" value="{{ $job->id }}">
                            <button wire:click="submit( {{ $job->id }}  )"
                                class="bg-purple-500 text-white font-semibold px-3 py-2 rounded hover:bg-purple-700 transition-all mr-2">
                                Apply
                            </button>
                        </form>
                    @else
                        <button
                            class="bg-gray-400 text-white font-semibold px-3 py-2 mr-2 rounded hover:bg-gray-500 transition-all">
                            Application sent
                        </button>
                    @endif

                @endif

            @endauth

            @guest
                <a href="{{ route('login') }}" class="mr-2">
                    <x-ui.button type="button">
                        Sign in to apply
                    </x-ui.butt>
                </a>
            @endguest



            <a href="{{ route('job.show', $job->id) }}"
                class="bg-gray-400 text-white font-semibold px-3 py-2 rounded hover:bg-gray-500 transition-all">
                Read More
            </a>
        </div>
    </x-slot>

</x-job-card>
