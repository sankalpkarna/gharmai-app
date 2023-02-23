@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   
	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Coupon</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('coupon')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Coupon List
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9 card shadow mb-4">
					<div class="p-5">
						<form class="user" action="{{route('coupon.update',$coupon->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
                                <label for="InputCode" class="form-label">Coupon Code *</label>
								<input type="text" class="form-control " id="inputcode"
								placeholder="Enter Coupon Code" name="code" value="{{$coupon->code}}">
								@if ($errors->has('code'))
								<span class="text-danger">{{ $errors->first('code')}}</span>
								@endif                                 
                            </div>

                            <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    	<label for="InputDiscountType"  class="form-label">Discount Type *</label>
										<select class="form-control " aria-label="Default select example" name="discount_type">
											<option selected="" disabled="">Select Discount Type:</option>
											<option value="percentage" {{ ($coupon->discount_type == 'percentage')? "selected" : "" }}>Percentage</option>
		                                    <option value="fixed" {{ ($coupon->discount_type == 'fixed')? "selected" : "" }}>Fixed</option>
										</select>
										@if ($errors->has('discount_type'))
										<span class="text-danger">{{ $errors->first('discount_type')}}</span>
										@endif                                        
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    	<label for="InputDiscount" class="form-label">Discount *</label>
										<input type="text" class="form-control " id="inputdiscount"
										placeholder="Enter Discount" name="discount" value="{{$coupon->discount}}">
										@if ($errors->has('discount'))
										<span class="text-danger">{{ $errors->first('discount')}}</span>
										@endif                                        
                                    </div>
                            </div>				
							<div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
									<label for="exampleInputExpireDate" class="form-label">Expire Date *</label>
					            	<input type="datetime-local" class="form-control" name="expire_date" id="InputExpireDate" 
					            	value="{{$coupon->expire_date}}">
					            	@if ($errors->has('expire_date'))
									<span class="text-danger">{{ $errors->first('expire_date')}}</span>
									@endif
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="InputStatus"  class="form-label">Status *</label>
									<select class="form-control " aria-label="Default select example" name="status">
										<option selected="" disabled="">Select Status:</option>
										<option value="1" {{ ($coupon->status == '1')? "selected" : "" }}>Active</option>
	                                    <option value="0" {{ ($coupon->status == '0')? "selected" : "" }}>InActive</option>
									</select>
									@if ($errors->has('status'))
									<span class="text-danger">{{ $errors->first('status')}}</span>
									@endif
                                </div>
							</div>
							
							<div align="center">
							<button type="submit" class="btn btn-primary btn-lg btn-icon-split"><span class="text">Edit Coupon</span></button>
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

