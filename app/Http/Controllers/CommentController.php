<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($id)
    {   
        if(!auth()->user()) {
            return redirect('/login');
        } 
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
        return view('frontend/comment/create', compact('post', 'categories', 'second_categories'));
    }

    public function store(Request $request)
    {
     
            Comment::create([
                'post_id' => $request->post_id,
                'name'    => auth()->user()->name,
                'body'    => $request->body,
            ]);
            
            return redirect('/post/'. $request->post_id);
        
    }

    public function edit($id)
    {   
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
        $comment = Comment::findOrFail($id);
        return view('frontend/comment/edit', compact('post', 'categories', 'second_categories', 'comment'));
    }

    public function update(Request $request, $id)
    {   
        $comment = Comment::findOrFail($id);

        $comment->update([
            'post_id' => $request->post_id,
            'name'    => auth()->user()->name,
            'body'    => $request->body,
        ]);

        return redirect('/post/'. $id);
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->back();
    }
}
