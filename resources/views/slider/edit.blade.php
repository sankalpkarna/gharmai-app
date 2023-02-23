@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   
	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Slider</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('slider')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Slider Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('slider.update',$slider->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputTitle" class="form-label">Title *</label>
										<input type="text" class="form-control " id="inputtitle"
										placeholder="Enter Slider Title" name="title" value="{{$slider->title}}">
										@if ($errors->has('title'))
										<span class="text-danger">{{ $errors->first('title')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputStatus"  class="form-label">Status</label>
										<select class="form-control " aria-label="Default select example" name="status">
											<option selected="" disabled="">Select Status:</option>
											<option value="1"
											{{ ($slider->status=='1') ? 'selected' : '' }}
											>
											Active
											</option>
		                                    <option value="0"
		                                    {{ ($slider->status=='0') ? 'selected' : '' }}
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
								placeholder="Enter Description" name="description">{{$slider->description}}</textarea>
								@if ($errors->has('description'))
								<span class="text-danger">{{ $errors->first('description')}}</span>
								@endif
							</div>

							<div class="form-group">
								<label for="InputServiceImage" class="form-label">Image *</label>
								 <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ asset('storage/sliders/'.$slider->id) }}" alt="" title=""></a>
								<input class="btn btn-light" type="file" name="image">
								@if ($errors->has('image'))
								<span class="text-danger">{{ $errors->first('image')}}</span>
								@endif
							</div>
								   					   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Update Slider</span></button>
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

