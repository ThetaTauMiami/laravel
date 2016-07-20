@extends('layouts.default')

@section('content')

<div class="jumbotron" style="background-image:url('{{ asset('img/banner.jpg') }}'); background-position: center;">
      <h1>GALLERY</h1>
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




  </div>
</div>


@stop
