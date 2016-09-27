@extends('layouts.default')

@section('content')

<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
      <h1>{{ $album->name }}</h1>
  </div>
  <div class="panel panel-default text-center"><h4 style="display:inline-block;">{{ $album->description }}</h4>
  @if(Auth::Check())

      <button id="button" class="btn btn-primary">
          Upload New Image
      </button>
  @endif
  @if(hasRole())
      <button onclick="location.href='/gallery/{{$album->id}}/edit';" class="btn btn-primary">
          Edit Album
      </button>

  @endif
  </div>

  <div class="container-fluid">
  <div class="row">
  <div class="col-xs-12">



    <script>

        $(function() {
            $( "#button" ).click(function() {
                $( "#uploader" ).toggle();
            });
        });

    </script>

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

</div>
</div>



<div class="container">
  <div class="row col-xs-12 col-md-8 col-md-offset-2">
@if (count($images) > 0)
  <div class="slider">
    <?php $i = 0; ?>
      @foreach ($images as $image)
    <input type="radio" name="slide_switch" id="id{{++$i}}" {{($i == 1)?'checked="checked"':''}}/>
    <label for="id{{$i}}">
      <img src="{{asset($image->thumb_path)}}"/>
      @if(hasRole())

        <span onclick="confirmation({{$image->id}})" style="color:grey" id="delete" class="delete-button"><i class="fa fa-times-circle" aria-hidden="true"></i></span>

      @endif
    </label>
    <img src="{{asset($image->file_path)}}"/>

    @endforeach


  </div>
@endif

  <script src="{{asset('/js/prefixfree.min.js')}}"></script>

  </div>
</div>



  </div>
</div>
</div>


@stop
