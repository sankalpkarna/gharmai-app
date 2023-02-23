
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
            <h6 class="m-0 font-weight-bold text-primary">Taxes Settings</h6>
            <div class="dropdown no-arrow">
                <a href="{{route('home')}}">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to Home
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{route('tax.create')}}" class="btn btn-xs btn-primary float-right add">Add Tax</a>
            </br></br>
            <table class="table table-bordered" id="taxdataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Status</th>   
                        <th>Updated Date</th>                      
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Updated Date</th>     
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
        var tax_id;
        var table = $('#taxdataTable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{route('tax')}}",
           columns: [
            {data: 'id',name: 'id'},
            {data: 'title',name: 'title'},
            {data: 'type',name: 'type'},
            {data: 'value',name: 'value'},
            {data: 'status',name: 'status'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action',name: 'action',orderable: true,searchable: true}
            ],
          order: [[6, 'desc']],

        });

        $(document).on('click', '.delete', function(){
           tax_id = $(this).attr('id');
           $('#confirmModal').modal('show');
        });
        $('#ok_button').click(function(){
            $.ajax({
                url:"tax/destroy/"+tax_id,                
                success:function(data){
                    $('#confirmModal').modal('hide');
                    $('#taxdataTable').DataTable().ajax.reload();
                    $('div.flash-message').html(data);

                }
            })
        });

    });
</script>
@endpush

@endsection
