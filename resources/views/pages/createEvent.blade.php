@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Create New Event</div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="/createEvent">
                    <div class="form-group{{ $errors->has('eventName') ? ' has-error' : '' }}">
                      <label for="eventName" class="col-md-4 control-label">Event Name</label>

                      <div class="col-md-6">
                        <input id="eventName" type="text" class="form-control" name="eventName">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="pointType" class="col-md-4 control-label">Type of Points</label>

                      <div class="col-md-6">
                        <select id="pointType" class="form-control" name="pointType">
                          <option value="general">General</option>
                          <option value="pd">PD</option>
                          <option value="brotherhood">Brotherhood</option>
                          <option value="service">Service</option>
                        </select>

                      </div>
                    </div>

                    <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                      <label for="points" class="col-md-4 control-label">Number of Points</label>
                      <div class="col-md-6">
                        <input id="points" type="text" class="form-control" name="points" value="{{ old('points') }}">

                      </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--<input type="hidden" name="user_id" value="{{ $user = Auth::user()->id }}">-->


                  <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    <label for="date" class="col-md-4 control-label">Date of Event</label>
                    <div class="col-md-6">
                      <input id="date" type="date" class="form-control" name="date" value="{{ old('date') }}">

                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Location of Event</label>
                    <div class="col-md-6">
                      <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('album') ? ' has-error' : '' }}">
                    <label for="album" class="col-md-4 control-label">Create Photo Album for this Event?</label>
                    <div class="col-md-6">
                      <input id="album" type="checkbox"  name="album" value="{{ old('album') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>
                    <div class="col-md-6">
                      <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
      							<label for="image" class="col-md-4 control-label">Image</label>
      							<input type="file" id="image" name="image" accept="image/*"/>
      						</div>

                  <div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
                    <label for="is_public" class="col-md-4 control-label">Is This Event Public?</label>
                    <div class="col-md-6">
                      <input id="is_public" type="checkbox"  name="is_public" value="{{ old('is_public') }}">
                    </div>
                  </div>

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
