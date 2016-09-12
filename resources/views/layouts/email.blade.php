<!doctype html>
<html>
<head>


</head>
<body style="background-color: #5B0000; padding-left:10px;padding-right:10px;text-align:center;">

	<div style="width:400px;display:inline-block;background-color:#FFFFFF">

		<div style="text-align:center;">
			<img src="{{ $message->embed('img/login-logo.png') }}" style="width: 150px;max-width:100%;">
			<h1>Theta Tau</h1>
			<h3>Miami University</h3>
		</div>
		<br/>
		<p style="text-align:left;">

		@yield("content")

		</p>

	</div>


</body>
</html>