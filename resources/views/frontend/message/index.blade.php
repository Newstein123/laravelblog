@extends('frontend/layouts/app')
@section('title', 'Home')
@section('content')
<style>
    .message-background {
        background: url('https://i.ytimg.com/vi/pA0Oxg66TsI/maxresdefault.jpg')
    }
    .message-container {
        width: 800px;   
        max-height: 100vh;
        border: 1px solid #ddd;
        margin: 0px 300px;
        padding: 10px 20px;
        border-radius: 10px;
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#cedce7+0,596a72+100;Grey+3D+%231 */
        background: rgb(206,220,231); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(206,220,231,0.5) 0%, rgba(89,106,114,0.5) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(206,220,231,0.5) 0%,rgba(89,106,114,0.5) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(206,220,231,0.5) 0%,rgba(89,106,114,0.5) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=0 ); /* IE6-9 */

    }

    .text-body {
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #ddd;
        border-radius: 20px;
        margin: 5px;
        font-size: 0.8em;
    }

    #profile {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .help-center {
        padding: 10px;
        border-radius: 20px;
       /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#4096ee+0,4096ee+100;Blue+Flat+%232 */
        background: rgb(64,150,238); /* Old browsers */
        background: -moz-linear-gradient(top,  rgba(64,150,238,0.5) 0%, rgba(64,150,238,0.5) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  rgba(64,150,238,0.5) 0%,rgba(64,150,238,0.5) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  rgba(64,150,238,0.5) 0%,rgba(64,150,238,0.5) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4096ee', endColorstr='#4096ee',GradientType=0 ); /* IE6-9 */
    }

    .message-box {
       visibility: hidden;
    }

</style>
  <div class="message-background">
    <div class="message-container text-center shadow-sm">
        @if ($messages->count() > 0)
        <div class="help-center">
            <h3> Help Center </h3>
        <p> Anything we can help?</p>
        </div>
           @foreach ($messages as $message)
           <div class="d-flex align-items-center justify-content-start message">
            @if(!auth()->user()->images()->exists())
                @if (auth()->user()->gender == 'M') 
                <img src="/images/male.png" alt="" class="me-3" id ="profile"> 
                 @elseif(auth()->user()->gender == 'F')
                <img src="/images/female.png" alt="" class="me-3" id ="profile"> 
                @else 
                    <img src="/images/avatar.png" alt="" class="me-3" id ="profile">
                @endif
                 @else
                <img src="/images/{{auth()->user()->images()->first()->path}}" alt="" id="profile" class="me-3">
                @endif
                <p class="text-body"> {{$message->body}} </p>
           </div>
           @endforeach
           @foreach ($replys as $reply)
           <div class="d-flex align-items-center justify-content-end reply">
               <p class="text-body"> {{$reply->body}} </p>
               @if(!$reply->user->images()->exists())
                @if ($reply->user->gender == 'M') 
                <img src="/images/male.png" alt="" class="me-3" id ="profile"> 
                @elseif($reply->user->gender == 'F')
                <img src="/images/female.png" alt="" class="me-3" id ="profile"> 
                @else 
                <img src="/images/avatar.png" alt="" class="me-3" id ="profile">
                @endif
                @else
               <img src="/images/{{$reply->user->images->first()->path}}" alt="" id="profile" class="me-3">
               @endif
            </div>
           @endforeach
           <form action="/{{auth()->id()}}/message" method="POST">
            @csrf
                <div class="row my-3 message-box">
                   <div class="col-md-2">  
                    <select for="message" class="form-control" name="to_user_id"> 
                        @foreach ($users as $user)
                        <option value="{{$user->id}}"> To : {{$user->name}} </option>
                        @endforeach
                    </select>
                   </div>
               <div class="col-md-8">
               <textarea name="body" id="" cols="10" rows="1" class="form-control"></textarea>
               </div>
               <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"> Send </button>
               </div>
                </div>
           </form>
           <div class="d-flex justify-content-between">
                <a  class="btn btn-success" id="message" onclick="showMessage()"> More Message </a>
                <a href="/" class="btn btn-danger"> Go to Home </a>
           </div>
        @else
        <h3 class="text-center"> If you have any questions about our contents, <br><span class="text-success fs-1">  message us now. </span></h3>
        <img src="https://tog.co.id/wp-content/uploads/2020/05/tog1.jpeg" alt="" width="400px">
        <form action="/{{auth()->id()}}/message" method="POST">
            @csrf
                <div class="row my-3 message-box">
                   <div class="col-md-2"> 
                     <select for="message" class="form-control" name="to_user_id"> 
                        @foreach ($users as $user)
                        <option value="{{$user->id}}"> {{$user->name}} </option>
                        @endforeach
                    </select>
                </div>
               <div class="col-md-8">
               <textarea name="body" id="" cols="10" rows="1" class="form-control"></textarea>
               </div>
               <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"> Send </button>
               </div>
                </div>
           </form>
        <div class="d-flex justify-content-between mt-3">
            <a  onclick="showMessage()" class="btn btn-primary" id="start_message"> Start Now </a>
            <a href="/" class="btn btn-danger"> Back </a>
        </div>
        @endif
    </div>
  </div>

  <script>
    showMessage = () => {
        document.querySelector('.message-box').style.visibility = 'visible';
        document.getElementById('message').style.display = 'none';
        document.getElementById('start_message').style.display = 'none';
    }

    hideMessage = () => {
        document.querySelector('.message-box').style.visibility = 'hidden';
        document.getElementById('message').style.display = 'block';
    }
  </script>
@endsection