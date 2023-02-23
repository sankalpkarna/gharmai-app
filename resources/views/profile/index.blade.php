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
                        <form action="{{route('profile.change-profilepic')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="InputProfileImage" class="form-label">Profile Image </label>        
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>            
                                 <img class="img-account-profile rounded-circle mb-2" style="width: 15rem;" src="{{ asset('storage/users/'.$user->id) }}" alt="" title=""></a>
                                 <input class="btn btn-light" type="file" name="profile_image">
                                @if ($errors->has('profile_image'))
                                <span class="text-danger">{{ $errors->first('profile_image')}}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Upload Profile Image</span></button>
                        </form>
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
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="InputName" class="form-label">Name</label>
                                <input type="text" class="form-control " id="inputname"
                                placeholder="Enter your Name" name="name" value="{{$user->name}}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="InputEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control " id="inputemail"
                                placeholder="Email Address" name="email" value="{{$user->email}}" disabled>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="InputMobileNumber" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control " id="InputMobileNumber"
                                placeholder="Enter your Mobile Number" name="mobile_number" value="{{$user->mobile_number}}">
                                @if ($errors->has('mobile_number'))
                                <span class="text-danger">{{ $errors->first('mobile_number')}}</span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputGender" class="form-label">Gender *</label>
                                    <div class="form-check form-inline">
                                      <input class="form-check-input" type="radio" name="gender" id="InputGender" value="Male" {{ ($user->gender == 'Male') ? 'checked' : '' }}>
                                      <label class="form-check-label">
                                        Male
                                      </label>
                                    </div>
                                    <div class="form-check form-inline">
                                      <input class="form-check-input" type="radio" name="gender" id="InputGender2" value="Female" {{ ($user->gender == 'Female') ? 'checked' : '' }}>
                                      <label class="form-check-label">
                                        Female
                                      </label>
                                    </div>
                                    <div class="form-check form-inline">
                                      <input class="form-check-input" type="radio" name="gender" id="InputGender3" value="Others" {{ ($user->gender == 'Others') ? 'checked' : '' }}>
                                      <label class="form-check-label">
                                        Others
                                      </label>
                                    </div>
                                     @if ($errors->has('gender'))
                                     <span class="text-danger">{{ $errors->first('gender') }}</span>
                                     @endif
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputDOB" class="form-label">Date of Birth *</label>
                                    <input type="date" class="form-control" name="dob" id="InputDOB" value="{{$user->dob}}">
                                    @if ($errors->has('dob'))
                                    <span class="text-danger">{{ $errors->first('dob')}}</span>
                                    @endif
                                </div>
                            </div>      
                            <div class="form-group">
                                <label for="exampleInputAddress" class="form-label">Address *</label>
                                <textarea class="form-control " id="InputAddress"
                                placeholder="Enter Address" name="address" rows="2" wrap="physical">{{$user->address}}</textarea>
                                @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address')}}</span>
                                @endif
                            </div>         
                            <div align="center">
                            <button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Edit User</span></button>
                            </div>                       
                           </form>
                       </div>
                   </div>
               </div>
           </div>                
       </div>
   </div>
</div>
@endsection