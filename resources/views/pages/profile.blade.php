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
        <div class="jumbotron"
              style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
            <h1>{{$user->first_name}} {{$user->last_name}}</h1>
        </div>
        <div class="container">
            <div class="row">
                <br>
                <div class="col-sm-offset-2 col-sm-4">
                  @if(isset($image))
                    <a href="/{{$image->file_path}}">
                        <img class="img-circle img-responsive img-center" src="/{{$image->thumb_path}}" alt="{{$image->thumb_path}}">
                    </a>
                  @else
                    <a href="/members/{{$user->id}}">
                        <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="{{$user->first_name}} {{$user->last_name}}">
                    </a>
                  @endif
                </div>
                <div class="col-sm-4">
                    <h3>{{$user->first_name}} {{$user->last_name}}
                        <br><small>Roll #{{$user->roll_number}} | {{$user->chapter_class}} Class</small>
                    </h3>
                    <p>Class of {{$user->school_class}}</p>
                    @if (Auth::check())
                        <b>Phone Number: </b>{{$user->phone}} <br> <b>Email: </b>{{$user->email}}
                    @endif
                    @if ($user->resume_path!=null)
                        <a href="#">Resume</a>
                    @endif
                    <br>
                    <br>
                    @if (Auth::id()==$user->id)
                        <a href="/editProfile/{{$user->id}}">
                            <button>Edit Profile</button>
                        </a>
                        <a href="/members/{{$user->id}}/attendance">
                            <button>View Attendance</button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="jumbotron"
             style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
            <h1>Member not found</h1>
        </div>
    @endif
