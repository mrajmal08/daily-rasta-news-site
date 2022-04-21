<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalUSers = User::all()->count();
        $totalCategories = Category::all()->count();
        $totalPosts = News::all()->count();
        $totalVideos = Video::all()->count();

        return view('home', compact('totalUSers', 'totalCategories', 'totalPosts', 'totalVideos'));
    }
}
