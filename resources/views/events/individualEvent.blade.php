@extends('layouts.default')

@section('content')
    <style>
    body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: url('../img/header.png');
    }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">Event Information</div>
                    <div class="panel-body">
                        <br>
                        <div class="col-sm-offset-2 col-sm-4">
                            @if($image != NULL)
                                <img src="{{ asset($image->file_path) }}" style="padding: 10px;"/>
                            @else
                                <img src="http://placehold.it/200x200" style="padding: 10px;">
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <p><b>Event:</b> {{ $event->name }}</p>
                            <p><b>Description:</b> {{ $event->description }}</p>

                            <?php if(Auth::check()) { // mdepero: only show attendance point info if user is logged in ?>

                            <p><b>Type of Points:</b> {{ $event->type_id }}</p>

                            <p><b># of Points:</b> {{ $event->points }}</p>

                            <?php } ?>

                            <p><b>Date:</b> <?php
                                $dt = $event->date_time;
                                $token = strtok($dt, "T");
                                echo $token."<br><b>Time:</b> ";
                                $token = strtok("T");
                                echo $token;
                                ?></p>

                            @if($album != NULL)
                                <a href="/gallery/{{ $album->id }}"><p>Click Here to View the Photo Album</p></a>
                            @endif

                            @if(hasRole())
                            <a href="/events/edit/{{$event->id}}">
                                <button class="btn btn-warning" type="button">Edit Event</button>
                            </a>

                            <a href='/events/{{$event->id}}/order'>
                                <button class="btn btn-warning" type="button">Take Attendance</button>
                            </a>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
