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


                @foreach ($events as $event)

                    <div>
                        <a href="/events/{{ $event->id }}">{{ $event->name }}</a>
                    </div>

                @endforeach

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
                <tr>
                    <th scope="row" style="text-align:center; vertical-align:middle;">September 5<br>Monday<br>2:16pm</th>
                    <td><h4>Death by Code</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin tempus vehicula.
                            Suspendisse fermentum cursus nunc semper tincidunt. Cum sociis natoque penatibus et magnis
                            dis parturient montes, nascetur ridiculus mus. Vivamus quam nunc, molestie sit amet euismod
                            et, posuere sed urna. Cras fringilla finibus ante, vitae maximus turpis placerat id. Etiam
                            dapibus ligula a ante suscipit pellentesque. </p></td>
                    <td style="vertical-align:middle">Benton Hell, Room 17</td>
                </tr>
                <tr>
                    <th scope="row" style="text-align:center; vertical-align:middle;">September 6<br>Tuesday<br>4:00pm</th>
                    <td><h4>Various Activities</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin tempus vehicula.
                            Suspendisse fermentum cursus nunc semper tincidunt. Cum sociis natoque penatibus et magnis
                            dis parturient montes, nascetur ridiculus mus. Vivamus quam nunc, molestie sit amet euismod
                            et, posuere sed urna. Cras fringilla finibus ante, vitae maximus turpis placerat id. Etiam
                            dapibus ligula a ante suscipit pellentesque. </p></td>
                    <td style="vertical-align:middle">In a Back Alley</td>
                </tr>
                <tr>
                    <th scope="row" style="text-align:center; vertical-align:middle;">October 31<br>Monday<br>6:66pm</th>
                    <td><h4>Death by Git Commits</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin tempus vehicula.
                            Suspendisse fermentum cursus nunc semper tincidunt. Cum sociis natoque penatibus et magnis
                            dis parturient montes, nascetur ridiculus mus. Vivamus quam nunc, molestie sit amet euismod
                            et, posuere sed urna. Cras fringilla finibus ante, vitae maximus turpis placerat id. Etiam
                            dapibus ligula a ante suscipit pellentesque. </p></td>
                    <td style="vertical-align:middle">Benton Hell, Room 17</td>
                </tr><tr>
                    <th scope="row" style="text-align:center; vertical-align:middle;">December 5<br>Monday<br>8:09am</th>
                    <td><h4>Celebration for No Reason</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin tempus vehicula.
                            Suspendisse fermentum cursus nunc semper tincidunt. Cum sociis natoque penatibus et magnis
                            dis parturient montes, nascetur ridiculus mus. Vivamus quam nunc, molestie sit amet euismod
                            et, posuere sed urna. Cras fringilla finibus ante, vitae maximus turpis placerat id. Etiam
                            dapibus ligula a ante suscipit pellentesque. </p></td>
                    <td style="vertical-align:middle">Brick Street Bar and Grill</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
