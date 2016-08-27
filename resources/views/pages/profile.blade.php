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
  @if ($member)
  <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>{{$member->first_name}} {{$member->last_name}}</h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-6 text-center">
            <a href="#">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
            </a>
            <h3>{{$member->first_name}} {{$member->last_name}}
                <small>{{$member->roll_number}} | {{$member->chapter_class}}</small>
            </h3>
            @if (Auth::check())
            <small>{{$member->phone}} | {{$member->email}}</small>
            @endif
            @if ($member->resume_path!=null)
            <small><a href="#">Resume</a></small>
            @endif
            <p>{{$member->school_class}}</p>
            @if (Auth::id()==$member->id)
            <a href="/editProfile/{{$member->id}}"><button>Edit Profile</button></a>
            @endif
        </div>
      </div>
    </div>
    @else
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
          <h1>Member not found</h1>
    </div>
    @endif
