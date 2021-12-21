@extends('adminlte::page')

@section('title', 'Role Management')

@section('content_header')
    <h1 class="m-0 text-dark">Role Management</h1>
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
    <div class="card-header">
        <h3 class="card-title">Role Update</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="role_edit" class="form-horizontal" method="POST" action="{{ route('role.role_edit_save') }}">
        @csrf
        <input type="hidden" value="{{ $role->id }}" name="id" id="id" class="form-control">
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $role->name }}" name="name" id="name" class="form-control"   placeholder="Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $role->slug }}" name="slug" id="slug" class="form-control"   placeholder="Slug">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="status" id="status" <?php echo ($role->status == "active") ? 'checked' : ''; ?>  data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">

                    {{-- <input type="checkbox"  data-on-text="normal" data-off-text="abnormal" name="status" id="status" checked data-toggle="toggle"> --}}
                    {{-- <select name="status" id="status" class="form-control col-sm-6">
                        <option value="active" <?php echo ($role->status == "active") ? 'selected' : ''; ?> >Active</option>
                        <option value="inactive" <?php echo ($role->status == "inactive") ? 'selected' : ''; ?>>Inative</option>
                        
                    </select> --}}
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Permission</label>
                <div class="col-sm-10">
                    <select class="selectpicker1 col-sm-6" id="permission" multiple data-live-search="true" name="permission[]">
                         <?php foreach($permission as $key=>$val){ ?>
                        <option value="{{ $val->id}}" <?php echo in_array($val->id,$get_permission_array)?"selected" :"" ;?> >{{ $val->name}}</option>
                    <?php } ?>
                    </select>
                </div>
            </div>

 
            
            
            
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
            <button type="submit" class="btn btn-info">Update</button>
            <a href="{{ route('role.role_management') }}"><button type="button" class="btn btn-default float-right">Cancel</button><a>
            </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>
     
@stop
@section("footer")
Ritesh Khatri
@stop
@section('js')
<script>
      
    $(document).ready(function() {
        $('.selectpicker1').select2();
   });
   </script>
<script>
    setTimeout(function() {
              $(".alert").alert('close');
            }, 5000);
    
    
    </script>
    <script>
        // var id = $('#id').val();

   
 $(document).ready(function() {
  $("#role_edit").validate({
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