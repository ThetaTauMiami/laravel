@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12">

<?php


if(isset($user)) echo '<h1>Welcome '.$user->name.'!</h1>';
else echo '<h1>Welcome, please log in</h1>';

?>

	</div>
</div>

@stop