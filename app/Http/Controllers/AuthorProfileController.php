<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use App\Models\View;
use Illuminate\Http\Request;

class AuthorProfileController extends Controller
{
    public function profile($id)
    {   
        $reviews = Review::where('author_id', $id)->get();
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
        $author = Author::findOrFail($id);
        $user_id = $author->user->id;
        $articles = Post::where('user_id', $user_id)->count();
        return view('frontend/author/profile', compact('author', 'categories', 'second_categories', 'reviews', 'articles'));
    }

    public function review(Request $request, $id)
    {
        if(auth()->user()) {
            Review::create([
                'name' => auth()->user()->name,
                'body' => $request->body,
                'author_id' => $id,
            ]);
    
        } else {
            return redirect()->back()->with('message', 'Please login to continue');
        }
        return redirect('/author/'.$id)->with('message', 'Your review is posted successfully');
    }
}
