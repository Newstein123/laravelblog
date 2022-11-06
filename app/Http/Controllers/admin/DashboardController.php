<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\View;
use App\Models\Device;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function dashboard()
    {   
        $posts =  Post::where('user_id', auth()->id())->limit(5)->get();
        $post_count = Post::where('user_id', auth()->id())->count();
        $comments = Comment::orderBy('id', 'desc')->limit(3)->get();
        $views = View::all()->count();
        $window = Device::where('device_name', 'Windows')->get()->count();
        $mobile = Device::whereIn('device_name', ['iOS', 'AndroidOS'])->get()->count();
       
        return view('admin/dashboard', compact('posts', 'post_count', 'comments', 'views', 'window', 'mobile'));
    }
}
