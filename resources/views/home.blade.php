@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @role('admin')
        @include('dashboard.admin')
    @endrole
    
    @role('provider')
        @include('dashboard.provider')
    @endrole

    @role('customer')
        @include('dashboard.customer')
    @endrole

    @role('superadmin')
        @include('dashboard.superadmin')
    @endrole
    
</div>
<!-- /.container-fluid -->

<!-- Page level plugins -->
<script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>

@endsection

    