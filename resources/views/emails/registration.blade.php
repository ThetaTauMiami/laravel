@extends('layouts.email')

@section('content')

<div class="col-xs-12">

	<h2>Registration</h2>

	<p>
		Welcome to {{ $class }} Class of Theta Tau at Miami University. Use the link below to register, or copy and paste the link into a modern browser.
	</p>

	<p>
		<a href="{{ url('register/'.$token) }}">{{ url('register/'.$token) }}</a>
	</p>

</div>

@stop