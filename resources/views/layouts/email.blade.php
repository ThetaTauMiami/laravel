<!doctype html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


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

	@yield("content");

	</div>


</div>

</body>
</html>