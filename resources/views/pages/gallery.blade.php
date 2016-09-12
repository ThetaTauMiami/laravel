@extends('layouts.default')

@section('content')

    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>GALLERY</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!--<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->
                <script>
                    $(function () {
                        $("#button").click(function () {
                            $("#uploader").toggle();
                        });
                    });
                </script>

                @if(Auth::check())
                    <div class="col-md-8">
                        <button id="button" class="btn btn-primary">
                            Create New Album
                        </button>
                    </div>
                @elseif(!Auth::check())
                    <div class="col-md-8">
                        <a href="login">
                            <button class="btn btn-primary">
                                Create New Album
                            </button>
                        </a>
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

                                    <!--<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
							<label for="image" class="col-md-4 control-label">Image</label>
							<input type="file" id="image" name="image" accept="image/*"/>
						</div>-->

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
                <img src="http://cdn.wpfreeware.com/wp-content/uploads/2014/09/placeholder-images.jpg?b65726"
                     class="img-fluid center-block" alt="Responsive image">
            </a>



            <div class="container" style="margin-top: 20px">

                <div class="row">

                    @foreach ($albums as $album)
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail" href="/gallery/{{ $album->id }}">

                                <img class="img-responsive" src="http://placehold.it/400x300" alt="">
                                <p> {{ $album->name }} </p>
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>



    <!-- /.container -->
@stop
