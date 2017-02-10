@extends('layouts.default')

@section('content')
    <style>
    body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: url('../../img/header.png');
    }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-top: 50px;">
                    <div class="panel-heading">Choose Order</div>
                        <div class="panel-body text-center">
                          <h3>Which order would you like to sort people by?</h3>
                          <a href='/events/{{$event->id}}/attendance/1'>
                            <button class="btn btn-warning" type="button">First Name</button>
                          </a>
                          <a href='/events/{{$event->id}}/attendance/2'>
                            <button class="btn btn-warning" type="button">Roll Number</button>
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
