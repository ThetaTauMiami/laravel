@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Edit Recruitment {{$recruitment_event->id}}</div>
              <div class="panel-body">
                  <form class="form-horizontal" role="form" method="post" action="/editRecruitmentEvent/{{ $recruitment_event->id }}" enctype="multipart/form-data">
                    {{method_field('PATCH')}}

                    <div class="form-group">
                      <label for="title" class="col-md-4 control-label">Event Title</label>
                      <div class="col-md-6">
                        <input id="title" class="form-control" name="title" value="{{$recruitment_event->title}}" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="description" class="col-md-4 control-label">Event Description</label>
                      <div class="col-md-6">
                        <input id="description"  class="form-control" name="description" value="{{$recruitment_event->description}} ">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="location" class="col-md-4 control-label">Event Location</label>
                      <div class="col-md-6">
                        <input id="location"  class="form-control" name="location" value="{{$recruitment_event->location}} ">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="when" class="col-md-4 control-label">Date/Time</label>
                      <div class="col-md-6">
                        <input id="when" class="form-control" name="when" value="{{$recruitment_event->when}}">
                      </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <label for="note" class="col-md-4 control-label">Additional Information</label>
                      <div class="col-md-6">
                        <input id="note"  class="form-control" name="note" value="{{$recruitment_event->note}} ">
                      </div>
                    </div>

                    <div class="form-group">
        							<label for="image" class="col-md-4 control-label">Event Image</label>
                      <div class="col-md-6">
        							  <input type="file" id="image" name="image" accept="image/*"/>
                      </div>
        						</div>



                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif



                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-warning">
                              Submit
                          </button>
                          <button type="button" class="btn btn-warning" onClick="confirmation();" style="float:right; background-color:#CE0000">
                              Delete Event
                          </button>
                      </div>
                  </div>
                  <script>
                  function confirmation(){
                    bootbox.confirm("Are you sure you want to delete this event?", function(result){
                      if(result){
                        window.location= "/recruitmentEvent/{{$recruitment_event->id}}/delete";
                      }
                    })
                  }
                  </script>
                </form>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
