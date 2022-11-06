
@extends('layouts/admin')
@section('title', 'Profile') 
@section('content')
<style>
    .profile_cover {
        display: none;
    }
</style>
<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-8 shadow-lg">
        <div class="text-end profile_cover"> 
            <small onclick="Profile()" class="btn btn-light btn-sm" id="profile-cover" style="display: inline-block"> Profile Cover  </small>
            <small onclick="Post()" class="btn btn-light btn-sm" id="post-cover" style="display: none"> Post Cover  </small>
        </div>

        <form action="/admin/slider" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="post-conatiner" style="display: block">
                <label for="name"> Cover Name </label>
                <input type="text" name="name" class="form-control my-3">
                <label for="body"> Cover Body </label>
                <textarea name="body" id="" cols="10" rows="5" class="form-control my-3"></textarea>
            </div>
            <div class="profile-container" style="display: block">
                <label for="image"> Cover Image </label>
                <input type="file" name="image" class="form-control my-3">
            </div>
            <button type="submit" class="btn btn-outline-light"> Save </button>
        </form>
    </div>
</div>
<script>
    const profile = document.getElementById('profile-cover')
    const post = document.getElementById('post-cover')
    const post_container = document.getElementsByClassName('post-container')
    console.log(post_container)


    function Post() {
        post.style.display = 'none';
        profile.style.display = 'inline-block';
        
    }

    function Profile() {
        profile.style.display = 'none';
        post.style.display = 'inline-block';
        profile.classList.add('profile_cover');
    }
</script>
@endsection