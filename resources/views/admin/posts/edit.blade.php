@extends('layouts.admin')

@section('title', 'create page')

@section('content')
<div class="container" style="background-color: #d4d2c5">
    <div class="row">
        <div class="col-md-9">
            <div class="ms-5">
                <form action="/admin/posts/{{$post->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" class="form-control my-3" name="title" placeholder="Title:" value="{{$post->title}}">

                    @error('title')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @enderror

                    <div class="mt-3 bg-white content rounded">
                        <h5 class="text-info p-3"> Contents </h5>
                        <div class="p-2 ms-3 me-3 rounded content-body" style="background-color: #d4d2c5;">
                                <div class="container-fluid">
                                    <textarea name="body" id="body" cols="30" rows="10">
                                        {{$post->body}}
                                    </textarea>
                                </div>

                                @error('body')
                                    <div class="text-danger"> {{$message}}</div>
                                @enderror
                        </div>
                        <div class="m-3 rounded" style="background-color: #d4d2c5;">
                            <small class="text-info p-3"> <b> Image </b>  </small>
                           <div class="row m-3">
                            <div class="col-md-4 my-3">
                                <p class="text-dark"> Upload Image </p>
                            </div>
                            <div class="d-flex col-md-8 my-3">
                                <input type="file" class="form-control" name="image">
                            </div>
                           </div>
                        </div>
                    </div>                   
               
            </div>
        </div>
        <div class="col-md-3">
           <div class="d-flex justify-content-around my-3">
            <a href="" class="btn btn-light btn-sm"> <i class="fa-regular fa-eye me-2"></i> Preveiw </a>
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Save 
                </button>
                <ul class="dropdown-menu">
                    <li> <button type="submit" class="dropdown-item text-decoration-none" style="padding :3px;"> Save </button> </li>
                  <li><a class="dropdown-item" href="#" style="padding :3px;"> Save as draft</a></li>
                </ul>
              </div>
           </div>
    
           <small class="text-muted"> <b>Author</b> </small>
           <div class="d-flex justify-content-around my-2 text-muted">
            @if (auth()->user()->images()->exists())
            <img src="/images/{{auth()->user()->images[0]->path}}" alt="" width="35px" height="35px" style="border-radius: 35px">
            @else
            <img src="/images/avatar.png" alt="" width="35px" height="35px" style="border-radius: 35px">
            @endif
                <select name="" id="" class="form-control w-75">
                     @if (auth()->user()->role_as == '1')
                        @foreach ($user as $author)
                        <option value="{{$author->id}}">         
                            <span>{{$author->name}} <i class="fa-solid fa-sort-down text-dark"></span> 
                        </option>
                        @endforeach
                     @endif              
                </select>
           </div>

           <small class="text-muted"> <b> Post Date </b> </small>          
           <div class="d-flex my-2">
            <div class="bg-light rounded text-dark p-2 me-3 text-muted">
                @php
                echo now()->isoFormat('DD/ MM /YY');
                @endphp
                 <i class="fa-regular fa-calendar-days ms-2"></i>
            </div>
            <div class="bg-light rounded text-dark p-2 text-muted">
                {{now()->isoFormat('H:MM')}}
            </div>
           </div>

           <small class="text-muted"> <b> Labels </b> </small> <br>
           <select class="form-control selectpicker my-3 w-75" name="categoryIds[]" multiple data-live-search="true">
                @foreach ($categories as $category)
                   <option value="{{$category->id}}"
                    @if(in_array($category->id, old('categoryIds', $oldcategory)))
                    selected 
                    @endif
                    >  {{$category->name}}</option>
                @endforeach
           </select>
           
           <div class="d-flex justify-content-between">
            <small class="text-muted"> <b> Published Globally </b> </small> 
            <div class="toggle">
                <div onclick="annimatedToggle()" class="toggle-button"></div>
           </div> 
            </div> 
            
            <div class="img">
                <img src="/images/{{$post->images[0]->path}}" alt="" width="100px">
            </div>
        </form>
        </div>
    </div>
</div>

<script>
   const toggle = document.querySelector(".toggle")
    function annimatedToggle() {
        toggle.classList.toggle('active')
    }
</script>
@endsection