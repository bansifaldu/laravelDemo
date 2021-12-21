
@extends('frontend.layouts.appdashboard') 
@section('content')
 
    
            @if (Route::has('visitor_login'))
                <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ route('visitor_login') }}" class="btn btn-info">Log in</a>
                    <a href="{{ route('visitor_register') }}"class="btn btn-info">Register</a>
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                 

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                             <h1>Wel-come to laravel training</h1>
                        </div>
                    </div>
                </div>

                 
            </div>
         
@endsection