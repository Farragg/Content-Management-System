<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $latestPosts = Post::orderBy('id', 'desc')->take(5)->get();
        // 1 is published 0 is drafted
        $posts = Post::where('is_published', 1)->simplePaginate(2);
        $categories = Category::all();
        return view('website.blog.index', compact('posts', 'latestPosts', 'categories'));
    }

    public function show(Post $post)
    {
        return view('website.blog.single', compact('post'));
    }
}
