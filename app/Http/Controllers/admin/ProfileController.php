<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Device;

class ProfileController extends Controller
{
    public function index()
    {   
        $devices = Device::where('user_id', auth()->id())->get();
        $posts = Post::select('id', 'title', 'body', 'created_at')->orderBy('id', 'desc')->limit(2)->get();
        return view('admin/profile/index', compact('posts','devices'));
    }

    public function edit()
    {   
        $devices = Device::where('user_id', auth()->id())->get();
        $posts = Post::select('id', 'title', 'body', 'created_at')->orderBy('id', 'desc')->limit(2)->get();
        $sliders = Slider::orderBy('id', 'desc')->get();
        $posts = Post::select('id', 'title', 'body', 'created_at')->orderBy('id', 'desc')->limit(2)->get();
        return view('admin/profile/edit', compact('posts', 'sliders', 'devices', 'posts'));
    }

    public function update(Request $request, $id)
    {   
       $user = User::findOrFail($id);

       $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'dob' => $request->dob,
        'phone_no' => $request->phone_no,
        'gender' => $request->gender,
        'slider_id' => $request->slider_id,
       ]);

       if($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time(). '_'. $file->getClientOriginalName();
        $dir = public_path('images');
        $file->move($dir, $filename);

        $user->images()->delete();

        $user->images()->create([
            'path' => $filename,
           ]);
       }
       return redirect('/admin/profile')->with('message', 'A profile was updated succesfully');

    }
}
