

@extends('layouts.default')

@section('content')
	
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>FALL 2016 REGIONAL CONFERENCE</h1>
    </div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well well-sm" style="margin-top: 30px">


					@if (count($errors) > 0)
                        <script>
                        $(document).ready(function(){
                            bootbox.alert('<span class="help-block"><ul><?php 
                                foreach ($errors->all() as $message) { ?><li>{{ $message }}</li><?php } ?></ul></span>');
                        });
                        </script>

                    @endif

					<?php if($complete == 0) { ?>

						<form class="form-horizontal" action="" method="post">
						{{ csrf_field() }}
							<fieldset>

								<legend>Great Lakes Regional Conference Registration</legend>
								<!-- Name input-->
								<img id="profile-img" class="profile-img-card center-block img-responsive" src="{{ asset('/img/login-logo.png') }}" style="height: 214px; width: 125px;" />

								<h1>October 22, 2016</h1>

								<p>
								Miami is hosting the Regionals this semester!  Make sure you RSVP online through Facebook as well as this site.  Future updates will be sent through Facebook.  After submitting this form, you will be directed to a page where you can pay for the event.  Your admission includes the price of the t-shirt, so make sure you put the correct t-shirt size.  If you have any questions, please contact rygelsbt@miamioh.edu.
								</p>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Name</label>
									<div class="col-md-9">
										<input id="name" name="name" type="text" placeholder="Your name" class="form-control" value="{{ old('name') }}">
									</div>
								</div>

								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">Your School E-mail</label>
									<div class="col-md-9">
										<input id="email" name="email" type="text" placeholder="Your email" class="form-control" value="{{ old('email') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="shirt">Shirt Size (S,M,L): </label>
									<div class="col-md-9">
										<input id="shirt" name="shirt" type="text" placeholder="Your t-shirt size" class="form-control" value="{{ old('shirt') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="chapter">Your Chapter Name</label>
									<div class="col-md-9">
										<input id="chapter" name="chapter" type="text" placeholder="Ex. Tau Delta" class="form-control" value="{{ old('chapter') }}">
									</div>
								</div>
								
								<div>
									<h2> Payment: </h2>
									<p>
										Before submitting, please pay <b>$42</b> for admission! <a href="http://www.venmo.com/Evan-Fix" target="_blank"><b>HERE!</b></a>  Soft due date by Oct 1st, hard due date Oct 12th.
									</p>
								</div>

								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn btn-warning btn-lg">Complete</button>
									</div>
								</div>
							</fieldset>
						</form>

					<?php } else { ?>

						<legend>Great Lakes Regional Conference</legend>
								<!-- Name input-->
								<img id="profile-img" class="profile-img-card center-block img-responsive" src="{{ asset('/img/login-logo.png') }}" style="height: 214px; width: 125px;" />

						<h1>Important Info: </h1>

						<p>

						If you are traveling from out of town, please contact Baymont Inn & Suites at 513-523-2722.  Oxford hotels are very limited, so schedule early.  If you are calling before Sept. 22, ask for rooms under Regional Conference.  After Sept. 22, rooms become available to the public.  If you are driving, make sure you call Miami for a parking pass.  Phone: 513-529-2224, email: parking@miamioh.edu.  
						</p>
						
						<h2> Can't wait to see you here! </h2>
	
					<?php } ?>

				</div>


			</div>
		</div>
	</div>

@stop
