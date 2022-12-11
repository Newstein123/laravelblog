<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::orderBy('id', 'desc')->get();
        return AuthorResource::collection($author);
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return new AuthorResource($author);
    }
}
