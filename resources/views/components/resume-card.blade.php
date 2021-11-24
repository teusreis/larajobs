<div class="my-5">
    <h3 class="text-2xl font-semibold">{{ $resume->title }}</h3>

    <p>{{ $resume->description }}</p>

    <div class="mt-7">
        <a href="{{ route('resume.show', ['resume' => $resume->id, 'selectedJob' => $selectedJob]) }}"
            class="border px-4 py-2 rounded-md text-purple-700  border-purple-700 hover:text-white hover:bg-purple-700 transition-all font-semibold ">
            Read More
        </a>
    </div>
</div>
