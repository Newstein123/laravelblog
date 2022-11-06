@extends('layouts.admin')
@section('title', 'create page')
@section('content')

<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 bg-dark shadow-lg border-rounded">
            <h3> Add Author </h3>

            <form action="/admin/user" method="POST">
                @csrf
                
                <small class="mt-3 text-danger"> Required Fields </small>
                
                <input type="text" name="name" class="form-control mb-3 mt-3" placeholder="Enter Name">

                <input type="email" name="email" class="form-control my-3" placeholder="Enter Email">

                <input type="password" name="password" class="form-control my-3" placeholder="Enter Password">

               
                    <select name="role_as" id="" class="form-control my-3">
                        <option value="" disabled> Select Role  </option>
                        <option value="2"> Editor </option>
                        <option value="1"> Admin  </option>
                    </select>

                    <small class="mt-3 text-info"> Optional Fields </small>

                <input type="date" name="dob" class="form-control mt-3 mb-3" placeholder="Enter Date of Birth">

                <input type="text" name="address" class="form-control mt-3 mb-3" placeholder="Enter Address">

                <input type="text" name="phone_no" class="form-control mt-3 mb-3" placeholder="Enter Phone Number">

                <select name="gender" id="" class="form-control my-3">
                    <option value="" disabled> Select Gender </option>
                    <option value="M"> Male </option>
                    <option value="M"> Female </option>
                    <option value="M"> Others  </option>
                </select>
                
                <div class="d-flex justify-content-between mt-5">
                    <button type="submit" class="btn btn-outline-light"> Save </button>
                <a href="" class="text-decoration-none text-white btn btn-outline-light"> Return </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection