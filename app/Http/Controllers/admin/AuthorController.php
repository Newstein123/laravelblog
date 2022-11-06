<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {   
        $author = Author::where('user_id', auth()->id())->get();
        return view('admin/author/index', compact('author'));
    }

    public function create(Request $request)
    {   
    
        return view('admin/author/create');
    }

    public function store(Request $request)
    {
        Author::create([
            'user_id' => $request->user_id,
            'display_name' => $request->display_name,
            'current_job' => $request->current_job,
            'about_author' => $request->about_author,
            'facebook'      => $request->facebook,
            'instagram'      => $request->instagram,
            'twitter'      => $request->twitter,
        ]);

        return redirect('/admin/author')->with('message', 'Your author profile was created successfully');
    }

    public function edit(Request $request, $id)
    {   
        $author = Author::findOrFail($id);
        return view('admin/author/edit', compact('author'));
    }

    public function update (Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update([
            'user_id' => $request->user_id,
            'display_name' => $request->display_name,
            'current_job' => $request->current_job,
            'about_author' => $request->about_author,
            'facebook'      => $request->facebook,
            'instagram'      => $request->instagram,
            'twitter'      => $request->twitter,
        ]);

        return redirect('admin/author')->with('message', 'Your author profile was updated successfully');
    }
}
