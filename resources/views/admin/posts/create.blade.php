
@extends('layouts.admin')
@section('title', 'create page')
@section('content')
<div class="container" style="background-color: #d4d2c5">
    <div class="row">      
        <div class="col-md-9">
            <div class="ms-5">
                <form action="/admin/posts" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control my-3" name="title" value="{{old('title')}}" placeholder="Title:">
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
                                        {{old('body')}}
                                    </textarea>
                                    @error('body')
                                    <div class="text-danger mt-2 mb-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="m-3 rounded" style="background-color: #d4d2c5;">
                            <small class="text-info p-3"> <b> Image </b>  </small>
                           <div class="row m-3">
                            <div class="col-md-4 my-3">
                                <p class="text-dark"> Upload Post Image </p>
                            </div>
                            <div class="col-md-8 my-3">
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <div class="text-danger mt-3 mb-3">
                                        <span> {{$message}}</span>
                                    </div>
                                @enderror
                            
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
                <img src="/images/{{auth()->user()->images[0]->path}}" alt="" class="post-index-img" id="profile">
            @else
            @if (auth()->user()->gender == 'M')
                <img src="/images/male.png" alt="" class="post-index-img">
            @elseif(auth()->user()->gender == 'F')
            <img src="/images/female.png" alt="" class="post-index-img">
            @else
            <img src="/images/other.png" alt="" class="post-index-img">
            @endif
            @endif  
                <select name="user_id" id="" class="form-control w-75">
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
           <select class="form-control selectpicker my-3 w-75" name="categoryIds[]" multiple data-live-search="true" required>
                @foreach ($categories as $category)
                   <option value="{{$category->id}}"
                    @if(in_array($category->id, old('categoryIds', [])))
                    selected 
                    @endif
                    >  {{$category->name}}</option>
                @endforeach
           </select> <br>

           <small class="text-muted"> <b> Choose Cover Photo  </b> </small> <br>
           <select name="slider_id" id="" class="form-control my-3 w-75">
            @foreach ($sliders as $slider)
                <option value="{{$slider->id}}"> {{$slider->id}} </option>
            @endforeach
            </select>
           
           <div class="d-flex justify-content-between">
            <small class="text-muted"> <b> Published Globally </b> </small> 
            <div class="toggle">
                <div onclick="annimatedToggle()" class="toggle-button"></div>
           </div> 
        </form>
            </div>    
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