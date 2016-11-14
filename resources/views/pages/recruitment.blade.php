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

<!--

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
                            bootbox.alert("Thanks for Signing up!");
                        });

                    </script>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h1 style="color: #5B0000; text-align: center">The Recruitment Process</h1>
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
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img class="img-responsive center-block" src="{{ asset('/img/desk.jpg') }}">
                </div>
            </div>
            <div class="col-sm-5">
                <h2>Information Sessions</h2>
                <hr>
                <p style="font-size: medium">Information nights allow interested students an opportunity to learn more
                    about our chapter of Theta Tau and the recruitment process, ask questions, formally sign up for
                    recruitment, and meet our brothers. Each semester we offer two information nights, but attendance is
                    only expected and required at one of these. These sessions should last approximately 45 minutes and
                    are casual dress.</p>
                <div class="well well-sm">
                    <p><b style="color: #5B0000">Session 1:</b> 9/20 @ 7:30pm KRG 319</p>
                    <br>
                    <p><b style="color: #5B0000">Session 2:</b> 9/21 @ 7:30pm KRG 319</p>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img class="img-responsive center-block" src="{{ asset('/img/informal.jpg') }}">
                </div>
            </div>
            <div class="col-sm-5">
                <h2>Informal Nights</h2>
                <hr>
                <p style="font-size: medium">The week following information sessions we host 2 “Informal Nights” in
                    which students and brothers are given the opportunity to meet in small groups through “speed dating”
                    sessions. This allows students the opportunity to have personal conversations with active brothers
                    and learn more about what makes our members great. Attendance is strongly recommended at both
                    nights in order to get to know the maximum number of active brothers. These sessions should last two
                    hours and are casual dress.</p>
                <div class="well well-sm">
                    <p><b style="color: #5B0000">Informal Night 1:</b> 9/28 7:30-9:30pm GAR 153</p>
                    <br>
                    <p><b style="color: #5B0000">Informal Night 2:</b> 9/29 7:30-9:30pm GAR 153</p>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">
            <div class="col-sm-offset-1 col-sm-5">
                <div>
                    <img class="img-responsive center-block" src="{{ asset('/img/exec.jpg') }}">
                </div>
            </div>
            <div class="col-sm-5">
                <h2>Formal Interviews</h2>
                <hr>
                <p style="font-size: medium">Following informal nights, students that display a good fit for our chapter
                    will be invited to participate in 2 of 3 nights of formal interviews during which they will discuss
                    their professional experiences, achievements, goals, and their values in more depth with active
                    brothers. Students will be asked to bring several copies of their resume and professional dress is
                    strongly recommended for these events.
                </p>
                <div class="well well-sm">
                    <p><b style="color: #5B0000">By Invitation Only</b></p>
                </div>
            </div>
        </div>
    </div>
    -->

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


    <br>

    <div class="container" style="text-align: center;">
        <div class="row">
            <h1 style="color: #5B0000; text-align: center">Contact Us</h1>
            <hr>
            <p style="font-size: medium">Feel free to reach out with any questions or concerns at <a href="mailto:thetataurecruitmentmu@gmail.com">thetataurecruitmentmu@gmail.com</a> </p>
        </div>
    </div>

@stop
