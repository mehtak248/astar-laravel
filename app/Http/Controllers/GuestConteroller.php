<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuestConteroller extends Controller
{

    public function index()
    {
        return view('front.quiz-checkin');
    }

    public function store(Request $request)
    {
        $user = User::where('email','=',$request->email)->first();

        if(!$user){
            $validator = \Validator::make(
                $request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'age_group' => 'required',
                'designation' => 'required',
                'school' => 'required',
                'know_about' => 'required',
            ]);
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('errors', $messages->first());
            }
            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make('');
            $user->email = $request->email;
            $user->age_group = $request->age_group;
            $user->designation = $request->designation;
            $user->school = $request->school;
            $user->know_about = $request->know_about;
            $user->save();

        }

        if (Auth::attempt(['email' => $user->email, 'password' => ''], true)) {
            return redirect()->route('social-wall.index')->with('success', 'Check-In successfully');
        }
    }
}
