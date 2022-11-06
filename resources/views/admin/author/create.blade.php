@extends('layouts.admin')
@section('title', 'create page')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            <h3 class="my-3"> Update Your Author Information </h3>
            <small class="text-danger"> * Required Fields </small>  
                <form action="/admin/author" method="POST">
                @csrf
                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                <input type="text" name="display_name" class="form-control  my-3" placeholder="Enter Your Display Name"required >
                <input type="text" name="current_job" id="" class="form-control my-3" placeholder="Enter Your Current Job">
                <textarea name="about_author" id="" cols="10" rows="5" class="form-control my-3" required> About Author </textarea>
                <input type="text" name="facebook" id="" class="form-control my-3" placeholder="Enter Your Facebook Link" required>
                <input type="text" name="instagram" id="" class="form-control my-3" placeholder="Enter Your Instagram Link" required>
                <input type="text" name="twitter" id="" class="form-control my-3" placeholder="Enter Your Twitter Link" required>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm"> Save </button>
                    <a href="/admin/author" class="btn btn-danger btn-sm"> Back </a>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection