<!doctype html>
<html>
<head>
<link  href="{{ $message->embed('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">


<style>

body{
	background-color: #5B0000;
}
.container{
	background-color: #FFFFFF;
}

</style>

</head>
<body>

<div class="container">

	<div class="row">

		<div class="col-xs-12 col-sm-8 col-md-4 col-lg-3">
			<img src="{{ $message->embed('img/login-logo.png') }}">
		</div>
		<div class="col-md-8">
			<h1>Theta Tau</h1>
			<h3>Miami University</h3>
		</div>

	</div>

	<div class="row">

	@yield("content")

	</div>


</div>

</body>
</html>