<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $application = auth()->user()
            ->application()
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.index', compact('application'));
    }
}
