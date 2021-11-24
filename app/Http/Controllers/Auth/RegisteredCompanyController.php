<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\CompanyStoreRequest;

class RegisteredCompanyController extends Controller
{
    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'description' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'number_of_employees' => ['required']
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'isCompany' => true,
            'password' => Hash::make($request->password),
        ]));

        $user->company()->create([
            'description' => $request->description,
            'number_of_employees' => $request->number_of_employees
        ]);

        event(new Registered($user));

        return redirect()->route('home');
    }
}
