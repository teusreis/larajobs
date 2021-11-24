<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Resume;
use App\Http\Requests\StoreJobRequest;

class JobController extends Controller
{
    public function index()
    {
        return view('job.index', [
            'search' => request('search') ?? '',
            'location' => request('location') ?? '',
            'salary' => request('salary') ?? ''
        ]);
    }

    public function show(Job $job)
    {
        return view('job.show', compact('job'));
    }

    public function create()
    {
        return view('job.create');
    }

    public function store(StoreJobRequest $request)
    {
        $data = $request->all();

        if (isset($data['isRemote']) && $data['isRemote'] === 'on') {
            $data['isRemote'] = true;
        } else {
            $data['isRemote'] = false;
        }

        $job = auth()->user()
            ->company
            ->jobs()
            ->create($data);

        return redirect()->route('home');
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('job.edit', compact('job'));
    }

    public function update(StoreJobRequest $request, Job $job)
    {
        $this->authorize('update', $job);

        $data = $request->validated();

        if (isset($data['isRemote']) && $data['isRemote'] === 'on') {
            $data['isRemote'] = true;
        } else {
            $data['isRemote'] = false;
        }

        $data = collect($data)->union($job);

        $job->update($data->all());

        return redirect()
            ->route('job.show', $job->id)
            ->with('flash', 'Job updated successfully!');
    }

    public function toggle(Job $job)
    {
        $this->authorize('update', $job);

        $newStatus = !$job->status;

        $job->update([
            'status' => $newStatus
        ]);

        $message = $newStatus
            ? 'Job activated successfully!'
            : 'Job disabled successfully!';

        return redirect()
            ->route('job.show', ['job' => $job->id])
            ->with('flash', $message);
    }
}
