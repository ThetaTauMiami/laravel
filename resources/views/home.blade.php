@extends('layout')

@section('content')

<?php


if(isset($user)) echo '<h1>Welcome '.$user->name.'!</h1>';
else echo '<h1>Welcome, please log in</h1>';

?>

@stop