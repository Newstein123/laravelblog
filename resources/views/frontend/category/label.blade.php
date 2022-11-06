@extends('frontend/layouts/app')
@section('title', 'Home')
@section('content')

@if ($posts->count() > 0)
<div class="container mt-3">
    <h3> Avaiable Posts for {{$category->name}}</h3>
    @foreach ($posts as $post)
    <div class="row">
            <div class="col-md-4">
                @if ($post->images()->exists())
                    <img src="/images/{{$post->images()->first()->path}}" alt="">
                @endif
            </div>
            <div class="col-md-8">
                <small class="my-3"> {{$post->title}}</small> 
                <span> ({{$post->created_at->diffForHumans()}})</span>
                <div class="d-flex justify-content-start mt-3">
                    <a href="/{{$post->id}}" class="btn btn-outline-dark btn-sm"> See Post </a>
                </div>
            </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-end">
        <a href="/" class="btn btn-outline-dark"> View all posts </a>
    </div>
</div>
@else
    <div class="text-center mt-5">
        <h3> There is no posts. </h3>
        <a href="/" class="btn btn-link"> View all posts </a>
    </div>
@endif
@endsection