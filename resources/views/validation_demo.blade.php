
@extends('adminlte::page')

@section('title', 'Category Management')

@section('content_header')
    <h1 class="m-0 text-dark">Category Management</h1>
@stop

@section('content')
     <a href="{{ route('category.create_category') }}"><button   class="btn btn-info" type="button">Create Category</button></a>
     @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif 
{{-- <a href="{{ route('category.create_category') }}"><button   class="btn btn-info" type="button">Create Category</button></a>
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
                
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  
</div> --}}
<div class="container mt-5">

    <validation_demo-component></validation_demo-component>


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

 
@stop
