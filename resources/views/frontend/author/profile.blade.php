@extends('frontend/layouts/app')
@section('title', 'Search')
@section('content')
<div class="container-fluid profile-img ">
        @if (session('message'))
            <div class="alert alert-danger text-center">
                <h4> {{session('message')}}</h4>
            </div>
        @endif
   @if ($author->user->slider->images()->exists())
   <img src="/images/{{$author->user->slider->images[0]->path}}" alt="">
   @else
   <img src="/images/avatar.png" alt="">
   @endif
</div>
<div class="container">
        <div class="row profile justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="d-flex  justify-content-between">
                    <div>
                       
                        @if ($author->user->images()->exists())
                        <img src="/images/{{$author->user->images[0]->path}}" alt="">
                        @else
                            @if ($author->user->gender == 'M')
                                <img src="/images/male.png" alt="">
                            @elseif ($author->user->gender == 'F')
                                <img src="/images/female.png" alt="">
                            @elseif ($author->user->gender == 'O')
                                <img src="/images/avatar.png" alt="">
                            @endif
                        @endif
                    </div>
                    <div>
                        <h5> {{$author->display_name}}</h5>
                        <p class="mt-5"> {{$author->current_job}}</p>
                    </div>
                    <div>
                        <div class="d-flex text-center">
                            <div class="me-5">
                                <p> {{$articles}} </p>
                                <small> ARTIClES</small>
                            </div>
                            <div class="me-5">
                                <p> 123 </p>
                                <small> VIEWS </small>
                            </div>
                            <div class="me-5">
                                <p> 123 </p>
                                <small> REVIEWS </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 mt-4">
                <div class="row">
                    <div class="col-md-7 shadow-sm border rounded me-4 bg-light about-author">
                        <div class="mt-3">
                            <h4> About Me </h4>
                        <small><i>  {{$author->user->dob}}</i></small>
                        <p > Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim temporibus quaerat laudantium dolor dolore sint consectetur, assumenda nesciunt dicta voluptatem quasi animi pariatur magni, delectus tenetur similique. Rerum atque deleniti quisquam corrupti, voluptatem exercitationem repudiandae, recusandae optio molestias, magnam numquam ipsa repellendus quaerat eligendi nihil eius velit ea earum animi maxime beatae!</p>
                        <a href="{{url()->previous()}}" class="btn btn-danger btn-sm float-end"> Back to post </a>
                        </div>
                    </div>
                    <div class="col-md-4 author-contacts shadow-sm rounded bg-light contact-author">
                        <div class="d-flex justify-content-between mt-3">
                            <h4> Contacts </h4>
                            <div>
                                <a href="{{$author->facebook}}" class="me-3"><img src="/images/facebook.png" alt=""> </a> 
                                <a href="{{$author->instagram}}"> <img src="/images/instagram.png" alt=""></a>
                            </div>
                        </div>
                        <p> Phone Number: {{$author->user->phone_no}}</p>
                        <iframe src="{{$author->user->address}}" width="250" height="150" style="border:0;" class="m-3" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>      
                    </div>
                    <div class="col-md-7 shadow-sm border rounded me-4 mt-3 bg-light review-author" re>
                        <div class="container my-3">
                            <h4 class="mb-3"> Reviews </h4>
                        @if ($reviews->count() > 0)
                            @foreach ($reviews as $review)
                            <div class="d-flex author-review my-2">
                                <img src="/images/avatar.png" alt="" class="me-5">
                                <p> {{$review->name}} </p>
                            </div>
                            <p> {{$review->body}}</p>
                            <hr>
                            @endforeach
                        @else
                            <p class="text-danger text-center d-block"> There is no review yet </p>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-4 shadow-sm rounded mt-3 bg-light">
                        <div class="my-3">
                            <form action="/author/review/{{$author->id}}" method="POST">
                                @csrf
                                <label for="review"> Write a review </label>
                            <textarea name="body" id="" cols="10" rows="5" class="form-control my-2" required></textarea>
                            <button type="submit" class="btn btn-primary btn-sm float-end mb-2"> Submit </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection