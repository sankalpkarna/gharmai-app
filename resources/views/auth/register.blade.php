@extends('layouts.frontend')

@section('content')


{{session()->get('success')}};
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            @if(session('username'))
			<h4>Data saved for {{session('username')}}</h4>
			@endif
            <form class="user" action="{{route('register.user')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="InputName" class="form-label">Name *</label>
                    <input type="text" class="form-control form-control-user" id="inputname"
                        placeholder="Enter your Name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputEmail" class="form-label">E-mail *</label>
                    <input type="email" class="form-control form-control-user" id="inputemail"
                        placeholder="Email Address" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="exampleInputPassword" class="form-label">Password *</label>
                        <input type="password" class="form-control form-control-user"
                            id="InputPassword" placeholder="Password" name="password">

                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleConfirmPassword" class="form-label">Confirm Password *</label>
                        <input type="password" class="form-control form-control-user"
                            id="ConfirmPassword" placeholder="Confirm Password" name="confirm_password">
                        @if ($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>                                    
                </div>
                <div class="form-group">
                        <label for="InputMobileNumber" class="form-label">Mobile Number *</label>
                        <input type="text" class="form-control form-control-user" id="InputMobileNumber"
                        placeholder="Enter your Mobile Number" name="mobile_number" value="{{old('mobile_number')}}">
                        @if ($errors->has('mobile_number'))
                        <span class="text-danger">{{ $errors->first('mobile_number')}}</span>
                        @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputRole"  class="form-label">Role *</label>
                    <select class="form-select form-control" aria-label="Default select example" name="role">
                        <option selected="" disabled="">Select a role:</option>
                        @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>    

                <p class="text-justify">

                By signing up you agree to the Gharmai's Terms & Conditons.                    

                </p>

                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
              
                <!-- Social Login Section -->
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('recover')}}">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</div>


@endsection