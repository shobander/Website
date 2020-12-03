<?php

use App\Models\Product;
use App\Models\Order;

$title= "Profile";

if( ! isset($info_message) ){
    $info_message="";
}



?>

@extends('admin.master')

@section('title', $title)

@section('content')



<div class="m-0 p-0 text-info">{{ $info_message }}</div>

<div class="row mb-3">

<!-- CHANGE PASSWORD -->
    <div class="col-lg-6 mt-2">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ url("/admin/change_password") }}>
                            @csrf
                            <div class="form-group"><label for="password"><strong>Current Password</strong></label><input id="password" class="form-control" type="password" name="password" required></div>
                            @error("password", "password_bag")
                            <div class="text-danger">Incorrect password</div>
                            @enderror
                            <div class="form-group"><label for="new_password"><strong>New Password</strong></label><input id="new_password" class="form-control" type="password" name="new_password" required></div>
                            @error("new_password", "password_bag")
                            <div class="text-danger">Passwords do not match</div>
                            @enderror
                            <div class="form-group"><label for="confirm_password"><strong>Confirm New Password</strong></label><input id="confirm_password" class="form-control" type="password" name="confirm_password" required></div>
                            @error("confirm_password", "password_bag")
                            <div class="text-danger">Passwords do not match</div>
                            @enderror
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ADD NEW ADMIN ACCOUNT -->
    <div class="col-lg-6 mt-2">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Add New Account</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ url("/admin/store") }}>
                            @csrf
                            <div class="form-group"><label for="Name"><strong>Name</strong><br></label><input id= "name"class="form-control" type="text" name="name" value="{{old('name')}}" ></div>
                            @error("name", "create")
                            <div class="text-danger">Invalid name</div>
                            @enderror
                            <div class="form-group"><label for="Email"><strong>Email</strong><br></label><input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" ></div>
                            @error("email", "create")
                            <div class="m-0 p-0 text-danger">Invalid email</div>
                            @enderror
                            <div class="form-group"><label for="password"><strong>Password</strong><br></label><input class="form-control" name="password" type="password"></div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Create Account</button></div>
                        </form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- DELETE ACCOUNT -->
    <div class="col-lg-6 mt-2">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-danger m-0 font-weight-bold">Delete Account</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ url("/admin/delete") }}>
                            @csrf
                            <div class="form-group"><label><strong>Delete Account</strong></label></div>
                            <div class="form-group"><button class="btn btn-danger btn-block btn-sm" type="submit">Delete</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection