@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Edit Album</div>
              <div class="panel-body">
                <form enctype="multipart/form-data" method="post" action="/gallery/{{$album->id}}/edit">
                  {{method_field('PATCH')}}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <input class="form-control" type="text" name="name" value="{{$album->name}}"/>
                  </div>

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Description</label>
                    <input class="form-control" type="text" name="description" value="{{$album->description}}"/>
                  </div>

                  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Location</label>
                    <input class="form-control" type="text" name="location" value="{{$album->location}}"/>
                  </div>

                  <div class="form-group{{ $errors->has('is_public') ? ' has-error' : '' }}">
      							<label for="is_public" class="col-md-4 control-label">Is Public?</label>
                    @if($album->is_public)
      							  <input type="checkbox" name="is_public" value="Public" checked/>
                    @else
                      <input type="checkbox" name="is_public" value="Public"/>
                    @endif
      						</div>

                  <!--<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    <label for="location" class="col-md-4 control-label">Date</label>
                    <input class="form-control" type="text" name="location" value=""/>
                  </div>-->

                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-warning">
                              Submit
                          </button>
                          <button type="button" class="btn btn-warning" onClick="confirmation();">
                              Delete Album
                          </button>
                      </div>
                  </div>
                  <script>
                  function confirmation(){
                    bootbox.confirm("Are you sure you want to delete this album?", function(result){
                      if(result){
                        window.location= "/gallery/{{$album->id}}/delete";
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
