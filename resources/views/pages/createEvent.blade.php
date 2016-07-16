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
                    <div class="form-group">
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

                    <div class="form-group">
                      <label for="points" class="col-md-4 control-label">Number of Points</label>
                      <div class="col-md-6">
                        <input id="points" type="text" class="form-control" name="points" value="{{ old('points') }}">
                      </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ $user = Auth::user()->id }}">
                  </form>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
