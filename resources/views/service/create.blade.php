@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Add Service</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('service')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Service List
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9">
					<div class="p-5">
						<form class="user" action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="InputName" class="form-label">Name *</label>
								<input type="text" class="form-control form-control-user" id="inputname"
								placeholder="Enter Service Name" name="name" value="{{old('name')}}">
								@if ($errors->has('name'))
								<span class="text-danger">{{ $errors->first('name')}}</span>
								@endif
							</div>
							<div class="form-group">
								<label for="InputDescription" class="form-label">Description *</label>
								<textarea class="form-control form-control-user" id="InputDescription"
								placeholder="Enter Description" name="description" rows="2" wrap="physical" name="comments">{{old('description')}}</textarea>
								@if ($errors->has('description'))
								<span class="text-danger">{{ $errors->first('description')}}</span>
								@endif
							</div>
								   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-user btn-lg btn-icon-split"><span class="text">Create Service</span></button>
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

