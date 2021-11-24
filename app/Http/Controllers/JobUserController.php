<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobUserController extends Controller
{
    public function store(Job $job)
    {
        auth()->user()
            ->apply($job);

        return back();
    }
}
