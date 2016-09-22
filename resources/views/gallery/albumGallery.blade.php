@extends('layouts.default')

@section('content')

<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
      <h1>{{ $album->name }}</h1>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
    width:60%;

    margin: auto;
}
</style>
<?php
$carouselimg = DB::table('images')
  ->where('album_id', '=', $album->id)
  ->take(5)
  ->get();

  $i = 1;
  $j=0;
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">

  <ol class="carousel-indicators">
    @foreach($carouselimg as $f)
      @if($j==0)
        <li data-target="#myCarousel" data-slide-to="{{$j}}" class="active"></li>
      @else
        <li data-target="#myCarousel" data-slide-to="{{$j}}"></li>
      @endif
      <?php $j+=1; ?>
    @endforeach

  </ol>

<div class="carousel-inner" role="listbox">
@foreach($carouselimg as $img)
  @if($i == 1)
    <div class="item active">
      <img src="{{ asset($img->thumb_path) }}" alt="">
    </div>
    <?php $i=2; ?>
  @else
  <div class="item">
    <img src="{{ asset($img->thumb_path) }}" alt="">
  </div>
  @endif
@endforeach
</div>


  <a href="#myCarousel" role="button" data-slide="prev" onclick="$('#myCarousel').carousel('prev')">

    <span class="sr-only">Previous</span>
  </a>
  <a href="#myCarousel" role="button" data-slide="next" onclick="$('#myCarousel').carousel('next')">

    <span class="sr-only">Next</span>
  </a>
</div>

  <div class="panel panel-default"><h4 style="text-align:center">{{ $album->description }}</h4></div>

  @if (count($images) > 0)
  @foreach ($images as $image)

    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
      @if(Auth::check())

      <a onclick="confirmation({{$image->id}})" href="#" style="color:grey" id="delete"><i class="fa fa-times-circle" aria-hidden="true"></i></a>

      @endif
      <a class="thumbnail" href="{{ asset($image->file_path) }}"><img class="img-responsive" src="{{ asset($image->thumb_path) }}" alt=""></a>
    </div>

    <script>

      function confirmation(id){
        bootbox.confirm("Are you sure you want to delete this image?", function(result){
          if(result){
            window.location= "/gallery/{{$album->id}}/"+id+"/delete";
          }
        })
      }


    </script>
  @endforeach
  @endif


  </div>
</div>
</div>


@stop
