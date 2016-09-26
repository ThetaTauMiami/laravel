@extends('layouts.email')

@section('content')

<div class="col-xs-12">

	<h2>Contact Form Message</h2>

	<p>
		{{$name}} (<a href="mailto:{{$email}}">{{$email}}</a>) sent the following message...
	</p>

	<h3>{{$subject}}</h3>

	<p>
	{{$message_body}}
	</p>

</div>

@stop