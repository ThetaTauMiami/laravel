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
                        <p id="profile-name" class="profile-name-card">Theta Tau | Administration</p>

                        @foreach($members as $member)

                        	<div class="row active_">

                        		<div class="col-xs-1"> {{ $member->roll_number }} </div>
                        		<div class="col-xs-4 col-sm-1"><?php if(isset($member->)) ?></div>

                        	</div>

                        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

@end