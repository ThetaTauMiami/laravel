@extends('layouts.default')

@section('content')

<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
      <h1>{{ $album->name }}</h1>
  </div>
  <div class="row">
  <div class="col-xs-12">



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
      <button onclick="location.href='/gallery/{{$album->id}}/edit';" class="btn btn-primary">
          Edit Album
      </button>
    </div>

    @endif

    @if(count($errors) == 0)
    <div id="uploader" style="display:none" class="col-md-8 col-md-offset-2">
    @elseif(count($errors) > 0)
    <div id="uploader" class="col-md-8 col-md-offset-2">
    @endif
      <div class="panel panel-default">
        <form enctype="multipart/form-data" method="post" action="/gallery/{{ $album->id }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="album_id" value="{{ $album->id }}">

          <!--<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>
            <input class="form-control" type="text" name="description"/>
          </div>-->

          <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
            <label for="images" class="col-md-4 control-label">Image</label>
            <input type="file" id="images" name="images[]" accept="image/*" multiple/>
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

  <h2 style="text-align:center">{{ $album->description }}</h2>

  @if (count($images) > 0)
  @foreach ($images as $image)

    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
      @if(Auth::check())

      <a onclick="confirmation()" href="#" style="color:grey" id="delete"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

      @endif
      <a class="thumbnail" href="{{ asset($image->file_path) }}"><img class="img-responsive" src="{{ asset($image->thumb_path) }}" alt=""></a>
    </div>

    <script>

      function confirmation(){
        bootbox.confirm("Are you sure you want to delete this image?", function(result){
          if(result){
            window.location= "/gallery/{{$album->id}}/{{$image->id}}/delete";
          }
        })
      }
    

    </script>
  @endforeach
  @endif


  </div>
</div>


@stop
