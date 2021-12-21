<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('frontend.layouts.partials.header')          
    <body>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                     
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown user-menu">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">
                                @if(Auth::guard('visitor')->check())
                                     {{Auth::guard('visitor')->user()->name}}
                                @endif
                             </a> 
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                    <li class="user-footer">
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logoutvisitor-form').submit();" class="btn btn-default btn-flat float-right  btn-block "><i class="fa fa-fw fa-power-off"></i>
                                            Log Out
                                        </a> 
                                        <form id="logoutvisitor-form" action="{{ route('logoutvisitor') }}" method="POST" style="display: none;">
                                            @csrf 
                                        </form>
                                    </li>
                                </ul>
                        </li>
                    </ul>
                </nav>
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
  


