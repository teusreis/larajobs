<?php

namespace App\Http\Controllers;

use App\Models\Job;

class ApplicationController extends Controller
{
    public function index(Job $job)
    {
        return view('application.index', [
            'job' => $job,
            'users' => $job->users()->with('resume')->paginate(10),
        ]);
    }

    public function myApplications()
    {
        return view('application.userJobs', [
            "resume" => auth()->user()->resume,
            "jobs" => auth()->user()->application()->latest()->paginate(10),
        ]);
    }
}
