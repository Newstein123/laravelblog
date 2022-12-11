<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {       
        $post = Post::orderBy('id', 'desc')->get();
        return HomeResource::collection($post);
   }

   public function show($id) {
      $post = Post::findOrFail($id);
      $comments = $post->comments;
      return new HomeResource($post);
   }

}
