@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Add Document</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('document')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Document List
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('document.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputName" class="form-label">Name *</label>
										<input type="text" class="form-control " id="inputname"
										placeholder="Enter Document Name" name="name" value="{{old('name')}}">
										@if ($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputStatus"  class="form-label">Status</label>
										<select class="form-control " aria-label="Default select example" name="status">
											<option selected="" disabled="">Select Status:</option>
											<option value="1">Active</option>
		                                    <option value="0">InActive</option>
										</select>
										@if ($errors->has('status'))
										<span class="text-danger">{{ $errors->first('status')}}</span>
										@endif
                                    </div>
                            </div>								   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Create Document</span></button>
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

