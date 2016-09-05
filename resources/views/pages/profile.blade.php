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
  @if ($user)
  <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>{{$user->first_name}} {{$user->last_name}}</h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-lg-4 col-sm-6 text-center">
          @if($image != null)
            <a href="/members/{{$user->id}}">
                <img class="img-circle img-responsive img-center" src="{{$image->thumb_path}}" alt="{{$user->first_name}} {{$user->last_name}}">
            </a>
            @else
            <a href="/members/{{$user->id}}">
                <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="{{$user->first_name}} {{$user->last_name}}">
            </a>
          @endif

            <h3>{{$user->first_name}} {{$user->last_name}}
                <small>{{$user->roll_number}} | {{$user->chapter_class}}</small>
            </h3>
            @if (Auth::check())
            <small>{{$user->phone}} | {{$user->email}}</small>
            @endif
            @if ($user->resume_path!=null)
            <small><a href="#">Resume</a></small>
            @endif
            <p>{{$user->school_class}}</p>
            @if (Auth::id()==$user->id)
            <a href="/editProfile/{{$user->id}}"><button>Edit Profile</button></a>
            @endif
        </div>
      </div>
    </div>
    @else
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
          <h1>Member not found</h1>
    </div>
    @endif
