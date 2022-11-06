@extends('layouts.admin')
@section('title', 'create page')
@section('content')
<style>
    #personal_info img {
        width: 50%;
        margin: 20px 300px;
    }
    
</style>
<div class="container mt-5">
    @if (auth()->user()->author)
        <div class="row justify-content-center">
            <div class="col-md-8">
               @if (session('message'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5> {{session('message')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
               @endif
                <h3 class="my-3"> Author Information</h3>
               
               <div class="profile-info">
                <div class="input"> 
                  <p> <i class="fa-solid fa-input-text me-2"></i> <i class="fa-sharp fa-solid fa-person fs-4 text-info"></i> </p>  <small> {{$author[0]->display_name}}</small>
                </div>
                <div class="input"> 
                  <p> <i class="fa-solid fa-input-text me-2"></i> <i class="fa-solid fa-briefcase fs-4 text-info"></i></p>  <small> {{$author[0]->current_job}}</small>
                </div>
                <div class="input">
                    <p> 
                        <img src="/images/facebook.png" alt="" width="30px" height="30px" style="border-radius: 30px">
                     </p> <small> {{$author[0]->facebook}}</small>
                </div>       
                <div class="input">
                    <p> 
                        <img src="/images/instagram.png" alt="" width="30px" height="30px" style="border-radius: 30px">    
                    </p> <small> {{$author[0]->instagram}} </small>
                </div>  
                <div class="input">
                    <p> 
                        <img src="/images/twitter.png" alt="" width="30px" height="30px" style="border-radius: 30px">      
                    </p> <small> {{$author[0]->twitter}} </small>
                </div>  
            
                    <div class="my-2">
                        <p>
                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa-solid fa-user me-2"></i> About Author >>
                            </button>
                          </p>
                          <div class="collapse" id="collapseExample">
                            <div class="card card-body text-dark text-muted">
                              {{$author[0]->about_author}}
                            </div>
                          </div>
                    </div>
                    <div class="d-flex justify-content-center my-5">
                        <a href="/admin/author/{{$author[0]->id}}/edit" class="btn btn-outline-light btn-sm"> Update your author profile </a>
                    </div>
            </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-info m-5"> Let's start added your personal information  <br>  For your author profile. </h3>
            <div class="d-flex justify-content-between mx-4 my-3">
                <a href="/admin/author/create" class="btn btn-outline-light btn-sm"> Add Now </a> 
                <a href="/admin/profile" class="btn btn-outline-danger btn-sm"> Later </a>
            </div>
            </div>
            <div id ="personal_info">
                <img src="/images/personal_info.png" alt=""  width="600px">
            </div>
        </div>
    @endif
</div>
@endsection