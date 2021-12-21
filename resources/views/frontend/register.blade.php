@extends('frontend.layouts.app') 
@section('content')

<main id="main">
    <section id="" class="registration_section">  
    <div class="container register-form">
        <div class="form">
            @if ($errors->any())
                <div class="alert alert-success">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <li>{{ session('message') }}</li>
                </div>
            @endif
            <div class="note">
                <p class="heading"><b>Registration </b></p>
            </div>
            <form class="form-horizontal" role="form"  method="POST" action="{{ route('createVisitor') }}">
                {!! csrf_field() !!}
            <div class="form-content">
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name *" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                 
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Your Password *" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif 
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control"  placeholder="Your Email *" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                               
                             </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirm Password *" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>
                    
                </div>
                <button type="submit" class="btnSubmit">Submit</button>

            </div>
        </form>
        </div>
    </div>
</section><!-- End About Section -->
@endsection