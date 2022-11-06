
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
                            <div class="profile-info">
                                <div class="input"> 
                                  <p> Email </p>  <small> {{auth()->user()->email}}</small>
                                </div>
                                <div class="input">
                                   <p> Phone Number </p> <small> {{auth()->user()->phone_no ?? "Add Phone Number"}}</small>
                                </div>
                                <div class="input">
                                    <p> Date of Birth </p> <small> {{auth()->user()->dob ?? "Add Date of Birth"}}</small>
                                </div>       
                                @if (auth()->user()->gender == 'M') 
                                <div class="input">
                                    <p> Gender </p> <small> Male </small>
                                </div>  
                                @elseif(auth()->user()->gender == 'F')
                                <div class="input">
                                    <p> Gender </p> <small> Female </small>
                                </div>  
                                @elseif(auth()->user()->gender == '0')
                                <div class="input">
                                    <p> Gender </p> <small> Others </small>
                                </div>  
                                @else 
                                <div class="input">
                                    <p> Gender </p> <small> Add Your Gender </small>
                                </div>  
                                @endif 
                            </div>            
                                <div class="d-flex justify-content-between mt-2 mb-3">
                                    <a href="/admin/profile/{{auth()->id()}}/edit" class="text-decoration-none text-white btn btn-outline-secondary btn-sm"> Edit Profile</a>
                                    <a href="/admin/author" class="btn btn-outline-light btn-sm"> Add Your Author Profile </a>
                                    <a href="/admin/passwordUpdate/{{auth()->id()}}/edit" class="text-decoration-none text-white btn btn-outline-secondary btn-sm"> Edit Password </a>
                                </div>
                                <small class="text-muted mt-3 mb-3"> Social Profile Connections </small>
                                <div class="d-flex justify-content-around mt-3">
                                    <div>
                                        <span class="me-2"> Instagram </span> 
                                        <a href="{{auth()->user()->author->instagram ?? '#'}}">  <img src="/images/instagram.png" alt="" width="30px" height="30px"></a>
                                    </div>
                                    <div>
                                        <span class="me-2"> Facebook </span> 
                                        <a href="{{auth()->user()->author->facebook ?? '#'}}">  <img src="/images/facebook.png" alt="" width="30px" height="30px"></a>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="col-md-5">
                            <small class="text-muted"> Last Post </small>

                            @foreach ($posts as $post)
                            <div class="profile-card mt-2 p-2">
                                <div class="d-flex">
                                   @if ($post->images()->exists())
                                   <img src="/images/{{$post->images[0]->path}}" alt="">
                                   @else
                                   <img src="/images/test.jpg" alt="" width="100px" height="100px">
                                   @endif
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
                                           {{$device->country_name, $device->city_name}}
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