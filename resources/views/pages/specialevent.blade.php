

@extends('layouts.default')

@section('content')

@include('includes.errors')
	
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>{{ strtoupper($event->name) }}</h1>
    </div>


	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well well-sm" style="margin-top: 30px">

					<legend>{{$event->name}} Registration</legend>
					<!-- Name input-->
					<img id="profile-img" class="profile-img-card center-block img-responsive" src="{{ asset('/img/login-logo.png') }}" style="height: 214px; width: 125px;" />


					@if (hasRole() || isExecOrAdmin())

						<p>
							<a class="btn btn-default" href="{{url('/specialevents/'.$event->id)}}">Edit Event <i class="fa fa-pencil"></i></a>
							<a class="btn btn-warning" href="{{url('/specialevents/'.$event->id.'/attendees/')}}">Download Registrations <i class="fa fa-download"></i></a>
						</p>

					@endif

					@if (session('status'))
					    <div class="alert alert-success">
					        {{ session('status') }}
					    </div>
					    <p>
					    	Thank you for registering. Please feel free to <a href="{{url('/contact')}}">Contact Us</a> if you need to update your information or have any questions.
					    </p>
					    <hr />
					@endif



				    @if (strtotime($event->reg_open) <= strtotime('now') && strtotime($event->reg_close) > strtotime('yesterday'))

					<form class="form-horizontal" action="{{url('/event/'.$event->id)}}" method="post">
					{{ csrf_field() }}
						<fieldset>

							<p style="margin-bottom: 2.5em;">
								{{$event->description}}
							</p>

							<h2>Register for Event</h2>

							<p style="font-style:italic;">Registration closes {{date("F d, Y", strtotime($event->reg_close))}}</p>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-md-3 control-label" for="name">Name</label>
								<div class="col-md-9">
									<input id="name" name="name" type="text" placeholder="Your name" class="form-control" value="{{ old('name') }}">
									@if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>

							<!-- Email input-->
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="col-md-3 control-label" for="email">Email</label>
								<div class="col-md-9">
									<input id="email" name="email" type="text" placeholder="Your email" class="form-control" value="{{ old('email') }}">
									@if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>

							@if($event->fields != null)

								<?php $i = 0; ?>

								@foreach($event->fields as $field)

								<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
									<label class="col-md-3 control-label" for="field_{{$i}}">{{$field}}</label>
									<div class="col-md-9">
										<input id="field_{{$i++}}" name="{{str_replace(' ','_',$field)}}" type="text" placeholder="{{$field}}" class="form-control" value="{{ old(str_replace(' ','_',$field)) }}">
									</div>
								</div>

								@endforeach

							@endif

							<div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
								<label class="col-md-3 control-label" for="comments">Comments/Notes</label>
								<div class="col-md-9">
									<textarea id="comments" name="comments" type="text" placeholder="Anything extra you want us to know" class="form-control">{{ old('comments') }}</textarea>
									@if ($errors->has('comments'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('comments') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>

							<!-- Form actions -->
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<div class="col-md-12 text-right">
									<button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</button>
								</div>
							</div>
						</fieldset>
					</form>

					@else


					<h1>Registration Closed</h1>

					<p>
						<?php $isEarly = strtotime($event->reg_open) > strtotime('now'); ?>
						Sorry, registration for {{$event->name}} {{ $isEarly ? 'does not open until '.date("F d, Y", strtotime($event->reg_open)) : 'closed on '.date("F d, Y", strtotime($event->reg_close))}}.
					</p>

					<p>Please feel free to <a href="{{ url('/contact')}}">contact us</a> directly if you have any questions.</p>

					@endif

				</div>


			</div>
		</div>
	</div>

@stop
