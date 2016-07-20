@extends('layouts.default')

@section('content')

	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.jpg') }}'); background-position: center;">
        <h1>GALLERY</h1>
    </div>
    <div class="row">
		<div class="col-xs-12">
			<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
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
						Upload New Picture
				</button>
			</div>
			@elseif(!Auth::check())
			<div class="col-md-8">
				<a href="login"><button class="btn btn-primary">
						Upload New Picture
				</button></a>
			</div>
			@endif

			@if(count($errors) == 0)
			<div id="uploader" style="display:none" class="col-md-8 col-md-offset-2">
			@elseif(count($errors) > 0)
			<div id="uploader" class="col-md-8 col-md-offset-2">
			@endif
				<div class="panel panel-default">
					<form enctype="multipart/form-data" method="post" action="/gallery">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@if(Auth::check())
						<input type="hidden" name="user_id" value="{{ $user = Auth::user()->id }}">
						@endif
						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							<label for="description" class="col-md-4 control-label">Description</label>
							<input class="form-control" type="text" name="description"/>
						</div>

						<div class="form-group{{ $errors->has('event_id') ? ' has-error' : '' }}">
							<label for="event_id" class="col-md-4 control-label">Event the picture is from</label>
							<select name="event_id" class="form-control">
								@foreach ($events as $event)
								<option value="{{ $event->id }}"> {{ $event->eventName }} </option>
								@endforeach
							</select>
						</div>

						<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
							<label for="image" class="col-md-4 control-label">Image</label>
							<input type="file" id="image" name="image"accept="image/*"/>
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

			<div class="col-md-8 col-md-offset-2">
			<ul>
			@foreach ($events as $event)
				<li><a href="gallery/{{$event->id}}">{{$event->eventName}}</a></li>
			@endforeach
		  </ul>
		  </div>

		</div>
	</div>

    <a class="thumbnail" href="#">
    <img src="http://cdn.wpfreeware.com/wp-content/uploads/2014/09/placeholder-images.jpg?b65726" class="img-fluid center-block" alt="Responsive image">
    </a>
    <div class="container" style="margin-top: 20px">

        <div class="row">

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                </a>
            </div>
        </div>
    <!-- /.container -->
@stop
