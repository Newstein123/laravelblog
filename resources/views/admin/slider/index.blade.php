
@extends('layouts.admin')
@section('title', 'create page')
@section('content')
<style>
    td{
        font-size: 16px;
    }
    th {
        font-size: 20px;
    }
</style>

<div class="container">
   <div class="d-flex justify-content-between">
        <div>
            <h3 class="m-3"> Add Your Cover Image </h3>
        </div>
        <div class="mx-3 my-3">
            <a href="/admin/slider/create" class="btn btn-outline-light btn-sm"> Add Cover Image </a>
        </div>
   </div>
   <hr>
   <div class="row justify-content-center align-items-center" >
    <div class="col-md-12">
        @if ($sliders->count() > 0)
        <table style="width: 90%; margin-left: 50px">
            <thead>
                <tr>
                    <th> NO </th>
                    <th> Type of Image </th>
                    <th> Slider Name </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
               @foreach ($sliders as $slider)
               <tr>
                   <td> {{$slider->id}} </td>
                   <td> 
                       @if($slider->name == null)
                           <small> Profile Cover </small>
                       @else 
                           <small> Post Cover </small>
                       @endif
                   </td>
                   <td> {{$slider->name ?? 'Unknown'}}</td> 
                   <td>  
                       @if ($slider->images()->exists())
                           <img src="/images/{{$slider->images[0]->path}}" alt="" width="100px" height="100px" style="border-radius: 100px">
                       @else
                           <small class="text-danger"> No image </small>
                       @endif    
                   </td>
               </tr>
               @endforeach
            </tbody>
        </table>
        @else
            <tbody>
                 <h3 class="text-danger text-center"> There is no cover image yet </h3>
            </tbody>
        @endif
    </div>
   </div>
</div>

@endsection