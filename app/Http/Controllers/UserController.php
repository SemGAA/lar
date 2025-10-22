<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function loginIndex()
    {
        return view("login");
    }

    function login(Request $request)
    {
        $validated = $request->validate([
            "email" => ["required","email"],
            "password" => ["required"],
            ]);

        if(Auth::attempt($validated)){
            session()->flash("ok","Добро пожаловать");
            
            return to_route('dashboard.home');
        }
        session()->flash("alert","Что-то пошло не так");
        return back();
    }

    function logout()
    {
        Auth::logout();
        return to_route("home");
    }

    function registerIndex()
    {
        return view("register");
    }

    function register(Request $request)
    {
        $request->validate([
            'fio' => ['required'],
            'email'=> ['required','email'],
            'password'=> ['required'],
            ]);

        $user = User::query()->create([
            'fio' => $request->input('fio'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password'),
            ]);

        Auth::login($user);

        session()->flash("ok","Добро пожаловать");
        return to_route('dashboard.home');
    }
}
