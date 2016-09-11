@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>EVENTS</h1>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="createEvent">
                    <button class="btn btn-warning" type="button">Create New Event</button>
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div clas="row">
            <table class="table table-striped table-hover table-bordered table-responsive">
                <thead>
                <tr>
                    <th width="175" style="text-align:center">Date</th>
                    <th>Event Details</th>
                    <th>Location</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($events as $event)
                <tr class='clickable-row' data-href='/events/{{ $event->id }}'>
                    <th scope="row" style="text-align:center; vertical-align:middle;">
                      <?php
                        $dt = $event->date_time;
                        $token = strtok($dt, "T");
                        echo $token."<br/>";
                        $token = strtok("T");
                        echo $token;
                      ?>
                    </th>
                    <td><h4>{{ $event->name }}</h4>
                        <hr>
                        <p>{{ $event->description }} </p></td>
                    <td style="vertical-align:middle">{{ $event->location }}</td>
                </tr>
                @endforeach

                <script>
                jQuery(document).ready(function($) {
                    $(".clickable-row").click(function() {
                        window.document.location = $(this).data("href");
                    });
                });
                </script>

                </tbody>
            </table>
        </div>
    </div>
@stop
