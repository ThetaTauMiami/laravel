@extends('layouts.default')
<style>
	body {
		padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
	}

	.img-center {
		margin: 0 auto;
	}
</style>
@section('content')

	<div class="jumbotron" style=
	"background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
		<h1>ALUMNI</h1>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<br>
				<h2 class="section-heading">Our Alumni Brothers</h2>
				<hr class="primary">
			</div>
		</div>
	</div>

	<div class="container">
	<div class="row">
		@foreach ($alumni as $alum)
			<div class="col-lg-4 col-sm-6 text-center">
					<a href="/members/{{$alum->id}}">
							<img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
					</a>
					<h3>{{$alum->first_name}} {{$alum->last_name}}
							<small>{{$alum->roll_number}} | {{$alum->chapter_class}}</small>
					</h3>
					<p>{{$alum->school_class}}</p>
			</div>
		@endforeach
	</div>
	</div>
@stop
