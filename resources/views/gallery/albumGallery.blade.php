@extends('layouts.default')

@section('content')

<div class="jumbotron" style="background-image:url('{{ asset('img/banner.jpg') }}'); background-position: center;">
      <h1>{{ $album->name }}</h1>
  </div>
  <div class="row">
  <div class="col-xs-12">
    @if (count($images) > 0)
    @foreach ($images as $image)
      <div>
        <p>{{ $image->description }}</p>
        <p>{{ $image->filepath }}</p>
        <img src="{{ asset($image->filepath) }}" height="200" width="200"/>
      </div>
    @endforeach
    @endif


    <script>
        $(function() {
            $( "#button" ).click(function() {
                $( "#uploader" ).toggle();
            });
        });
    </script>

    @if(Auth::check())
    <div class="col-md-8">
      <button id="button" class="btn btn-primary">
          Upload New Image
      </button>
    </div>
    @elseif(!Auth::check())
    <div class="col-md-8">
      <a href="login"><button class="btn btn-primary">
          Upload New Image
      </button></a>
    </div>
    @endif


    <div id="uploader" style="display:none" class="col-md-8 col-md-offset-2">

      <div class="panel panel-default">
        <form enctype="multipart/form-data" method="post" action="/gallery">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="album_id" value="{{ $album->id }}">

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>
            <input class="form-control" type="text" name="name"/>
          </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>
            <input class="form-control" type="text" name="description"/>
          </div>

          <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
            <label for="location" class="col-md-4 control-label">Location</label>
            <input class="form-control" type="text" name="location"/>
          </div>

          <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="image" class="col-md-4 control-label">Image</label>
            <input type="file" id="image" name="image" accept="image/*"/>
          </div>

          <button type="submit" class="btn">Submit</button>
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

  <a class="thumbnail" href="#">
  <img src="http://cdn.wpfreeware.com/wp-content/uploads/2014/09/placeholder-images.jpg?b65726" class="img-fluid center-block" alt="Responsive image">
  </a>

  </div>
</div>


@stop
