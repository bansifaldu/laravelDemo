
@extends('adminlte::page')

@section('title', 'Blogs Management')

@section('content_header')
   <!--  <h1 class="m-0 text-dark">{{ __('adminlte::adminlte.blog_management') }}</h1> -->
   <h1 class="m-0 text-dark">{{ $translate_lang->translate('Blog Management') }}</h1>
@stop

@section('content')
     <a href="{{ route('blogs.create_blogs') }}"><button   class="btn btn-info" type="button">Create Blog</button></a>
     @if (session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif 
 
<div class="container mt-5">
    {{ $translate_lang->translate($restview) }}<br>
	{{ $restview }}
	 <br>
	 
 @include('view_comoser')

    <bloglist-component></bloglist-component>

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
