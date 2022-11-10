<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class MessageController extends Controller
{
    public function index()
    {   
        $categories = Category::orderBy('id', 'desc')->limit(5)->get();
        $second_categories = Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
        $messages = Message::where('from_user_id', auth()->id())->get();
        $replys = Message::where('to_user_id', auth()->id())->get();
        $users = User::whereIn('role_as', [1,2])->get();
        return view('frontend/message/index', compact('categories', 'second_categories', 'messages', 'users', 'replys'));
    }


    public function store(Request $request)
    {   

       Message::create([
        'body' => $request->body,
        'from_user_id' => auth()->id(),
        'to_user_id' => '1',
       ]);

       return redirect()->back();
    }
}
