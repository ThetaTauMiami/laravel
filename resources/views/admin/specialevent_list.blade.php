@extends('layouts.default')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Chair Admin<br/>Manage Special Events</p>

                        @if($events != null && count($events) > 0)

                            <ul>
                        
                            @foreach($events as $event)

                            <li><a href="{{url('/specialevents/'.$event->id)}}">{{$event->name}} - {{date('m/d/Y',strtotime($event->reg_open))}} &rarr; {{date('m/d/Y',strtotime($event->reg_close))}}</a></li>

                            @endforeach

                            </ul>

                        @else

                        <p>No Special Events Created Yet</p>

                        @endif
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
