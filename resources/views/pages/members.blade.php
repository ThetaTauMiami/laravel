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
        <h1>ACTIVES</h1>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <h2 class="section-heading">Our Active Brothers</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>

    <div class="container-fluid">
      <div class="row">
        @foreach ($members as $member)
          <div class="col-lg-4 col-sm-6 text-center">
                @if (isset($member->image->thumb_path))
                <a href="/members/{{$member->id}}">
                  <img class="img-circle img-responsive img-center" src="/{{$member->image->thumb_path}}" alt="" style="width:200; height:200">
                </a>
                @else
                <a href="/members/{{$member->id}}" style="color: #000000; text-decoration: none;">
                    <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
                </a>
                @endif
              <h3>{{$member->first_name}} {{$member->last_name}}
                  <small>Roll #{{$member->roll_number}} | {{$member->chapter_class}} Class</small>
              </h3>
              <p>Class of {{$member->school_class}}</p>
          </div>
        @endforeach
      </div>
    </div>
</div>
@stop
