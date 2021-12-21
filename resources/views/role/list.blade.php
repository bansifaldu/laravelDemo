
@extends('adminlte::page')

@section('title', 'Role Management')

@section('content_header')
    <h1 class="m-0 text-dark">Role Management</h1>
@stop

@section('content')
{{-- @php echo "<pre>"; print_r($request->user()->can('create-tasks')); exit; @endphp --}}
@if ($request->user()->can('create-tasks')) 
    <a href="{{ route('role.create_role') }}"><button   class="btn btn-info" type="button">Create Role</button></a>
@endif
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
                <th>Status</th>
                {{-- @if ($request->user()->can('create-tasks'))  --}}

                <th>Action</th>
                {{-- @endif --}}
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
<script>
    var role = "{{ $request->user()->can('edit-tasks') }}";
 
</script>
{{-- <script>
    @if($request->user()->can('create-tasks')) 
    var USER_IS_ADMIN = true;
    @else
    var USER_IS_ADMIN = false;
    @endif
    </script> --}}
<script type="text/javascript">
  $(function () {
     
    var showAdminColumns =  role ==1 ? true:false;
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('role.list') }}",
        
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'slug', name: 'slug'},
            {
             "sortable": true,
             "className":'centerize',
             render: function ( data, type, full, meta ) {
                 if(full['status'] == 'active'){
                // return '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled /><label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label></div>';
                    return '<input class="togglebtn" value = "on" id="toggle"  data-id="' + full['id'] + '" type="checkbox" name="status"  checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">';
                }else{
                    return '<input class="togglebtn" value = "on" id="toggle"  data-id="' + full['id'] + '" type="checkbox" name="status"   data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">';

                }

             }
            },
            
             
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
                visible : showAdminColumns
            },
        ],
        "fnDrawCallback": function() {
             

          $('.togglebtn').bootstrapToggle();
        },
         
    });
    
  });
  
</script>

<script>
    
   $(function() {
  
  $('body').delegate('.centerize', 'click', function() {

    var $t = $(this);
    var ID = $t.find("input[data-id]").data('id');
    if($t.children('div.off').length > 0) {
        var status="active";
    }else{
        var status="inactive";
    }
    
    var csrf = "{{ csrf_token() }}";
    $.ajax({
        url: '{{ route("role.changestatusid")}}',
        type: "POST",
        data: { 'id': ID, '_token': csrf,'status':status },
        success: function (response) {
            console.log(response);
        }
    });
     
     
     
     
  });
});
</script>
@stop
{{-- mounted(){
		    
    paging: true,
    searching: true,
    pageLength: 10,


}, --}}