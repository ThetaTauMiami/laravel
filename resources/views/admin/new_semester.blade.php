@extends('layouts.default')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/new/semester') }}">
                    	{{ csrf_field() }}

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Administration<br/>Start a New Semester</p>
                        <p>
                        This will archive all activity from the semester and start a new one. <b>All roles must be updated after doing this by going to brother management from the admin panel.</b>
                        </p>
                        @if ($errors->has('general_error'))
                        <div class="col-xs-12 has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('general_error') }}</strong>
                            </span>
                        </div>
                        @endif
                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Semester Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Ex. Fall 2030" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('date_start') ? ' has-error' : '' }}">
                            <label for="date_start" class="col-md-4 control-label">Start Date</label>

                            <div class="col-md-6">
                                <input id="date_start" type="date" class="form-control" name="date_start" placeholder="Ex. Fall 2030" value="{{ old('date_start') }}">

                                @if ($errors->has('date_start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-user"></i> Submit
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
