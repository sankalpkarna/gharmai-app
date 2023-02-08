@extends('layouts.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">   

	<div class="card shadow mb-4">
		<!-- Card Header - Dropdown -->
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Edit Role</h6>
			<div class="dropdown no-arrow">
				<a href="{{route('role')}}">
					<i class="fas fa-arrow-left"></i>&nbsp;Back to Role Management
				</a>
			</div>
		</div>
		<div class="card-body">
			<!-- Nested Row within Card Body -->
			<div class="row justify-content-center">
				<div class="col-xl-9">
					<div class="p-5">
						<form class="role" action="{{route('role.update',$role->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="InputName" class="form-label">Name</label>
								<input type="text" class="form-control form-control-user" id="inputname"
								placeholder="Enter Role Name" name="name" value="{{$role->name}}">
								@if ($errors->has('name'))
								<span class="text-danger">{{ $errors->first('name')}}</span>
								@endif
							</div>
								
							<div class="form-group">
								<label for="InputPermissions" class="form-label">Assign Permissions</label>
				                 <table class="table table-striped">
				                    <thead>
				                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
				                        <th scope="col" width="20%">Name</th>
				                        <th scope="col" width="1%">Guard</th> 
				                    </thead>
				                    @foreach($permissions as $permission)
				                        <tr>
				                            <td>
				                                <input type="checkbox" 
				                                name="permission[{{ $permission->name }}]"
				                                value="{{ $permission->name }}"
				                                @foreach ($role->permissions as $item)
                                            	{{ ($item->id === $permission->id) ? 'checked' : '' }}
                                        		@endforeach
                                        		>
				                            </td>
				                            <td>{{ $permission->name }}</td>
				                            <td>{{ $permission->guard_name }}</td>
				                        </tr>
				                    @endforeach
				                </table>
							</div>    
							<div align="center">
							<button type="submit" class="btn btn-primary btn-user btn-lg btn-icon-split"><span class="text">Update Role</span></button>
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
@push('script')
<script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {
                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endpush    
@endsection