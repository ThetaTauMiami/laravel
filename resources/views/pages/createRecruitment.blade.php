@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Create New Event</div>
              <div class="panel-body">
                  <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="/createRecruitmentEvent">
                    <div class="form-group{{ $errors->has('eventName') ? ' has-error' : '' }}">

                      <label for="eventName" class="col-md-4 control-label">Event Name</label>

                      <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('name') }}">
                      </div>

                    </div>

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Event Description</label>
                    <div class="col-md-6">
                      <input id="description" class="form-control" name="description" value="{{ old('description') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Event Location</label>
                    <div class="col-md-6">
                      <input id="location" class="form-control" name="location" value="{{ old('location') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('when') ? ' has-error' : '' }}">
                    <label for="date_time" class="col-md-4 control-label">Date/Time of Event</label>
                    <div class="col-md-6">
                      <input id="when" class="form-control" name="when" value="{{ old('when') }}">

                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                    <label for="note" class="col-md-4 control-label">Event Extra Note</label>
                    <div class="col-md-6">
                      <input id="note" class="form-control" name="note" value="{{ old('note') }}">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="image" class="col-md-4 control-label">Event Image</label>
                    <div class="col-md-6">
                      <input type="file" id="image" name="image" accept="image/*"/>
                    </div>
                  </div>

                  <!--
                  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Location of Event</label>
                    <div class="col-md-6">
                      <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                    <label for="album" class="col-md-4 control-label">Create Photo Album for this Event?</label>
                    <div class="col-md-6">
                      <input id="album" type="checkbox"  name="album" value="Album">
                    </div>
                  </div>



                  <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      							<label for="image" class="col-md-4 control-label">Event Thumbnail</label>
      							<input type="file" id="image" name="image"/>
      						</div>



                  <div class="form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                    <div class="help-tip">
                      <p>Check this if an event can be worth different amounts of points (ex. 1-3 general points depending on how many hours you were at the event)</p>
                    </div>
                    <label for="variable_points" class="col-md-4 control-label">Variable # of Points?</label>
                    <div class="col-md-6">
                      <input id="variable_points" type="checkbox"  name="variable_points" value="Var">
                    </div>
                  </div>

                -->
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Submit
                          </button>
                      </div>
                  </div>
                </form>


                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
