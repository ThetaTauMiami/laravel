@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>CURRENT RUSH INFO</h1>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="well well-sm">
                    <img src="https://scontent-lga3-1.xx.fbcdn.net/v/t1.0-9/13103548_629859100498663_8067044036751974394_n.jpg?oh=09f68fd282963cd82d6fb79e1a4da862&oe=58560E71"
                         height="288" width="288">
                    <h1>Click the button below to sign up for our recruitment email list!</h1>
                    <hr>

                    <p>Signing up for our email list will allow for you to receive updates regarding the most current
                        recruitment information. In addition, check back on this page in the future to see more
                        information once we make it available. </p>
                    <br>
                    <a href="/recruitment/signup">
                        <button class="btn btn-warning" type="button">Sign up for Our Email List!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

		@if($complete == 1)
			<script>
				$(document).ready(function(){
					bootbox.alert("Thanks for Signing up!");
				});

			</script>
		@endif

    </div>


@stop
