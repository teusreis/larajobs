<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function jobs(Request $request)
    {
        return view('company.jobs', [
            'search' => $request->search ?? '',
            'salary' => $request->salary ?? '',
            'location' => $request->location ?? ''
        ]);
    }
}
