@extends('layouts.default')

@section('content')

	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>CONTACT US</h1>
    </div>
<br>
	<div class="container">
		<div class="row" style="text-align: center">
			<a href="https://www.facebook.com/ThetaTauMU/" target="_blank"><i id="social" class="fa fa-facebook-official fa-5x" aria-hidden="true">&nbsp;&nbsp; </i></a>
			<a href="https://twitter.com/theta_tau" target="_blank"><i id="social" class="fa fa-twitter fa-5x" aria-hidden="true">&nbsp;&nbsp;</i></a>
			<a href="https://www.instagram.com/thetataumu/?hl=en" target="_blank"><i id="social" class="fa fa-instagram fa-5x" aria-hidden="true">&nbsp;&nbsp;</i></a>
			<a href="https://www.linkedin.com/groups/41242/profile" target="_blank"><i id="social" class="fa fa-linkedin fa-5x" aria-hidden="true"></i></a>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="well well-sm" style="margin-top: 30px">

					<form class="form-horizontal" action="" method="post">
					{{ csrf_field() }}
						<fieldset>

							<legend>Email Us</legend>
							<!-- Name input-->
							<img id="profile-img" class="profile-img-card center-block img-responsive" src="{{ asset('/img/login-logo.png') }}" style="height: 214px; width: 125px;" />
							<div class="form-group">
								<label class="col-md-3 control-label" for="name">Name</label>
								<div class="col-md-9">
									<input id="name" name="name" type="text" placeholder="Your name" class="form-control">
								</div>
							</div>

							<!-- Email input-->
							<div class="form-group">
								<label class="col-md-3 control-label" for="email">Your E-mail</label>
								<div class="col-md-9">
									<input id="email" name="email" type="text" placeholder="Your email" class="form-control">
								</div>
							</div>

							<!-- Message body -->
							<div class="form-group">
								<label class="col-md-3 control-label" for="message">Your message</label>
								<div class="col-md-9">
									<textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
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

				</div>


			</div>
		</div>
	</div>
@stop