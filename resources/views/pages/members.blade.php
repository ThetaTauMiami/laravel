@extends('layouts.default')
<style>
    body {
        padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }

    .img-center {
        margin: 0 auto;
    }
</style>
@section('content')
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>MEMBERS</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <br>
                <h2 class="section-heading">Our Executive Board</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6 text-center">
                <a href="#">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                <h3>Jimmy D'Amico
                    <small>Roll #69 | Epsilon Class</small>
                </h3>
                <p>Regent</p>
                <p>Mechanical Engineering</p>
                <p>Class of 2018</p>

            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href="#">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                <h3>Jimmy D'Amico
                    <small>Roll #69 | Epsilon Class</small>
                </h3>
                <p>Vice Regent</p>
                <p>Mechanical Engineering</p>
                <p>Class of 2018</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <a href="#">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                <h3>Jimmy D'Amico
                    <small>Roll #69 | Epsilon Class</small>
                </h3>
                <p>Scribe</p>
                <p>Mechanical Engineering</p>
                <p>Class of 2018</p>
            </div>
            <div class="col-sm-6 text-center">
                <a href="#">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                <h3>Jimmy D'Amico
                    <small>Roll #69 | Epsilon Class</small>
                </h3>
                <p>Secretary</p>
                <p>Mechanical Engineering</p>
                <p>Class of 2018</p>
            </div>
            <div class="col-sm-6 text-center">
                <a href="#">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                <h3>Jimmy D'Amico
                    <small>Roll #69 | Epsilon Class</small>
                </h3>
                <p>Treasuer</p>
                <p>Mechanical Engineering</p>
                <p>Class of 2018</p>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <h2 class="section-heading">Our Active Brothers</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>

    <div class="row">
        @foreach ($members as $member)
          <div class="col-lg-4 col-sm-6 text-center">
              <a href="/members/{{$member->id}}" style="color: #000000; text-decoration: none;">
                  <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">

              <h3>{{$member->first_name}} {{$member->last_name}}
                  <small>Roll #{{$member->roll_number}} | {{$member->chapter_class}} Class</small>
              </h3>
              <p>Class of {{$member->school_class}}</p>
              </a>
          </div>
        @endforeach
      </div>
</div>
@stop
