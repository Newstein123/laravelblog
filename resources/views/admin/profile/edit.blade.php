
@extends('layouts/admin')

@section('title', 'Profile')
    
@section('content')
    <div class="container">

        @if(session('message'))
         <div class="alert alert-success m-3" role="alert">
            <h5>  {{ session('message') }} </h5>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 cover-img">
                
                    @if (auth()->user()->slider_id != null)
                    @if (auth()->user()->slider->images()->exists())
                    <img src="/images/{{auth()->user()->slider->images[0]->path}}" alt="" id = "cover">  
                     @else
                    No image 
                    @endif
                    @endif
            </div>
            <div class="col-md-12 profile-img mt-5">
                    <div class="d-flex">
                        @if(!auth()->user()->images()->exists())
                            @if (auth()->user()->gender == 'M') 
                                <img src="/images/male.png" alt="" class="me-3" id ="profile"> 
                             @else 
                                <img src="/images/female.png" alt="" class="me-3" id ="profile"> 
                            @endif
                        @else
                                <img src="/images/{{auth()->user()->images()->first()->path}}" alt="" id="profile" class="me-3">
                         @endif
                    <span class="mt-2"> <h3 style="text-transform: capitalize"> {{auth()->user()->name}}</h3></span>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-7">
                            <small class="text-muted"> Personal Information </small>
                            <form action="/admin/profile/{{auth()->user()->id}}" method= "POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <input type="text" name="name" id="" class="form-control my-3" placeholder="Enter Your Name" value="{{auth()->user()->name}}" required>

                            <input type="email" name="email" id="" class="form-control my-3" placeholder="Enter Your Email" value="{{auth()->user()->email}}" required>

                            <input type="text" name="phone_no" id="" class="form-control my-3" placeholder="Enter Your Phone Number" value="{{auth()->user()->phone_no}}" required>

                            <input type="date" name="dob" id="" class="form-control my-3" placeholder="Enter Your Date of Birth" value="{{auth()->user()->dob}}" required>

                            <textarea name="address" id="" cols="10" rows="5" class="form-control"> {{auth()->user()->address}}</textarea>
                            
                            <select name="gender" id="" class="form-control my-3">
                                <option value="M" 
                                 @selected(auth()->user()->gender == "M")
                                > Male </option>
                                <option value="F"
                                @selected(auth()->user()->gender == "F")
                                > Female  </option>
                                <option value="M"> Others </option>
                            </select>
                            <select name="slider_id" id="" class="form-control my-3">
                               @foreach ($sliders  as $slider)
                               <option value="{{$slider->id}}"> {{$slider->id}}</option>
                               @endforeach
                            </select>
                            <input type="file" class="form-control my-3" name="image">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary"> Update </button>
                                <a href="/admin/profile" class="btn btn-danger"> Back </a>
                            </div>
                            </form>                  
                        </div>
                        <div class="col-md-5">
                            <small class="text-muted"> Last Post </small>

                            @foreach ($posts as $post)
                            <div class="profile-card mt-2">
                                <div class="d-flex">
                                    <img src="/images/login.png" alt="" width="100px" height="100px">
                                    <div class="">
                                        <p> {{$post->title}}</p>
                                        <a href="{{route('post_show', ['id' => $post->id])}}" class="btn btn-warning btn-sm mt-2"> View Post </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <small class="text-muted"> Account Logins </small>
                            <table class="text-white">
                                <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th> Device </th>
                                        <th> Location </th>
                                        <th> Login Type </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($devices as $device)
                                    <tr>
                                        <td> {{$device->created_at->diffForHumans()}}</td>
                                        <td> {{$device->device_name}} </td>
                                        <td> 
                                            @if (!$device->location)
                                                Unknown
                                            @endif
                                            {{$device->location}}
                                        </td>   
                                        <td> Google </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
            </div>
    </div>

@endsection