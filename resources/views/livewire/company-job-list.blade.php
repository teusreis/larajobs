<main class="grid md:grid-cols-12 gap-8 ">

    <div class="md:col-span-4 relative">

        <div class="bg-white px-3 py-2 rounded-lg flex flex-col gap-2">

            <div class="">
                <label for=" search" class="font-semibold">Jobs</label>
                <input wire:model.defer="search" type="text" name="search" id="search" class="w-full rounded">
            </div>

            <div class="">
                <label for=" location" class="font-semibold">Location</label>
                <input type="text" wire:model.defer="location" id="location" class="w-full rounded">
            </div>

            <div>
                <input type="checkbox" name="isRemote" id="isRemote" wire:model.defer="isRemote" class="rounded">
                <label for="isRemote">Remote</label>
            </div>

            <div class="">
                <label for=" salary" class="font-semibold">Salary</label>
                <select wire:model.defer="salary" id="salary" class="w-full rounded">
                    <option value="">Indifferent</option>
                    <option value="0">0 to $1.000,00</option>
                    <option value="1">$1.000,00 to $2.000,00</option>
                    <option value="2">$2.000,01 to $3.000,00</option>
                    <option value="3">$3.000,01 to $5.000,00</option>
                    <option value="4">$5.000,01 to $10.000,00</option>
                    <option value="5">$10.000,00 or above!</option>
                </select>
            </div>

            <div class="mt-2">
                <button wire:click="filterJobs"
                    class="py-2 w-full bg-purple-600 hover:bg-purple-800 transition-all text-white rounded font-semibold tracking-wider">
                    Filter
                </button>
            </div>
        </div>

    </div>

    <div class="md:col-span-8">
        @forelse ($jobs as $job)

            @livewire('job-card', ['job' => $job], key($job->id))

        @empty
            <div>
                Ops! You do not have any job yet!
            </div>
        @endforelse

        <footer class="text-center">
            {{ $jobs->links() }}
        </footer>

        <script>
            const paginationLink = document.querySelectorAll('#job-search-pagination-container span');
            paginationLink.forEach(p => {
                p.addEventListener('click', scrollToTop);
            })

            function scrollToTop() {
                scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        </script>
    </div>

</main>
