
@extends('adminlte::page')

@section('title', 'Permission Management')

@section('content_header')
    <h1 class="m-0 text-dark">Permission Management</h1>
@stop

@section('content')
<a href="{{ route('permission.create_permission') }}"><button   class="btn btn-info" type="button">Create Permission</button></a>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">
     <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  
</div>

@stop


 



@section('css')
     <meta name="csrf-token" content="{{ csrf_token() }}">
    
@stop
@section("footer")
Ritesh Khatri
@stop
@section('js')

<script>
setTimeout(function() {
    $(".alert").alert('close');
}, 5000);


</script>
<script type="text/javascript">
  $(function () {
     
   
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('permission.list') }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
         
         
    });
    
  });
  
</script>

 
@stop
