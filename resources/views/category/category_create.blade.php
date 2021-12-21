@extends('adminlte::page')

@section('title', 'Category Management')

@section('content_header')
    <h1 class="m-0 text-dark">Category Management</h1>
@stop

@section('content')
<div class="card card-info">
    @if (session('error'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                {{ session('error') }}
            @endforeach
        </ul>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <categorycreate-component><categorycreate-component>

</div>
     
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
     <script>
        // var id = $('#id').val();

   
 $(document).ready(function() {
  $("#permission_create").validate({
    rules: {
        name: {
            required: true,
        },
        slug: {
            required: true,
        },
       
    },
    // Specify validation error messages
    messages: {
        name: {
            required: "Please provide a name",
        },
        slug: {
            required: "Please provide a slug",
        }, 
        
    },
   
    submitHandler: function(form) {
      form.submit();
    }
  });
});
 

    </script>
@stop