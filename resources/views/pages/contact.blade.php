@extends('layouts.default')

@section('content')
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>CONTACT US</h1>
    </div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				CONTACT INFO HERE
				<div class="well well-sm" style="margin-top: 30px">
					<form class="form-horizontal" action="" method="post">
						<fieldset>

							<legend>Email Us</legend>
							<!-- Name input-->
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
									<button type="submit" class="btn btn-danger btn-lg">Submit</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop