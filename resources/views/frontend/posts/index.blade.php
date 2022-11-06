@extends('frontend/layouts/app')
@section('title', 'Home')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="top-box">
                @if ($postone[0]->images()->exists())
              <img src="/images/{{$postone[0]->images[0]->path}}" alt="" class="my-3 animate__animated animate__wobble annimate__delay-1s">
              @else
                <img src="/images/testimage.png" alt="" class="my-3">
              @endif
              <div class="d-flex">
                @foreach ($postone[0]->categories as $category)
                   <p class="text-uppercase me-2">  {{$category->name}} </p>                 
                @endforeach
                <small> {{$postone[0]->created_at->diffForHumans()}}</small>
            </div>
              <h3 class="mb-3"> <a href="/post/{{$postone[0]->id}}"> {{$postone[0]->title}}  </a></h3>
              </div>    
        </div>
        <div class="col-lg-4 col-sm-12">
           @include('frontend/layouts/include/sidebar')
        </div>
        <div class="col-md-12 my-3">
            <h3> Latest News </h3>
            <div class="d-lg-flex justify-content-between mt-3">
                @foreach ($midposts as $post)
                <div class="news-card me-3 shadow-sm">
                  @if($post->images()->exists())
                    <img src="/images/{{$post->images[0]->path}}" alt="" width="200px">
                  @else 
                    <img src="/images/test.jpg" alt="" width="100%">
                  @endif
                  <p class="ms-3"> <a href="/post/{{$post->id}}" > {{$post->title}} </a></p>
                  <div class="d-flex justify-content-between my-3 mx-2">
                    @if ($post->categories->count() > 0)
                    <div>    
                    @foreach ($post->categories as $category)
                    <span class="text-primary"> {{$category->name}} </span>
                    @endforeach
                   </div>
                    @else
                       <span class="text-primary"> NO CATEGORY </span> 
                    @endif
                  <span> {{$post->created_at->diffForHumans()}}</span>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
          @foreach ($allposts as $post)
           <hr>
           <div class="row my-3">
            <div class="col-md-4">
              @if ($post->images()->exists())
                <img src="/images/{{$post->images[0]->path}}" alt="" width="200px">
              @else
                <img src="/images/test.jpg" alt="" width="200px">
              @endif
            </div>
            <div class="col-md-8">
                <a href="/post/{{$post->id}}"> <h3>{{$post->title}}</h3></a> <br>
              <div class="d-flex justify-content-between mt-2">
            
                 @if ($post->categories->count() > 0)
                 @foreach ($post->categories as $category)
                 <span class="text-primary"> {{$category->name}}</span>
                 @endforeach
                 @else
                    <span class="text-primary"> NO CATEGORY </span>
                 @endif
              
              <span> {{$post->created_at->diffForHumans()}}</span>
              </div>
            </div>
          </div>
           <hr>
          @endforeach
        </div>
    </div>
</div>
@endsection