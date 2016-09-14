

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

								<h1>Welcome/Random Header</h1>

								<p>
								Hello blah blah blah this will be your content that you'll have to decide what goes, it can be images, videos, links, whatever blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome blah blah blah more text stuff cool awesome

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
									<label class="col-md-3 control-label" for="shirt">Shirt Size</label>
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


								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 text-right">
										<button type="submit" class="btn btn-warning btn-lg">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>

					<?php } else { ?>

						<legend>Great Lakes Regional Conference Registration</legend>
								<!-- Name input-->
								<img id="profile-img" class="profile-img-card center-block img-responsive" src="{{ asset('/img/login-logo.png') }}" style="height: 214px; width: 125px;" />

						<h1>Congrats you finished the form or something</h1>

						<p>

						Again up to you to say what you want here, you can add your links to the facebook group, tell them abotu hotels, blah blah blah your text goes here.
						</p>


					<?php } ?>

				</div>


			</div>
		</div>
	</div>

@stop