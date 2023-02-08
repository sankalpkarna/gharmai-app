@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Profile Settings</h6>
            <div class="dropdown no-arrow">
                <a href="{{route('home')}}">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to Home
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Main page content-->                
            <!-- Profile page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link active ms-0" href="{{route('profile')}}">Profile</a>
                <a class="nav-link" href="{{route('profile.security')}}">Security</a>
                <!-- 
                <a class="nav-link" href="account-billing.html">Billing</a>
                <a class="nav-link" href="account-notifications.html">Notifications</a> 
                -->
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png" alt="" />
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="InputName">Name *</label>
                                    <input class="form-control" id="inputname" type="text" placeholder="Enter your Name" name="name" value="{{$data->name}}" />
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOrgName">Organization name</label>
                                        <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" value="" />
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLocation">Location</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="" />
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="InputEmail">Email address *</label>
                                    <input class="form-control" id="inputemail" type="email" placeholder="Enter your email address" name="email" value="{{$data->email}}" disabled />
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="InputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="" />
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="InputBirthday">Birthday</label>
                                        <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="" />
                                    </div>
                                </div>

                                <div class="form-group">
                                   <label for="InputRole"  class="small mb-1">Role *</label>
                                   <select class="form-select form-control" aria-label="Default select example" name="role">
                                       <option selected="" disabled="">Select a role:</option>
                                       <option value="admin" selected="">Admin</option>
                                       <option value="teacher">Provider</option>
                                       <option value="student">Customer</option>
                                       <option value="parent">User</option>
                                   </select>
                               </div>    
                               <!-- Save changes button-->

                               <button type="submit" class="btn btn-primary">Save Changes</button>
                           </form>
                       </div>
                   </div>
               </div>
           </div>                
       </div>
   </div>
</div>
@endsection