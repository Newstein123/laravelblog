@extends('frontend/layouts/app')
@section('title', 'Search')
@section('content')
<style>
    .card {
        transition: 0.5s ease-in-out all;
    }
    .card:hover {
        transform:scale(1.05);
    }
</style>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            @if ($posts->count() > 0)
            <div class="col-md-8">
                @foreach ($posts as $post)
                <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        @if ($post->images()->exists())
                        <img src="/images/{{$post->images[0]->path}}" class="img-fluid rounded-start" alt="..." width="150px">
                        @else
                            <small> No Image </small>
                        @endif   
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><a href="/post/{{$post->id}}">{{$post->title}}</a></h5>
                          <p class="card-text"> {!! Str::limit($post->body, 200) !!}</p>
                         <div class="d-flex justify-content-between">
                           <div>
                            @if ($post->categories)
                                @foreach ($post->categories as $category)
                                 <small> {{$category->name}}</small>
                                @endforeach
                            @endif
                           </div>
                            <p class="card-text"><small class="text-muted"> {{$post->created_at->diffForHumans()}}</small></p>
                         </div>
                        </div>
                      </div>
                    </div>
                </div>
                <a href="/" class="btn btn-info btn-sm float-end"> Back to post </a>
                @endforeach
            </div>
            @else
                <div class="col-md-8">
                    <h3 class="text-dark text-muted">
                        There is no post 
                    </h3>
                    <a href="/" class="btn btn-info btn-sm float-end"> Back to post </a>
                </div>
            @endif
        </div>
    </div>
@endsection