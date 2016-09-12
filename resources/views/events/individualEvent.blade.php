@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>{{$event->name}}</h1>
    </div>
    <div class="container">
        <div class="row">
            <br>
            <div class="col-sm-offset-2 col-sm-4">
            @if($image != NULL)
                <img src="{{ asset($image->file_path) }}" style="padding: 10px;"/>
            @else
                <img src="http://placehold.it/200x200" style="padding: 10px;">
            @endif
            </div>
            <div class="col-sm-4">
            <p><b>Description:</b> {{ $event->description }}</p>

            <p><b>Type of Points:</b> {{ $event->type_id }}</p>

            <p><b># of Points:</b> {{ $event->points }}</p>

            <p><b>Date/Time:</b> {{ $event->date_time }}</p>

            @if($album != NULL)
                <a href="/gallery/{{ $album->id }}"><p>Photo Album</p></a>
            @endif

            <a href="/events/edit/{{$event->id}}">
                <button class="btn btn-warning" type="button">Edit Event</button>
            </a>
            <a href='/events/{{$event->id}}/attendance'>
                <button class="btn btn-warning" type="button">Take Attendance</button>
            </a>
            </div>

        </div>
    </div>
@stop
