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
                        <p id="profile-name" class="profile-name-card">Theta Tau | Chair Admin Panel</p>

                        <ul>
                            <li><a href="/recruitment/list">Manage Recruitment Email List</a></li>
                            <li><a href="/specialevents/new">Create a New Special Event Registration</a></li>
                            <li><a href="/specialevents">Manage Special Event Registrations</a></li>
                        </ul>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
