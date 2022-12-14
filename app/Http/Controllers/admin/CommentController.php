<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {   
        $comments = Comment::all();
        return view('/admin/comment/index', compact('comments'));
    }
}
