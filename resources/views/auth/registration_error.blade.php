@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
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
                    <p id="profile-name" class="profile-name-card">Theta Tau of Miami University</p>
                    <div class="col-xs-12">
                        <h1>Page Reached an Error</h1>
                        <p>Sorry, in order to register you must receive a formal bid from the Tau Delta chapter of Theta Tau. If you did receive a bid, please open this page using the link you were emailed. If you did not receive such an email, please contact the Theta Tau exec team.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
