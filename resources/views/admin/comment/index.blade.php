@extends('layouts.admin')
@section('title', 'Comment')
@section('content')
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            @if ($comments->count() > 0)
            <h3> Comment Information</h3>
            @foreach ($comments as $comment)
            <div class="card text-dark my-3">
                <div class="card-header">
                    <small> <b>  Comment on: </b></small> {{$comment->post->title}}
                </div>
                <div class="card-body">
                    {{$comment->body}}
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/post/{{$comment->post->id}}" class="btn btn-primary btn-sm"> See Post </a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                <h3 class="text-danger text-center"> There is no comments yet </h3>
            @endif
        </div>
    </div>
@endsection