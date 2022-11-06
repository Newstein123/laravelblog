@extends('layouts.admin')

@section('title', 'show page')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">  
                @foreach ($posts as $post)
                <div class="col-md-4 m-3">
                    <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}} </h5>
                                <p class="card-text"> {{Str::limit($post->body)}} </p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
            @endforeach
           
        </div>
    </div>
@endsection