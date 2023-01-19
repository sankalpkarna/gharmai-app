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
                    <label for="InputName" class="form-label">Name</label>
                    <input type="text" class="form-control form-control-user" id="inputname"
                        placeholder="Enter your Name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="InputEmail" class="form-label">E-mail</label>
                    <input type="email" class="form-control form-control-user" id="inputemail"
                        placeholder="Email Address" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-user"
                            id="InputPassword" placeholder="Password" name="password">

                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label for="exampleRepeatPassword" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control form-control-user"
                            id="RepeatPassword" placeholder="Repeat Password" name="rpassword">
                        @if ($errors->has('rpassword'))
                        <span class="text-danger">{{ $errors->first('rpassword') }}</span>
                        @endif
                    </div>                                    
                </div>
                <div class="form-group">
                    <label for="exampleInputRole"  class="form-label">Role</label>
                    <select class="form-select form-control" aria-label="Default select example" name="role">
                        <option selected="" disabled="">Select a role:</option>
                        <option value="admin" selected="">Admin</option>
                        <option value="provider">Provider</option>
                        <option value="customer">Customer</option>
                        <option value="user">User</option>
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