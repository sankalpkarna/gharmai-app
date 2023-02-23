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
                <div class="col-lg-8">
                    <!-- Change password card-->
                    <div class="card mb-4">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form action="{{route('profile.change-password')}}" class="user" method="POST">
                                @csrf
                                <!-- Form Group (current password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="currentPassword">Current Password</label>
                                    <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password" name="current_password" />
                                    @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    @endif
                                </div>
                                <!-- Form Group (new password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="newPassword">New Password</label>
                                    <input class="form-control" id="newPassword" type="password" placeholder="Enter new password" name="new_password" />
                                    @if ($errors->has('new_password'))
                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                    @endif
                                </div>
                                <!-- Form Group (confirm password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="confirmPassword">Confirm New Password</label>
                                    <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password" name="confirm_new_password" />
                                    @if ($errors->has('confirm_new_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_new_password') }}</span>
                                    @endif
                                </div>
                                <button class="btn btn-primary" type="submit">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Two factor authentication card-->
                    <div class="card mb-4">
                        <div class="card-header">Two-Factor Authentication</div>
                        <div class="card-body">
                            <p>Add another level of security to your account by enabling two-factor authentication. We will send you a text message to verify your login attempts on unrecognized devices and browsers.</p>
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input" id="twoFactorOn" type="radio" name="twoFactor" checked="" />
                                    <label class="form-check-label" for="twoFactorOn">On</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="twoFactorOff" type="radio" name="twoFactor" />
                                    <label class="form-check-label" for="twoFactorOff">Off</label>
                                </div>
                                <div class="mt-3">
                                    <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                                    <input class="form-control" id="twoFactorSMS" type="tel" placeholder="Enter a phone number" value="555-123-4567" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Delete account card-->
                    <div class="card mb-4">
                        <div class="card-header">Delete Account</div>
                        <div class="card-body">
                            <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
                            <a href="#" class="btn btn-danger-soft text-danger delete">
                                <p class="mb-0">I understand, delete my account</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<!-- Page level plugins -->
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<!--     <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script> -->
<!-- // Call the dataTables jQuery plugin -->
<script>
    $(document).ready(function() { 
        $(document).on('click', '.delete', function(){
           $('#confirmModal').modal('show');
        });
        $('#ok_button').click(function(){
             location.href = "{{route('profile.destroy')}}";
        });

    });
</script>
@endpush
@endsection