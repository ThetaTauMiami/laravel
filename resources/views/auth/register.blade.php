@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="registration_token" value="{{ $registration_token }}">
                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau of Miami University<br/>Welcome</p>
                        @if ($errors->has('registration_token'))
                        <div class="col-xs-12 has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('registration_token') }}</strong>
                            </span>
                        </div>
                        @endif
                        <div class="form-group{{ ($errors->has('first_name') && $errors->has('last_name')) ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <div class="col-xs-6{{ $errors->has('first_name') ? ' has-error' : '' }}" style="padding:0px;">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-xs-6{{ $errors->has('last_name') ? ' has-error' : '' }}" style="padding:0px;">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>

                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Mobile Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control phone-mask" name="phone" value="{{ old('phone') }}" placeholder="(XXX)XXX-XXXX">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('school_class') ? ' has-error' : '' }}">
                            <label for="school_class" class="col-md-4 control-label">Expected Graduation Year</label>

                            <div class="col-md-6">
                                <input id="school_class" type="text" class="form-control" name="school_class" value="{{ old('school_class') }}" placeholder="Ex. 2014">

                                @if ($errors->has('school_class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                            <label for="major" class="col-md-4 control-label">Major(s)</label>

                            <div class="col-md-6">
                                <input id="major" type="text" class="form-control" name="major" value="{{ old('major') }}" placeholder="Major(s)">

                                @if ($errors->has('major'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('major') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('minor') ? ' has-error' : '' }}">
                            <label for="minor" class="col-md-4 control-label">Minor(s)</label>

                            <div class="col-md-6">
                                <input id="minor" type="text" class="form-control" name="minor" value="{{ old('minor') }}" placeholder="Minor(s)">

                                @if ($errors->has('minor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('minor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
