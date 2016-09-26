@extends('layouts.email')

@section('content')

<div class="col-xs-12">

	<h2>Hi {{$name}}!</h2>

	<p>
		Thank you for your message. Our exec team will be reaching out soon.
	</p>

	<p>
		Sincerely,
	</p>

	<p>
		Executive Team<br />
		Theta Tau | Tau Delta Chapter | Miami University
	</p>

</div>

@stop