@extends('layouts.main')

@section('content')
    <div class="container mx-auto max-w-3xl px-3">
        <h2 class="text-3xl text-purple-800 font-semibold tracking-wider my-5">Edit job!</h2>

        <main x-data="formData()">
            <form action="{{ route('job.update', $job->id) }}" method="post">

                @method('put')
                <x-job.form :job="$job" />

            </form>
        </main>
    </div>
@endsection

@section('script')
    <script>
        @if (old('required_skills') !== null)
            let requiredSkills = {!! json_encode(explode(';', old('required_skills'))) !!};
        @else
            let requiredSkills = {!! json_encode($job->required_skills) !!};
        @endif

        @if (old('optional_skills') !== null)
            let optionalSkills = {!! json_encode(explode(';', old('optional_skills'))) !!};
        @else
            let optionalSkills = {!! json_encode($job->optional_skills) !!};
        @endif
    </script>
    <script src="{{ asset('js/job-create.js') }}"></script>
@endsection
