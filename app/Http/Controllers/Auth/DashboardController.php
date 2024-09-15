<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $postsCount = Post::count();
        $categoriesCount = Category::count();
        $usersCount = User::count();
        return view('auth.dashboard', compact('postsCount', 'categoriesCount', 'usersCount'));
    }
}
