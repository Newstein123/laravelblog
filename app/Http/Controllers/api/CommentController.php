<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {   
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    public function show($id)
    {
        $comment = Comment::find($id);

        if(!$comment) {
            return response()->json([
                'data' => 'no result for this query',
            ], 404);
        }

        return new CommentResource($comment);
    }

    public function store(Request $request)
    {
       $comment = Comment::create([
        'id' => $request->id,
        'name' => $request->name,
        'body' => $request->body,
        'post_id' => $request->post_id,
       ]);

       return response()->json([compact('comment')], 200);
    }

    public function update(CommentRequest $request,$id)
    {   
        $comment = Comment::find($id);
        if(!$comment) {
            return response()->json([
             'data' => 'no result'
            ], 404);
            }

        $comment->update([
            'id' => $request->id,
            'body' => $request->body,
        ]);

        return response()->json([compact('comment')], 200);
    }

    public function destroy($id)
    {   
        $comment = Comment::destroy($id);

        if(!$comment) {
            return response()->json([
             'data' => 'no result'
            ], 404);
            }
        return response()->json([], 200);
    }
}
