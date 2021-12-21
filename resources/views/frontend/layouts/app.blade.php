<!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('frontend.layouts.partials.header')  

<body>

    <!-- ======= Header ======= -->

    <header id="header" class="{{ (Request::is('/')) ? "fixed-top" : ""}}  d-flex align-items-center {{ (Request::is('/')) ? "header-transparent" : ""}}">
      <div class="container d-flex align-items-center justify-content-between">
  
        <div class="logo">
          @if(Auth::guard('visitor')->check())
            <h1><a href="{{ route('visitordashboard') }}">Selecao</a></h1>
          @else
            <h1><a href="{{ route('userwelcome') }}">Selecao</a></h1>

          @endif
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
  
        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto {{ (Request::is('/')) ? "active" : ""}}" href="{{ route('userwelcome') }} ">Home</a></li>
            <li><a class="nav-link scrollto" href="{{ route('userwelcome') }}#about">About</a></li>
            <li><a class="nav-link scrollto" href="{{ route('userwelcome') }}#services"  >Services</a></li>
            <li><a class="nav-link scrollto " href="{{ route('userwelcome') }}#portfolio"  >Portfolio</a></li>
            <li><a class="nav-link scrollto" href="{{ route('userwelcome') }}#pricing" >Pricing</a></li>
            <li><a class="nav-link scrollto" href="{{ route('userwelcome') }}#team"  >Team</a></li>
            <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                  <ul>
                    <li><a href="#">Deep Drop Down 1</a></li>
                    <li><a href="#">Deep Drop Down 2</a></li>
                    <li><a href="#">Deep Drop Down 3</a></li>
                    <li><a href="#">Deep Drop Down 4</a></li>
                    <li><a href="#">Deep Drop Down 5</a></li>
                  </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
              </ul>
            </li>
            <li><a class="nav-link scrollto" href="{{ route('userwelcome') }}#contact"  >Contact</a></li>
            
            @if(Auth::guard('visitor')->check())
              <li  class="dropdown">
                <a href="#">
                  <span> 
                       Hii {{ ucfirst(Auth::guard('visitor')->user()->name) }}
                  
                  </span> <i class="bi bi-chevron-down"></i></a>
                  
                    <ul>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutvisitor-form').submit();">Log Out</a> 
                            <form id="logoutvisitor-form" action="{{ route('logoutvisitor') }}" method="POST" style="display: none;">
                                @csrf 
                            </form>
                        </li>
                    </ul>
              </li>
            @else
              <li><a href="{{ route('visitor_register') }}" class="nav-link scrollto {{ (Request::is('visitor_register')) ? "active" : ""}}"  >Register</a></li>
              <li><a href="{{ route('visitor_login') }}" class="nav-link scrollto {{ (Request::is('visitor_login')) ? "active" : ""}}" >Login</a></li>
            @endif
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
  
      </div>
    </header>
         @yield('content')
     @include('frontend.layouts.partials.footer') 
     
    </body>


</html>
  


