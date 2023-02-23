@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Add User</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('user')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to User Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9  card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="exampleInputName" class="form-label">Name *</label>
								<input type="text" class="form-control " id="InputName"
								placeholder="Enter your Name" name="name" value="{{old('name')}}">
								@if ($errors->has('name'))
								<span class="text-danger">{{ $errors->first('name')}}</span>
								@endif
							</div>
							<div class="form-group">
								<label for="exampleInputEmail" class="form-label">E-mail *</label>
								<input type="email" class="form-control " id="InputEmail"
								placeholder="Email Address" name="email" value="{{old('email')}}">
								@if ($errors->has('email'))
								<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							<div class="form-group">	
								<label for="exampleInputMobileNumber" class="form-label">Mobile Number *</label>
								<input type="text" class="form-control " id="InputMobileNumber"
								placeholder="Enter your Mobile Number" name="mobile_number" value="{{old('mobile_number')}}">
								@if ($errors->has('mobile_number'))
								<span class="text-danger">{{ $errors->first('mobile_number')}}</span>
								@endif
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<label for="exampleInputPassword" class="form-label">Password *</label>
									<input type="password" class="form-control "
									id="InputPassword" placeholder="Password" name="password">
									@if ($errors->has('password'))
									<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0">
									<label for="exampleRepeatPassword" class="form-label">Confirm Password *</label>
									<input type="password" class="form-control "
									id="InputConfirmPassword" placeholder="Confirm Password" name="confirm_password">
									@if ($errors->has('confirm_password'))
									<span class="text-danger">{{ $errors->first('confirm_password') }}</span>
									@endif
								</div>                                    
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<label for="exampleInputGender" class="form-label">Gender *</label>
					                <div class="form-check form-inline">
									  <input class="form-check-input" type="radio" name="gender" id="InputGender" value="Male" {{ (old('gender') == 'Male') ? 'checked' : '' }}>
									  <label class="form-check-label">
									    Male
									  </label>
									</div>
									<div class="form-check form-inline">
									  <input class="form-check-input" type="radio" name="gender" id="InputGender2" value="Female" {{ (old('gender') == 'Female') ? 'checked' : '' }}>
									  <label class="form-check-label">
									    Female
									  </label>
									</div>
									<div class="form-check form-inline">
									  <input class="form-check-input" type="radio" name="gender" id="InputGender3" value="Others" {{ (old('gender') == 'Others') ? 'checked' : '' }}>
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
					            	<input type="date" class="form-control" name="dob" id="InputDOB" value="{{old('dob')}}">
					            	@if ($errors->has('dob'))
									<span class="text-danger">{{ $errors->first('dob')}}</span>
									@endif
								</div>
							</div>		
							<div class="form-group">
								<label for="exampleInputAddress" class="form-label">Address *</label>
								<textarea class="form-control " id="InputAddress"
								placeholder="Enter Address" name="address" rows="2" wrap="physical">{{old('address')}}</textarea>
								@if ($errors->has('address'))
								<span class="text-danger">{{ $errors->first('address')}}</span>
								@endif
							</div>			            

							<div class="form-group">
								<label for="exampleInputRole"  class="form-label">Role</label>
								<select class="form-select form-control" aria-label="Default select example" name="role">
									<option selected="" disabled="">Select a role:</option>
									@foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ (old('role')==$role->name)? "selected" : "" }}>{{ $role->name }}</option>
                                	@endforeach
								</select>
								@if ($errors->has('role'))
                                <span class="text-danger">{{ $errors->first('role')}}</span>
                                @endif
							</div>    

							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Create User</span></button>
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