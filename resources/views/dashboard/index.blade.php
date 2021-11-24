@extends('layouts.main')

@section('content')

    <main class="mx-auto container lg:px-5 grid md:grid-cols-2 gap-5 mt-5">

        <section class="bg-white rounded-md shadow p-2">

            <div class="flex justify-between mb-2">
                <h3 class="text-purple-700 text-xl font-semibold tracking-wider mb-2 text-center">
                    Job application on the last week!
                </h3>

                <a href="{{ route('myApplications') }}" class="font-semibold text-purple-600 hover:text-purple-700">View all</a>
            </div>

            <div id="applicationChart" class="h-72"></div>

        </section>

        <section class="bg-white rounded-md shadow p-2">

            <div class="flex justify-between mb-2">
                <h3 class="text-purple-700 text-xl font-semibold tracking-wider text-center mb-2">Job invitations</h3>

                <a href="{{ route('invite.index') }}" class="font-semibold text-purple-600 hover:text-purple-700">View all</a>
            </div>

            <div id="invitationChart" class="h-72"></div>

        </section>

        <section class="rounded-md col-span-2 flex flex-col gap-2">
            @forelse ($application as $job)

                <x-job-card :job="$job" />

            @empty
                <div>
                    You haven't applied to any job yet!
                </div>
            @endforelse

            @if (count($application) > 0)

                <div class="flex justify-betweetn align-middle">
                    <a href="{{ route('myApplications') }}">View all</a>
                </div>

            @endif
        </section>

    </main>

@endsection

@section('script')

    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <script>
        const chart = new Chartisan({
            el: '#applicationChart',
            url: "@chart('application_chart')",
            hooks: new ChartisanHooks()
                .colors()
                .beginAtZero()
        });

        const invitationChart = new Chartisan({
            el: '#invitationChart',
            url: "@chart('invite_chart')",
            hooks: new ChartisanHooks()
                .colors()
                .beginAtZero()
        });
    </script>

@endsection
