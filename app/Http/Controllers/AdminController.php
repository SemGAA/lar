<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'posts_count' => \App\Models\Post::count(),
            'categories_count' => \App\Models\Category::count()
        ];
        
        return view('dashboard.home', compact('stats'));
    }

    public function usersIndex()
    {
        $users = User::all();
        return view('dashboard.users', compact('users'));
    }

    public function usersDelete(User $user)
    {
        $user->delete();
        session()->flash('ok', 'Пользователь успешно удален');
        return back();
    }
}