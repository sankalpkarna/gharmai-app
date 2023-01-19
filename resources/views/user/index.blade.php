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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <button type="button" class="btn btn-xs btn-primary float-right add">Add User</button>
                                </br></br>

                                <table class="table table-bordered" id="usersdataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Role</th>
                                            <th>Created Date</th>                    
                                            <th width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Role</th>
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
    // Call the dataTables jQuery plugin
    <script>
    $(document).ready(function() {
      var table = $('#usersdataTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('user')}}",
         columns: [
            {data: 'name',name: 'name'},
            {data: 'email',name: 'email'},
            {data: 'role',name: 'role'},
            {data: 'created_at',name: 'created_at'},
            {data: 'action',name: 'action',orderable: true,searchable: true}
         ]
      });
    });
    </script>
    @endpush

@endsection
