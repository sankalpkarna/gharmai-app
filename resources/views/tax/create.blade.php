@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Add Tax</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('tax')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Tax List
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('tax.store')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputTitle" class="form-label">Title *</label>
										<input type="text" class="form-control " id="inputtitle"
										placeholder="Enter Tax Title" name="title" value="{{old('title')}}">
										@if ($errors->has('title'))
										<span class="text-danger">{{ $errors->first('title')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputStatus"  class="form-label">Status</label>
										<select class="form-control " aria-label="Default select example" name="status">
											<option selected="" disabled="">Select Status:</option>
											<option value="1" {{ (old('status')=='1')? "selected" : "" }}>Active</option>
		                                    <option value="0" {{ (old('status')=='0')? "selected" : "" }}>InActive</option>
										</select>
										@if ($errors->has('status'))
										<span class="text-danger">{{ $errors->first('status')}}</span>
										@endif
                                    </div>
                            </div>

                            <div class="form-group row">

                            		 <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputType"  class="form-label">Tax Type</label>
										<select class="form-control " aria-label="Default select example" name="type">
											<option selected="" disabled="">Select Type:</option>
											<option value="fixed" {{ (old('type')=='fixed')? "selected" : "" }}>Fixed</option>
		                                    <option value="percentage" {{ (old('type')=='percentage')? "selected" : "" }}>Percentage</option>
										</select>
										@if ($errors->has('type'))
										<span class="text-danger">{{ $errors->first('type')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputValue" class="form-label">Value *</label>
										<input type="text" class="form-control " id="inputvalue"
										placeholder="Enter Value" name="value" value="{{old('value')}}">
										@if ($errors->has('value'))
										<span class="text-danger">{{ $errors->first('value')}}</span>
										@endif
                                    </div>
                                   
                            </div>
				
			
								   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Create Tax</span></button>
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

