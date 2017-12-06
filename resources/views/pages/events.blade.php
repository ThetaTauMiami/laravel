@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>EVENTS</h1>
    </div>
    <br>
    @if(hasRole())
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="createEvent">
                    <button class="btn btn-warning" type="button">Create New Event</button>
                </a>
            </div>
        </div>
    </div>
    @endif
    <br>
    <div class="container">
      <!--<table class="table table-responsive">
        <thead>
          <tr>
            <th style="text-align: center">Sunday</th>
            <th style="text-align: center">Monday</th>
            <th style="text-align: center">Tuesday</th>
            <th style="text-align: center">Wednesday</th>
            <th style="text-align: center">Thursday</th>
            <th style="text-align: center">Friday</th>
            <th style="text-align: center">Saturday</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div style="background-color: red"> EVENT </div>
              <div style="background-color: blue"> EVENT </div>
            </td>
            <td>
              <div style="background-color: green"> EVENT </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>-->
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

                <?php if($event->is_public || Auth::check()) {  // mdepero: Don't want to just "hide" non-public events, don't even print them ?>

                <tr class='clickable-row' data-href='/events/{{ $event->id }}' >

                    <th scope="row" style="text-align:center; vertical-align:middle;">
                      <?php
                        $dt = $event->date_time;
                        $token = strtok($dt, "T");
                        echo $token."<br/>";
                        $token = strtok("T");
                        echo $token;
                      ?>
                    </th>
                    <td><a href="/events/{{ $event->id }}" style="color: #5B0000"><h4>{{ $event->name }}</h4></a>
                        <hr>
                        <p>{{ $event->description }} </p></td>
                    <td style="vertical-align:middle">{{ $event->location }}</td>
                </tr>

                <?php } ?>

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
