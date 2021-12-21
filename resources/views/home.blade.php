@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                     {{-- {{ Auth::user()->id }} --}}
                    
                <div class="card-body">
                    @can('admin')
                            <p class="mb-0">You are admin!</p>
                    {{-- @else
                    <p class="mb-0">You are logged innnnnn!</p> --}}
                    @endcan

                    @can('customer')
                        <p class="mb-0">You are customer!</p>
                    @endcan
                    @can('user')
                        <p class="mb-0">You are user!</p>
                    @endcan
                </div>
               
                 
            </div>
        </div>
    </div>
@stop


@section("footer")
Ritesh Khatri
@stop