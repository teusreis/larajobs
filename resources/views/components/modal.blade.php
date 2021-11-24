<div x-cloak class="h-screen bg-black bg-opacity-50 fixed inset-0 px-2 md:px-auto" x-show="modalOpen">
    <div class="mt-10 bg-white relative mx-auto max-w-xl p-3 rounded-lg"
        x-on:click.away="modalOpen = false"
        x-show="modalOpen"
        x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="-translate-y-10 transform"
        x-transition:enter-end="-translate-y-0 transform"
        >
        <header id="modal-header" class="border-b mb-4 pb-1">
            <h3 class="text-purple-800 text-2xl font-semibold tracking-wider">{{ $header ?? 'Modal' }}</h3>
        </header>

        <div class="my-7">
            {{ $slot }}
        </div>

        <footer id="modal-footer" class="flex justify-end gap-4">
            @isset ($footer)
                {{ $footer }}
            @else
                <button x-on:click="modalOpen = false" class="px-3 py-2 bg-gray-600 hover:bg-gray-700 transition-all rounded font-semibold text-white">
                    Close
                </button>
            @endisset
        </footer>
    </div>
</div>
