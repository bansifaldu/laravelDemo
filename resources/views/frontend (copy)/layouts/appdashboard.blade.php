<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('frontend.layouts.partials.header')          
    <body>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                
            </div>
        </header>
        <div class="main"> 
            <main class="py-4">
                <div id="app">
                    @yield('content')
                </div>
            </main>
        </div>
        @include('frontend.layouts.partials.footer') 
    </body>


</html>
  


