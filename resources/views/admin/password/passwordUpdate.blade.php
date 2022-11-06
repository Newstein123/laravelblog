@extends('layouts.admin')
@section('title', 'create page')
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-12 cover-img">
                
                @if (auth()->user()->slider_id != null)
                @if (auth()->user()->slider->images()->exists())
                <img src="/images/{{auth()->user()->slider->images[0]->path}}" alt="" id = "cover">  
                 @else
                No image 
                @endif
                @endif
            </div>
            <div class="col-md-12 profile-img">
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
        </div>
            <div class="col-md-6 shadow-lg">
                 <form action="/admin/passwordUpdate/{{auth()->id()}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h3> Update Your Password </h3>
                    <input type="password" name="old_password" class="form-control my-3" placeholder="Enter Current Password"  required>
                    <input type="password" name="new_password" class="form-control my-3" placeholder="Enter New Password" required>
                    <input type="password" name="confirm_password" class="form-control my-3" placeholder="Confirm Your password" required>
                    @error('confirm_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                        <a href="/admin/profile" class="btn btn-danger btn-sm"> Back </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection