@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Edit Profile - {{$user->first_name}} {{$user->last_name}}</div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="/editProfile/{{ $user->id }}" enctype="multipart/form-data">
                    {{method_field('PATCH')}}

                    <div class="form-group">
                      <label for="email" class="col-md-4 control-label">Email Address</label>
                      <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="phone" class="col-md-4 control-label">Phone Number</label>
                      <div class="col-md-6">
                        <input id="phone" type="tel" class="form-control" name="phone" value="{{$user->phone}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="school_class" class="col-md-4 control-label">School Class</label>
                      <div class="col-md-6">
                        <input id="school_class" type="number"  class="form-control" name="school_class" value="{{$user->school_class}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="major" class="col-md-4 control-label">Major(s)</label>
                      <div class="col-md-6">
                        <input id="major"  class="form-control" name="major" value="{{$user->major}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="minor" class="col-md-4 control-label">Minor(s)</label>
                      <div class="col-md-6">
                        <input id="minor"  class="form-control" name="minor" value="{{$user->minor}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="resume" class="col-md-4 control-label">Resume</label>
                      <div class="col-md-6">
                        <input type="file" id="resume" name="resume" accept="application/pdf"/>
                      </div>
                    </div>

                    <div class="form-group">
        							<label for="image" class="col-md-4 control-label">Profile Picture</label>
                      <div class="col-md-6">
        							  <input type="file" id="image" name="image" accept="image/*"/>
                      </div>
        						</div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <!--<div class="form-group">
                    <label for="active_status" class="col-md-4 control-label">Active user?</label>
                    <div class="col-md-6">
                      <input id="active_status" type="checkbox"  name="active_status" checked="{{$user->active_status}}">
                    </div>
                  </div>-->

                  <!--<div class="form-group">
                    <label for="active_status" class="col-md-4 control-label">Active user</label>

                    <div class="col-md-6">
                      <select id="active_status" class="form-control" name="active_status" default="{{$user->active_status}}">
                        <option value="0" selected>Alumnus</option>
                        <option value="1">Active</option>
                      </select>

                    </div>
                  </div>-->





                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-warning">
                              Submit
                          </button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
