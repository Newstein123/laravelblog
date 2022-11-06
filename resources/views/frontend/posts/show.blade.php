

@extends('frontend/layouts/app')
@section('title', 'Home')
@section('content')

   <div class="container mt-3 user-view-detail">
        @if (session('message'))
            <div class="alert alert-danger text-center">
                {{session('message')}}
            </div>
        @endif
    <div class="slider">
        <div class="slider-img">
           @if ($post->slider_id != null)
                @if ($post->slider->images()->exists())
                <img src="/images/{{$post->slider->images()->first()->path}}" alt="">
                @else
                    <img src="/images/astronaunt.png" alt="">
                @endif
                <h5>  {{$post->slider->title}}</h5>            
           @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 d-flex justify-content-between mt-3 post-author">
           <div class="">
            <label for="post_author" class="mb-3">
                <small class="text-muted"> Post Author </small> 
            </label> <br>
               @if ($post->user_id != null)
               @if ($post->user->images()->exists())
               <img src="/images/{{$post->user->images->first()->path}}" alt="" width="50px" height="50px" style="border-radius: 50px" class="me-3"> 
            @else
                 <img src="/images/avatar.png" alt="" width="50px" height="50px" style="border-radius: 50px" class="me-3"> 
             @endif
               @endif
                <span> <b>
                    <a href="/author/{{$post->user->author->id}}" class="text-decoration-none text-black"> 
                     {{$post->user->author->display_name}} </a> </b>
                </span>
           </div>

           <a href="{{route('Home')}}" class="btn btn-link mt-5"> <h5><b>View All Posts</b></h5> </a> 
        </div>
        <div class="col-md-7 mt-3 post-show">
            <b> <h5 class="mt-3"> {{$post->title}}</h5></b>
            <br>
    
          @if ($post->user_id !=null)
                @if ($post->images()->exists())
                <img src="/images/{{$post->images[0]->path}}" alt="">
                @else 
                <img src="/images/login.png" alt="">
                @endif
          @endif
           <p class="mt-3">  {!! $post->body !!}</p> 

           <p class="mb-3 text-center"> 
            @if ($comments->count() == 0)
                There is no comments for this post.
            @else
            {{$comments->count()}} Comments
            @endif
           </p>
           <hr>
            <div class="container">           
                <div class="row">    
                  @foreach ($comments as $comment)
                  <div class="col-md-12 my-2">
                    <p class="d-inline"><b> 
                        @if ($comment->is_annonymous == false)
                            {{$comment->name}}
                        @else
                            Annonymous
                        @endif 
                                    </b></p> <span> <small><i class="fa-regular fa-clock"></i> {{$comment->created_at->diffForHumans()}}</span></small> 
                                    <div class="d-flex mt-3">
                                        <p> <small class="text-muted"> {{$comment->body}} </small> 
                                        </p>
                                      @if(auth()->user()) 
                                        @if (auth()->user()->name == $comment->name)            
                                        <div class="d-flex justify-content-between">
                                            <a href="/post/comment/{{$comment->id}}/edit" class="btn btn-link"> Edit </a>
                                            <form action="/post/comment/{{$comment->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                    <button type = "submit" onclick="return confirm('Do You Want To Delete')" class="btn btn-link"> Delete </button>
                                            </form>
                                        </div>
                                    @endif
                                    @endif
                                    </div>
                                      
                            </div>
                        @endforeach
                    </div>
                <a href="/post/comment/{{$post->id}}" class="btn btn-link mt-2"> Post a comment >></a>
            </div>

        </div>
        <div class="col-md-4 mt-5 ms-3">
            @include('frontend/layouts/include/sidebar')
           
            <div class="related-post">
                <h2 class="mt-4"> Related Posts </h2>
                @php
                $limit = 2;
                @endphp
                    @foreach ($posts as $index => $post)
                    @if ($index > $limit)
                        @break
                    @endif
                    <hr>
                    <p> <a href="/post/{{$post->id}}"> {{$post->title}}</a></p>
                    <div class="d-flex justify-content-between mt-3">
                        <p class="me-3 category"> <a href=""> 
                        @foreach ($post->categories as $category)
                            {{$category->name}}
                        @endforeach    
                        </a> </p>
                        <span>{{$post->created_at->diffForHumans()}}  </span>
                    </div>
                    <hr>
                    @endforeach
            </div>

                <div class="shadow-sm bg-light text-center author-profile my-3">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-12">
                           @if ($post->user_id != null)
                           @if ($post->user->images()->exists())
                           <a href="">
                               <img src="/images/{{$post->user->images[0]->path}}" alt="" width="70px" height="70px" id="author-img">   
                           </a>
                       @else 
                       <img src="/images/avatar.png" alt="" width="70px" height="70px" id="author-img"> 
                       @endif
                       <a href="/author/{{$post->user->author->id}}"> <p class="mt-3 text-center"> <b> {{$post->user->author->display_name}}</b></p></a>
                       <small class="text-muted"> <i> {{$post->user->author->current_job}} </i></small>
                       <div class="container text-center my-3">
                           <a href="{{$post->user->author->facebook}}" class="me-2">  <img src="/images/facebook.png" alt="" width="30px" height="30px"></a>
                           <a href="{{$post->user->author->instagram}}" class="me-2">  <img src="/images/twitter.png" alt="" width="30px" height="30px"></a>
                           <a href="{{$post->user->author->twitter}}">  <img src="/images/instagram.png" alt="" width="30px" height="30px"></a>   
                       </div>
                           @endif
                        <div class="row personal-info">
                            <div class="col-6 p-4"> 
                                <small class="text-muted text-center"> Articles </small> <br>
                            <span> <i class="fa-solid fa-address-card me-2"></i> {{$article_count}}  </span>
                            </div>
                            <div class="col-6 p-4">
                                <small class="text-muted text-center"> Comments </small> <br>
                                <span> <i class="fa-solid fa-comment me-2"></i></i> 
                                    
                                    {{-- {{$post->user->post->comments->count()}}</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
   {{-- @if (request()->url() == url()->current())
   @include('frontend/layouts/footer')
    @endif --}}

   <script>
    const heart = document.getElementById('heart-icon');
    const heartCount = document.getElementById('heart-count');
    heartCount = 0; 
    heart.addEventListener('click', ()=>{
        heart.style.color = 'red';
        heartCount += 1;
    })

    console.log(heartCount);
   </script>
@endsection