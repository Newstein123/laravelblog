@extends('layouts.admin')
@section('title', 'Label')
@section('content')

<style>
    th, td {
        font-size: 1em;
    }
</style>
<div class="row m-3 justify-content-center">
    <div class="col-md-12">
        @if ($messages->count() > 0)
        <h3> Message Information</h3>
        <table class="table w-100">
            <thead>
                <tr>
                    <th> Number </th>
                    <th> From </th>
                    <th> To </th>
                    <th> Body </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($messages as $message)
                    <tr>
                        <td> {{$message->id}}</td>
                        <td> {{$message->user->name}}</td>
                        <td> {{auth()->user()->name}}</td>
                        <td> {{$message->body}}</td>
                        <td> <a href="/admin/message/{{$message->user->id}}/create" class="btn btn-success btn-sm">  Reply </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
        @else
            <h3 class="text-danger text-center"> There is no message yet </h3>
        @endif
    </div>
</div>
@endsection