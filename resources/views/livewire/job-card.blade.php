<x-job-card :job="$job">

    <x-slot name="footer">

        <footer class="flex justify-between mt-5 items-center">

            <div>
                <a href="{{ route('company.job.application', $job->id) }}"
                    class="rounded cursor-pointer font-semibold text-purple-500 hover:text-purple-700 transition-all">
                    Applications: {{ $job->users_count }}
                </a>
            </div>

            <div id="actions" class="flex justify-end gap-2">
                <form wire:submit.prevent="tooggleStatus">
                    <x-ui.button variant="outline-danger" type="submit">
                        {{ $job->status ? 'Disable' : 'Activate' }}
                    </x-ui.button>
                </form>
                <a href="{{ route('job.edit', $job->id) }}">
                    <x-ui.button variant="outline-primary">
                        Edit
                    </x-ui.button>
                </a>
                <a href="{{ route('job.show', $job->id) }}">
                    <x-ui.button>
                        View
                    </x-ui.button>
                </a>
            </div>
        </footer>

        @if (session()->has('flash'))

            <x-flash />

        @endif

    </x-slot>

</x-job-card>
