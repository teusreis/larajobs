<div {{ $attributes->merge(['class' => 'mb-3 p-5 bg-white rounded-lg shadow-lg hover:shadow-xl transition']) }}>

    <h2 class="text-2xl">{{ $job->title }}</h2>

    <div class="mt-3">
        {{ $job->salaryString }}
    </div>

    <div>
        Location: {{ $job->location }}
    </div>

    <div>
        Published at {{ $job->created_at }}
    </div>

    <div class="mt-2">
        {{ $job->description }}
    </div>

    @isset($footer)
        {{ $footer }}
    @endisset
</div>
