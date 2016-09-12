<!doctype html>
<html>
<head>


</head>
<body style="background-color: #5B0000; padding-left:10px;padding-right:10px;">

	<span style="background-color:#FFFFFF">

	<div style="text-align:center;display:inline-block;">
		<img src="{{ $message->embed('img/login-logo.png') }}" style="width: 300px;max-width:100%;">
		<h1>Theta Tau</h1>
		<h3>Miami University</h3>
	</div>
	<br/>
	<p style="display:inline-block;">

	@yield("content")

	</p>

	</span>


</body>
</html>