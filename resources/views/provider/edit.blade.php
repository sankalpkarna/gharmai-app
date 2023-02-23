@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   
	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Provider</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('provider')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Provider Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('provider.update',$user->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputEmail" class="form-label">Email *</label>
										<input type="text" class="form-control " id="inputemail"
										placeholder="Enter Provider Email" name="email" value="{{$user->email}}" disabled>
										@if ($errors->has('email'))
										<span class="text-danger">{{ $errors->first('email')}}</span>
										@endif
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="InputStatus"  class="form-label">Status *</label>
										<select class="form-control " aria-label="Default select example" name="status">
											<option selected="" disabled="">Select Status:</option>
											
											<option value="1"
											@if($provider)
											{{ ($provider->status=='1') ? 'selected' : '' }}
											@endif
											>
											Active
											</option>
		                                    <option value="0"
		                                    @if($provider)
		                                    {{ ($provider->status=='0') ? 'selected' : '' }}
		                                    @endif
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
								<label for="InputProfileImage" class="form-label">Profile Image </label>					
								<input class="btn btn-light" type="file" name="profile_image">
								@if($provider)
								 <img class="img-thumbnail px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('storage/users/'.$user->id) }}" alt="" title=""></a>
								@endif
								@if ($errors->has('profile_image'))
								<span class="text-danger">{{ $errors->first('profile_image')}}</span>
								@endif
							</div>

							<div class="form-group">
                                <label for="InputServiceName"  class="form-label">Service Name *</label>
                                <select class="form-select form-control" aria-label="Default select example" name="service_id">
                                    <option selected="" disabled="">Select Service Name:</option>					
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                    	@if($provider)
                                        @if($service->id = $provider->service_id) selected @endif
                                        @endif
                                    >
                                    {{ $service->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('service_id'))
                                <span class="text-danger">{{ $errors->first('service_id')}}</span>
                                @endif
                            </div>   

							<div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
	                                <label for="InputDocumentName"  class="form-label">Document Name *</label>
	                               
	                                <select class="form-select form-control" aria-label="Default select example" name="document_id">
	                                    <option selected="" disabled="">Select Document Name:</option>					
	                                    @foreach ($documents as $document)
	                                    <option value="{{ $document->id }}"
	                                    	@if($provider)
	                                            {{ ($document->id === $provider->document_id) ? 'selected' : '' }}
           	                                @endif
	                                    >
	                                    {{ $document->name }}
	                                    </option>
	                                    @endforeach
	                                </select>
	                                @if ($errors->has('document_id'))
	                                <span class="text-danger">{{ $errors->first('document_id')}}</span>
	                                @endif
	                            </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                	<label for="InputDocumentNumber" class="form-label">Document Number *</label>
                                	
									<input type="text" class="form-control " id="inputdocumentnumber"
									placeholder="Enter Document Number" name="document_number" value="{{$provider->document_number ?? ''}}">
									@if ($errors->has('document_number'))
									<span class="text-danger">{{ $errors->first('document_number')}}</span>
									@endif
                                </div>
                            </div>   

                            <div class="form-group">
								<label for="InputDocumentImage" class="form-label">Document Image </label>
								<input class="btn btn-light" type="file" name="document_image">
								@if($provider)
								 <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('storage/documents/'.$user->id) }}" alt="" title=""></a>
								 @endif
								@if ($errors->has('document_image'))
								<span class="text-danger">{{ $errors->first('document_image')}}</span>
								@endif
							</div>
								   					   
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Update Provider</span></button>
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

