@extends('layouts.frontend')
@section('content')
<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Reset Password!</h1>
            </div>
            <form class="user" action="{{route('reset.user')}}" method="POST">
            @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="form-group">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-user"
                            id="InputPassword" placeholder="Password" name="password">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                </div>        
                <div class="form-group">

                        <label for="exampleConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-user"
                            id="ConfirmPassword" placeholder="Confirm Password" name="confirm_password">
                        @if ($errors->has('confirm_password'))
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                </div>                
                <button type="submit" class="btn btn-primary btn-user btn-block">Reset Password</button>
              
                <!-- Social Login Section -->
            </form>
            <hr>            
        </div>
    </div>
</div>


@endsection