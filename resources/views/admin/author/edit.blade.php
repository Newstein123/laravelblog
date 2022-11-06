@extends('layouts.admin')
@section('title', 'Update Author')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="my-3"> Update Your Author Information </h3>
            <small class="text-danger"> * Required Fields </small>
                <form action="/admin/author/{{$author->id}}" method="POST">
                @csrf
                @method('PUT') 
                <input type="hidden" value="{{auth()->id()}}" name="user_id">
                <input type="text" name="display_name" class="form-control  my-3" placeholder="Enter Your Display Name" value="{{$author->display_name}}" required >
                <input type="text" name="current_job" class="form-control  my-3" placeholder="Enter Your Current Job" value="{{$author->current_job}}" required >
                <textarea name="about_author" id="" cols="10" rows="5" class="form-control my-3" required> {{$author->about_author}} </textarea>
                <input type="text" name="facebook" id="" class="form-control my-3" placeholder="Enter Your Facebook Link" value="{{$author->facebook}}" required>
                <input type="text" name="instagram" id="" class="form-control my-3" placeholder="Enter Your Instagram Link" value="{{$author->instagram}}" required>
                <input type="text" name="twitter" id="" class="form-control my-3" placeholder="Enter Your Twitter Link" value="{{$author->twitter}}" required>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-sm"> Update </button>
                    <a href="/admin/author" class="btn btn-danger btn-sm"> Back </a>
                </div>
                </form>
                </form>
        </div>
    </div>
</div>
@endsection