@extends('layouts.frontend')

@section('content')

    
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                <p class="mb-4">We get it, stuff happens. Just enter your email address below
                    and we'll send you a link to reset your password!</p>
            </div>
            <form class="user" action="{{ route('recover.user') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif 
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Reset Password
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{route('register')}}">Create an Account!</a>
            </div>
            <div class="text-center">
                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</div>


@endsection