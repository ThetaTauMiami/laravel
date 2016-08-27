@extends('layouts.default')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/new/class') }}">
                    	{{ csrf_field() }}

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Administration<br/>Register New Class</p>
                        @if ($errors->has('general_error'))
                        <div class="col-xs-12 has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('general_error') }}</strong>
                            </span>
                        </div>
                        @endif
                        

                        <div class="form-group{{ $errors->has('chapter_class') ? ' has-error' : '' }}">
                            <label for="chapter_class" class="col-md-4 control-label">Chapter Class Name</label>

                            <div class="col-md-6">
                                <input id="chapter_class" type="text" class="form-control" name="chapter_class" placeholder="Ex. Epsilon" value="{{ old('chapter_class') }}">

                                @if ($errors->has('chapter_class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('chapter_class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="new-brothers-list" class="{{ $errors->has('roll_number') ? 'has-error' : '' }}">

                        	<h3>Add New Brothers <button type="button" class="btn btn-primary" onclick="addMem();">&nbsp;+&nbsp;</button></h3>

                        	<div id="memFieldsHeader" class="hidden-xs">
                        		<div class="row" style="font-weight:bold;text-decoration:underline;">
                        			<div class="col-sm-2">
                        				Roll #
                        			</div>
                        			<div class="col-sm-5">
                        				Email
                        			</div>
                        			<div class="col-sm-4">
                        				Expected Grad Year
                        			</div>
                        		</div>
                        	</div>
                        	
                        	<div id="memFields">

                        	</div>

                        </div>

                        <script type="text/javascript">

                        var i = 0;
                        function addMem(){

                        	// increment the last entry's roll number to avoid repetitive typing
                        	var next = "";
                        	var year = "";
                        	if($('input[name=\'roll_number[]\']').length){
                        		var temp = true;
                        		if(parseInt($('input[name=\'roll_number[]\']').last().val(),10)){
                        			next = parseInt($('input[name=\'roll_number[]\']').last().val(),10)+1;
                        		}else{
                        			bootbox.alert("Enter the first roll number before adding additional fields.");
                        			temp = false;
                        		}

                        		if($('input[name=\'school_class[]\']').first().val()==""){
                        			bootbox.alert("Enter the default grad year in the first entry before creating additional fields.");
                        			temp = false;
                        		}else{
                        			year = $('input[name=\'school_class[]\']').first().val();
                        		}

                        		if(!temp)
                        			return;
                        		
                        	}

                        	var button = "";
                        	if(i>0)
                        		button = '<button type="button" class="btn btn-default" onclick="delMem('+i+');"><i class="fa fa-trash"></i></button>';

                        	$("#memFields").append('<div class="form-group row" id="memField_'+i+'"><div class="col-sm-2 col-xs-10"><input id="rollNum_'+i+'" type="number" class="form-control" name="roll_number[]" placeholder="Roll Number" min="1" value="'+next+'"></div><div class="col-xs-2 visible-xs">'+button+'</div><div class="col-sm-5 col-xs-12"><input id="email_'+i+'" type="email" class="form-control" name="email[]" placeholder="Email Address"></div><div class="col-sm-3 col-xs-12"><input id="schoolClass_'+i+'" type="number" min="2000" max="2999" class="form-control" name="school_class[]" placeholder="Graduation Year" value="'+year+'"></div><div class="col-sm-2 hidden-xs">'+button+'</div></div>');

                        	i++;
                        }

                        function delMem(i){
                        	$("#memField_"+i).remove();
                        }

                        $(document).ready(function(){addMem()});

                        </script>



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
