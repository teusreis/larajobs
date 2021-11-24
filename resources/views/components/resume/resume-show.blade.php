<div class="py-5 flex flex-col rounded border-b border-gray-500 my-5 w-full">

    <section class="mb-2 bg-white rounded-lg p-4 shadow-sm">

        <h2 class="font-bold tracking-wider mb-4 text-2xl">{{ $resume->title }}</h2>
        <p class="mb-2">
            {{ $resume->description }}
        </p>

        <h3 class="text-lg font-semibold mb-2">Skills</h3>
        <ul class="mb-2">
            @foreach (explode(';', $resume->skills) as $skill)
                <li
                    class="inline-block px-3 py-2 mb-2 bg-purple-500 hover:bg-purple-600 transition-all rounded text-white font-semibold">
                    {{ $skill }}
                </li>
            @endforeach
        </ul>

    </section>


    <section class="my-2 bg-white rounded-lg p-4 shadow-sm">
        @isset($resume->experience)

            <h3 class="text-lg font-semibold mb-3 border-b">Experience</h3>

            @foreach ($resume->experience as $ex)

                <div class="mb-5">
                    <h4 class="mb-2 font-semibold">{{ $ex->company_name }}</h4>

                    <span>{{ $ex->period }}</span>

                    <p>
                        {{ $ex->description }}
                    </p>
                </div>

            @endforeach

        @endisset
    </section>

    <section class="my-2 bg-white rounded-lg p-4 shadow-sm grid md:grid-cols-2">
        <h3 class="text-lg font-semibold mb-3 border-b col-span-2">Education info</h3>

        @forelse ($resume->education as $education)

            <div class="mb-5">
                <h4 class="mb-2 font-semibold">{{ $education->course_name }}</h4>

                <p>{{ ucfirst($education->level) }}, at {{ $education->institution_name }}</p>

                @if ($education->stillCoursing)
                    Since {{ $education->start_date }}
                @else
                    {{ $education->start_date }} until {{ $education->end_date }}
                @endif
                <p></p>
            </div>

        @empty
            <div>
                No education info added!
            </div>
        @endforelse
    </section>


    <div class="text-right mb-2">
        Created at {{ $resume->created_at }}
    </div>

</div>
