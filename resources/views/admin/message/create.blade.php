@extends('layouts.admin')
@section('title', 'Label')
@section('content')

<div class="container m-3">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-dark">
                    Reply To : <span style="text-transform: capitalize"> {{$message[0]->user->name}}</span>
                </div>
                <form action="/admin/message/{{$message[0]->from_user_id}}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="hidden" value="{{$message[0]->from_user_id}}" name="to_user_id">
                    <textarea name="body" id="" cols="10" rows="5" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary mt-3"> Send </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection