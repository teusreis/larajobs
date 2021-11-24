<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company.user:id,name')
            ->orderBy('salary', 'desc')
            ->latest()
            ->limit(10)
            ->get();

        return view('index', compact('jobs'));
    }
}
