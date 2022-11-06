@extends('layouts.admin')
@section('title', 'create page')
@section('content')
      
<style>
  td {
        font-size: 14px;
    }

    th {
        font-size: 16px
    }

    table {
        background-color: grey;
        color: black;
        margin-left: 120px;
        text-align: center;
    }
    .icon-box div {
        border: 2px solid grey;
        border-radius: 5px;
        padding: 40px 40px;
        margin: 0px 40px;
        text-align: center;
    }
    .icon-box i {
        font-size: 30px;
    }
    .icon-box span {
        display: block;
    }
</style>

        @if(session('message'))
            <div class="alert alert-success mx-3 my-3">
                {{session('message')}}
            </div>
        @endif

       <div class="container bg-dark text-white">
        <div class="row vh-100 ">
            <div class="col-md-12 mt-5">
                <div class="d-flex justify-content-between"> 
                  
                    <h3 class="ms-3"> User Adminstartion  </h3>
                   
                   <p> <a href="/admin/user/create" class="btn btn-outline-light btn-sm me-5"> Create User </a></p>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="ms-3 d-flex justify-content-center mt-3 icon-box">           
                    <div class="">
                        <p>  
                            <i class="fa-solid fa-user me-3 text-success"></i> 
                        </p>
                        <span>Admin - {{$admin_count}} </span>
                    </div>
                    <div class="">
                        <p> 
                            <i class="fa-solid fa-book me-3 text-info"></i>  
                        </p>
                        <span>  Editor - {{$editor_count}} </span> 
                    </div>
                    <div class="">
                        <p>
                            <i class="fa-sharp fa-solid fa-users me-3 text-primary"></i> 
                        </p>
                        <span class="mt-3"> User -  {{$user_count}}  </span>
                    </div>
                </div>
            </div>
           <div class="col-md-12 my-3">
            <table class="table w-75">
                <thead>
                    <tr>
                        <th> UserID</th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Role </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td> 
                          {{$user->email}}
                        </td>
                        <td>
                            @if ($user->role_as == '1')
                                Admin 
                            @elseif($user->role_as == '2')
                                Editor
                            @else 
                                User
                            @endif
                        <td> 
                           <div class="d-flex justify-content-center">
                               <form action="/admin/user/{{$user->id}}" method="POST">
                                <a href="/admin/user/{{$user->id}}/edit" class="ms-5 text-white btn btn-success btn-sm"> Edit </a> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-5 btn btn-danger btn-sm ms-5 me-5" onclick="return confirm('Do you want to delete')"> Delete </button>
                            </form>   
                           </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           </div>
            {{$users->links()}}
        </div>
       </div>
@endsection