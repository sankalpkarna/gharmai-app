@extends('layouts.frontend')

@section('content')

<!-- Nested Row within Card Body -->
<div class="row">

    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form class="user" action="loginUser" method="POST">
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail" class="form-label">E-mail</label>
                    <input type="text" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="usernameHelp"
                        placeholder="Email Address" name="email">

                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password" name="password">

                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                <hr>
                <!-- Social Login Section -->
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('recover')}}">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{route('register')}}">Create an Account!</a>
            </div>
        </div>
    </div>
</div>



@endsection
