@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Create New Event</div>
              <div class="panel-body">
                  <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="/events/edit/{{ $event->id }}">
                    {{method_field('PATCH')}}

                    <div class="form-group{{ $errors->has('eventName') ? ' has-error' : '' }}">
                      <label for="eventName" class="col-md-4 control-label">Event Name</label>

                      <div class="col-md-6">
                        <input id="eventName" type="text" class="form-control" name="eventName" value="{{$event->name}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="pointType" class="col-md-4 control-label">Type of Points</label>

                      <div class="col-md-6">
                        <select id="pointType" class="form-control" name="pointType">
                          <option value="General" @if($event->type_id == "General") selected @endif>General</option>
                          <option value="PD" @if($event->type_id == "PD") selected @endif>PD</option>
                          <option value="Brotherhood" @if($event->type_id == "Brotherhood") selected @endif>Brotherhood</option>
                          <option value="Service" @if($event->type_id == "Service") selected @endif>Service</option>
                        </select>

                      </div>
                    </div>

                    <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                      <label for="points" class="col-md-4 control-label">Number of Points</label>
                      <div class="col-md-6">
                        <input id="points" type="number" max="4" min="0" class="form-control" name="points" value="{{ $event->points }}">

                      </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                  <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    <label for="date" class="col-md-4 control-label">Date/Time of Event</label>
                    <div class="col-md-6">
                      <input id="date" type="datetime-local" class="form-control" name="date" value="{{ $event->date_time }}">

                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Location of Event</label>
                    <div class="col-md-6">
                      <input id="location" type="text" class="form-control" name="location" value="{{ $event->location }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                    <label for="album" class="col-md-4 control-label">Create Photo Album for this Event?</label>
                    <div class="col-md-6">
                      <input id="album" type="checkbox"  name="album" value="Album" @if($album!=null) checked @endif>
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>
                    <div class="col-md-6">
                      <input id="description" type="text" class="form-control" name="description" value="{{ $event->description }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      							<label for="image" class="col-md-4 control-label">Event Thumbnail</label>
      							<input type="file" id="image" name="image"/>
      						</div>

                  <div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
                    <label for="is_public" class="col-md-4 control-label">Is This Event Public?</label>
                    <div class="col-md-6">
                      <input id="is_public" type="checkbox"  name="is_public" value="Public" @if($event->is_public) checked @endif>
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('variable_points') ? ' has-error' : '' }}">
                    <label for="variable_points" class="col-md-4 control-label">Variable # of Points?</label>
                    <div class="col-md-6">
                      <input id="variable_points" type="checkbox"  name="variable_points" value="Var" @if($event->variable_points) checked @endif>
                    </div>
                  </div>

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-warning">
                              Submit
                          </button>
                          <button type="button" class="btn btn-warning" onClick="confirmation();">
                              Delete Event
                          </button>
                      </div>
                  </div>
                  <script>
                  function confirmation(){
                    bootbox.confirm("Are you sure you want to delete this event?", function(result){
                      if(result){
                        window.location= "/events/{{$event->id}}/delete";
                      }
                    })
                  }
                  </script>
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
