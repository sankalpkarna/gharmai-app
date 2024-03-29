@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Permission</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('permission')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Permission Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="permission" action="{{route('permission.update',$permission->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="InputName" class="form-label">Name</label>
								<input type="text" class="form-control" id="inputname"
								placeholder="Enter Permission Name" name="name" value="{{$permission->name}}">
								@if ($errors->has('name'))
								<span class="text-danger">{{ $errors->first('name')}}</span>
								@endif
							</div>
								   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Update Permission</span></button>
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

