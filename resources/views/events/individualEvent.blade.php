@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>{{$event->name}}</h1>
    </div>
    <div class="container">
    	<div class="row">
		<div class="col-xs-12">

      <p>Description: {{ $event->description }}</p>

      <p>Type of Points: {{ $event->type_id }}</p>

      <p># of Points: {{ $event->points }}</p>

      <p>Date/Time: {{ $event->date_time }}</p>

      <p>Created By User With ID: {{ $event->user_id }}</p>

      <p>Is Public: {{ $event->is_public }}</p>

      @if($image != NULL)
      <p>Thumbnail: <img src="{{ asset($image->file_path) }}"/></p>
      @endif

      @if($album != NULL)
        <a href="/gallery/{{ $album->id }}"><p>Photo Album</p></a>
      @endif

      <a href="/events/edit/{{$event->id}}"><button class="btn btn-warning" type="button">Edit Event</button></a>
      <a href='/events/{{$event->id}}/attendance'><button class="btn btn-warning" type="button">Take Attendance</button></a>
      <a href="#"><button class="btn btn-warning" type="button">RSVP</button></a>

		</div>
	</div>
    </div>
@stop
