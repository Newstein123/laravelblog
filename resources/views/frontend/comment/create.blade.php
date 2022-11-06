@extends('frontend/layouts/app')
@section('title', 'Search')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="/post/comment" method="POST">
            @csrf
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Post a comment on : <br>
                    <small> {{$post->title}}</small>
                </div>
                <div class="card-body">
                    <div class="container">
                        <input type="hidden" class="form-control" name="post_id" value="{{$post->id}}">
                         <textarea name="body" id="" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="d-flex justify-content-between my-4">
                        <button type="submit" class="btn btn-info btn-sm"> Post Now </button>
                        <a href="/post/{{$post->id}}" class="btn btn-danger btn-sm"> Later </a>
                    </div>
                 </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection