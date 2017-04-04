@extends('layouts.default')
<!-- Core CSS file -->
<link rel="stylesheet" href="{{ asset('/css/photoswipe.css') }}">

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite,
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="{{ asset('/css/default-skin/default-skin.css') }}">

<!-- Core JS file -->
<script src="{{ asset('/js/photoswipe.js') }}"></script>

<!-- UI JS file -->
<script src="{{ asset('/js/photoswipe-ui-default.js') }}"></script>
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
  <div class="container-fluid">
  <div class="row">
  <div class="col-xs-8 col-md-offset-2">


    @if (count($images) > 0)
    <div class="slider">
        <?php $i = 0; ?>
          @foreach ($images as $image)

        <label for="id{{$i}}">
          <img src="{{asset($image->thumb_path)}}" onclick="imageClick({{$i}})"/>
          @if(hasRole())

            <span onclick="bootbox.confirm('Really Delete Image?', function(result){
              if(result){
                window.location = '/gallery/{{$album->id}}/{{$image->id}}/delete';
              }
            })" style="color:grey" id="delete" class="delete-button"><i class="fa fa-times-circle" aria-hidden="true"></i></span>

          @endif
        </label>
        <?php $i+=1; ?>
        @endforeach
    </div>
    @endif

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
             It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                          <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>


  </div>
</div>
</div>
<script>
/*
 *  I know this is terrible practice to make this inline...
 *  But it needs php. So I'm just gonna be lazy. - Cole
 */
function startSlideshow(i){
  var pswpElement = document.querySelectorAll('.pswp')[0];
  // build items array
  var items = [
          <?php
          foreach ($images as $image){
            $origpath = $image->original_path;
            $path = $image->file_path;
            if($origpath == null) $origpath = $path;
            if(file_exists($path)){
              $size = getimagesize($path);
            }
            else{
              $size = {1280, 720};
            }
            echo "{\nsrc: \"/".$path."\",\norigsrc: \"/".$origpath."\",\nw: ".$size[0].",\nh: ".$size[1]."\n},\n";
          }?>
      ];

  var options = {
      index: i // start at i slide
  };

  // Initializes and opens PhotoSwipe
  var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
  gallery.init();
}

function imageClick(i){
  startSlideshow(i);
}
</script>

@stop
