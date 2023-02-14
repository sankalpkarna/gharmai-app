@extends('layouts.app')
@section('content')


@push('head')
<!-- Custom styles for this page -->
<link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

<!-- Begin Page Content -->
<div class="container-fluid">   
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Role Settings</h6>
            <div class="dropdown no-arrow">
                <a href="{{route('home')}}">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to Home
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('role.create')}}" class="btn btn-xs btn-primary float-right add">Add Role</a>
            </br></br>
            <table class="table table-bordered" id="roledataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Created Date</th>                    
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Created Date</th>
                        <th width="150">Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->


@push('script')
<!-- Page level plugins -->
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<!--     <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script> -->
<!-- // Call the dataTables jQuery plugin -->
<script>
    $(document).ready(function() {
      var table = $('#roledataTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('role')}}",
         columns: [
            {data: 'id',name: 'id'},
            {data: 'name',name: 'name'},
            {data: 'permissions.[].name', name: 'permissions'},
            {data: 'created_at',name: 'created_at'},
            {data: 'action',name: 'action',orderable: true,searchable: true}
            ]
     });
  });


    $(document).on('click','.delete',function(){

        var id=$(this).data('id');

        if(confirm("Are you sure you want to delete this role?")){
            window.location.href;
        }

    });


</script>
@endpush

@endsection
