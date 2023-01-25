@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            <div class="dropdown no-arrow">
                <a href="{{route('user')}}">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to User Management
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="p-5">
                        <form class="user" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="InputName" class="form-label">Name</label>
                                <input type="text" class="form-control form-control-user" id="inputname"
                                placeholder="Enter your Name" name="name" value="{{$user->name}}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="InputEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control form-control-user" id="inputemail"
                                placeholder="Email Address" name="email" value="{{$user->email}}" disabled>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputRole"  class="form-label">Role</label>
                                <select class="form-select form-control" aria-label="Default select example" name="role">
                                    <option disabled="">Select a role:</option>
                                    <option value="admin" {{($user->role == 'admin') ? 'selected' : ''}} >Admin</option>
                                    <option value="provider" {{($user->role == 'provider') ? 'selected' : ''}} >Provider</option>
                                    <option value="customer" {{($user->role == 'customer') ? 'selected' : ''}} >Customer</option>
                                    <option value="user" {{($user->role == 'user') ? 'selected' : ''}} >User</option>
                                </select>
                            </div>    
                            <div align="center">
                            <button type="submit" class="btn btn-primary btn-user btn-lg btn-icon-split"><span class="text">Edit User</span></button>
                            </div>  
                        </form>
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection