@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-xs-12">

<?php


if(isset($user)){

	echo '<h1>Welcome '.$user->name.'!</h1>';
	if($user->linkedin_token != ''){
		echo 'You are authenticated with linked in';
	}
} 
else {

	echo '<h1>Welcome, please log in</h1>';
}

?>

	</div>
</div>

@stop