@extends('layouts.default')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/specialevents/new') }}">
                    	{{ csrf_field() }}

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Chair Admin<br/>Create New Special Event</p>
                        @if ($errors->has('general_error'))
                        <div class="col-xs-12 has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('general_error') }}</strong>
                            </span>
                        </div>
                        @endif
                        
                        @include('includes.errors')
                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Event Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="The name of the event" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Event Description
                            </label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" placeholder="Include date, time, location, etc.">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug" class="col-md-4 control-label">Event URL Ending</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control" name="slug" placeholder="The url for the event registration" value="{{ old('slug') }}">

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @else
                                    <span>
                                        For example: thetataumiami.com/<strong><u>my-cool-event</u></strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reg_open') || $errors->has('reg_close') ? ' has-error' : '' }}">
                            <label for="reg_open" class="col-md-2 control-label">Registration Opens</label>

                            <div class="col-md-4">
                                <input id="reg_open" type="date" class="form-control" name="reg_open" placeholder="The name of the event" value="{{ old('reg_open') }}">

                                @if ($errors->has('reg_open'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_open') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="reg_close" class="col-md-2 control-label">Registration Closes</label>

                            <div class="col-md-4">
                                <input id="reg_close" type="date" class="form-control" name="reg_close" placeholder="The name of the event" value="{{ old('reg_close') }}">

                                @if ($errors->has('reg_close'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_close') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="new-brothers-list" class="{{ $errors->has('roll_number') ? 'has-error' : '' }}">

                        	<h3>Registration Fields <button type="button" class="btn btn-primary" onclick="addMem();">&nbsp;Add Field +&nbsp;</button></h3>

                            <p>
                                <strong>*Do not include name or email.*</strong> These fields will be gathered by default.
                            </p>
                            <p>
                                Add custom fields you want people to fill out when registering. For example: tshirt size, allergies, favorite sea animal, etc.
                            </p>
                        	
                        	<div id="fields">

                        	</div>

                        </div>

                        <script type="text/javascript">

                        var i = 0;
                        function addMem(){

                        	var button = "";
                        	// if(i>0)
                        		button = '<button type="button" class="btn btn-default" onclick="delMem('+i+');"><i class="fa fa-trash"></i></button>';

                        	$("#fields").append('<div class="form-group row" id="field_'+i+'"><div class="col-sm-6 col-xs-7"><input id="field_input_'+i+'" type="text" class="form-control" name="fields[]" placeholder="Field Name"></div><div class="col-xs-3 ">'+button+'</div></div>');

                            if(i>0)
                                $("#field_input_"+i).focus();

                        	i++;

                        }

                        function delMem(i){
                        	$("#field_"+i).remove();
                        }

                        // $(document).ready(function(){addMem()});

                        </script>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-pencil-square-o"></i> Create Event
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
