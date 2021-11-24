@extends('layouts.main')

@section('content')
    <div class="bg-gray-200 py-5">

        @livewire('job-search', ['search' => $search, 'location' => $location, 'salary' => $salary])

    </div>
@endsection
