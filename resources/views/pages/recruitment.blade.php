@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>CURRENT RUSH INFO</h1>
    </div>
    <br>
    <!--
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
        -->



    <div class="container">
        <div class="row">
            <h1 style="color: #5B0000; text-align: center">Ready to Join Our Brotherhood?</h1>
            <hr>
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img class="img-responsive center-block" src="{{ asset('/img/fraternity-full.jpg') }}">
                </div>
            </div>
            <div class="col-sm-5">
                <p style="font-size: medium">Theta Tau conducts recruitment at the beginning of each semester. Our
                    recruitment process consists of
                    events that allow our chapter to evaluate candidates on their values, credentials, and overall fit
                    in our brotherhood. These events include Information Sessions, Informal Nights, and Formal
                    Interviews.</p>
                <br>
                <p style="font-size: medium">For more information, read all of the information below and click this sign up button!</p>

                <a href="/recruitment/signup">
                    <button class="btn btn-warning" type="button">Sign up for Our Email List!</button>
                </a>



                @if($complete == 1)
                    <script>
                        $(document).ready(function(){
                            bootbox.alert("<h1>Thank you for signing up!</h1><p>You'll now get emails related to our recruitment this semester! If you have any questions, feel free to reach out directly at <a href='mailto:thetataurecruitmentmu@gmail.com'>thetataurecruitmentmu@gmail.com</a>.</p><p><a class='btn btn-warning' href='/recruitment/signup'>Add Another?</a></p>");
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h1 style="color: #5B0000; text-align: center">The Recruitment Process</h1>

			<!-- THE FOLLOWING IS RANDOM RECRUITMENT EVENTS FOR PNMs
            <hr>
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img style="height: 350px" class="img-responsive center-block"
                         src="{{ asset('/img/icecream.jpg') }}">
                </div>
            </div>

            <div class="col-sm-5">
                <h2>Open Events</h2>
                <hr>
                <p style="font-size: medium">Theta Tau conducts recruitment at the beginning of each semester. Our
                    recruitment process consists of
                    events that allow our chapter to evaluate candidates on their values, credentials, and overall fit
                    in our brotherhood. These events include Information Sessions, Informal Nights, and Formal
                    Interviews.</p>
                <div class="well well-sm">
                    <p><b style="color: #5B0000">CEC Trivia Night:</b> 9/1 @ 7pm EGB 270</p>
                    <br>
                    <p><b style="color: #5B0000">Public Speaking Workshop:</b> 9/8 6pm EGB 270</p>
                    <br>
                    <p><b style="color: #5B0000">Kickball & Chipotle:</b> 9/13 @ 4pm Millet Front Lawn</p>

                </div>
            </div>
        </div>
		-->
    @foreach ($recruitment_events as $event)
    <hr>
    <br>
    <div class="row">
        <div class="col-sm-offset-1 col-sm-5">
            <div>
                @if(isset($event->image_id))

                <img class="img-responsive center-block" src="{{$event->image->thumb_path}}">
                <?php //var_dump($event->image_id)?>
                @else

                <!--<img class="img-responsive center-block" src="{{ asset('/img/informal.jpg') }}">-->
                @endif
            </div>
        </div>
        <div class="col-sm-5">
            <h2>{{$event->title}}</h2>
            <hr>
            <p style="font-size: medium">{{$event->description}}</p>
            @if($event->location || $event->note || $event->when)
            <div class="well well-sm">
              @if($event->location)
                <p><b style="color: #5B0000">Where: </b>{{$event->location}}</p>
                <br>
              @endif
              @if($event->when)
                <p><b style="color: #5B0000">When: </b>{{$event->when}}</p>
                <br>
              @endif
              @if($event->note)
                <p><b style="color: #5B0000">Additional information: </b>{{$event->note}}</p>
              @endif
            </div>
            @endif
        </div>
    </div>
    @if(isExecOrAdmin())
      <a href="/editRecruitmentEvent/{{$event->id}}">
          <button class ="btn btn-warning" type ="button" style="float:right">Edit Event</button>
      </a>
    @endif
    @endforeach



	<!-- USE THE FOLLOWING WHEN NO RUSH IS SCHEDULED YOU LIL BITCH
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img class="img-responsive center-block" src="{{ asset('/img/exec.jpg') }}">
                </div>
            </div>
            <div class="col-sm-5">
                <h2>Check Back Next Semester!</h2>
                <hr>
                <p style="font-size: medium">We rush at the beginning of every semester. If you are interested in joining our brotherhood, please check back early next semester for more information. You are also welcome to reach out to our recruitment team using the email below if you would like more information or would like to ensure your name be included in our mailing list for next semester's rush.
                </p>
            </div>
        </div>
    </div>
	-->

    <br><br><br><br>
    <div class ="container" style="text-align: center;">
      <a href="createRecruitmentEvent">
          <button class ="btn btn-warning" type ="button" style="float:center">Add Event</button>
      </a>
    </div>
    <div class="container" style="text-align: center;">
        <div class="row">
            <h1 style="color: #5B0000; text-align: center">Contact Us</h1>
            <hr>
            <p style="font-size: medium">Feel free to reach out with any questions or concerns at <a href="mailto:thetataurecruitmentmu@gmail.com">thetataurecruitmentmu@gmail.com</a> </p>
        </div>
    </div>

@stop
