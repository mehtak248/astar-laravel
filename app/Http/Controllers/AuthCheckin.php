<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthCheckin extends Controller
{
    public function registration(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'age_group' => 'required',
            'designation' => 'required',
            'school' => 'required',
            'know_about' => 'required',
            'mailing_address' => 'required',
            'acknowledge' => 'required',
        ]);

        $user = User::updateOrCreate([
            'email' => $request->post('email'),
        ], [
            'name' => $request->post('name'),
            'password' => Hash::make(''),
            'role_id' => 2,
            'age_group' => $request->post('age_group'),
            'designation' => $request->post('designation'),
            'school' => $request->post('school'),
            'know_about' => $request->post('know_about'),
            'subscribed' => $request->post('subscribed') === "on" ? 1 : 0,
            'mailing_address' => $request->post('mailing_address'),
        ]);

        auth()->loginUsingId($user->id, true);

        if (str_replace(url('/'), '', url()->previous()) === "/") {
            return response()->json(['type' => 'success']);
        }
        return redirect()->intended()->with('success', 'Check-In successfully');
    }
}
