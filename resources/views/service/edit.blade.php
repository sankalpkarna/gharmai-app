@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   
	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Service</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('service')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Service Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('service.update',$service->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputName" class="form-label">Name *</label>
										<input type="text" class="form-control " id="inputname"
										placeholder="Enter Service Name" name="name" value="{{$service->name}}">
										@if ($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputStatus"  class="form-label">Status</label>
										<select class="form-control " aria-label="Default select example" name="status">
											<option selected="" disabled="">Select Status:</option>
											<option value="1"
											{{ ($service->status=='1') ? 'selected' : '' }}
											>
											Active
											</option>
		                                    <option value="0"
		                                    {{ ($service->status=='0') ? 'selected' : '' }}
											>
											InActive
											</option>
										</select>
										@if ($errors->has('status'))
										<span class="text-danger">{{ $errors->first('status')}}</span>
										@endif
                                    </div>
                            </div>		

							<div class="form-group">
								<label for="InputDescription" class="form-label">Description *</label>
								<textarea class="form-control " id="InputDescription"
								placeholder="Enter Description" name="description">{{$service->description}}</textarea>
								@if ($errors->has('description'))
								<span class="text-danger">{{ $errors->first('description')}}</span>
								@endif
							</div>

							<div class="form-group">
								<label for="InputServiceImage" class="form-label">Image *</label>
								 <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ asset('storage/services/'.$service->name) }}" alt="" title=""></a>
								<input class="btn btn-light" type="file" name="image">
								@if ($errors->has('image'))
								<span class="text-danger">{{ $errors->first('image')}}</span>
								@endif
							</div>
								   					   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Update Service</span></button>
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

