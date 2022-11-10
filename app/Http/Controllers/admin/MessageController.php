<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {   
    
        $messages = Message::all();
        return view('admin/message/index', compact('messages'));
    }

    public function create($id)
    {
        $message = Message::where('from_user_id', $id)->get();
        return view('admin/message/create', compact('message'));
    }

    public function store(Request $request)
    {

        Message::create([
            'to_user_id' => $request->to_user_id,
            'from_user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect('/admin/message');
    }
}
