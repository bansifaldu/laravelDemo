@extends('frontend.layouts.app') 
@section('content')
 
<main id="main">   
    <section id="" class="login_section">   
        <div class="container register-form">
            <div class="form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="note">
                    <p class="heading"><b>Login</b> </p>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('visitorLogin') }}">
                    {{ csrf_field() }}
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                             </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password *" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                            </div>
                        </div>
                         
                    </div>
                    <button type="submit" class="btnSubmit">Submit</button>
                </div>
            </form>
            </div>
        </div>
        {{-- <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('visitorLogin') }}">
                                {{ csrf_field() }}
                                

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">E-Mail Address</label>


                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Password</label>


                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i>Login
                                        </button>
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
</main>         
@endsection