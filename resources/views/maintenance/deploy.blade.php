<!DOCTYPE html>
<html>
<head>
<title>Laravel Deployment</title>
</head>
<body>

@servers(['localhost' => '127.0.0.1']);

@task('deploy', ['on' => 'localhost'])

	ls
	mkdir testfolder

@endtask

</body>
</html>