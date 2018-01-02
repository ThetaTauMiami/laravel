@extends('layouts.default')

<style>
 #map {
   width: 100%;
   height: 500px;
   background-color: grey;
 }
</style>

@section('content')
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>WHERE WE WORKED</h1>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <h2 class="section-heading">Company Map of Theta Tau Members</h2>
                    <p>
                      Check out where our brothers get jobs at, both past and present.
                    </p>
                    <hr class="primary">
                </div>
            </div>
        </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-lg-push-3 col-sm-9 col-sm-push-3 col-xs-12">
          <h2>Company Map</h2>
          <p>Click markers to view companies</p>
          <div id="map"></div>
        </div>
        <div class=" col-lg-offset-1 col-lg-2 col-lg-pull-8 col-sm-3 col-sm-pull-9 col-xs-12">
          <h2>Company List</h2>
          @foreach ($companies as $company)

            <h4>{{ $company }}</h4>

          @endforeach
        </div>
    </div>
</div>



<script>
  function initMap() {
    var uluru = {lat: 39.8283, lng: -98.5795};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: uluru
    });
    @foreach ($locations as $location => $companies_at_loc)
      var marker = new google.maps.Marker({
        position: {{$geos[$location]}},
        map: map
      });
      makeInfoWindowEvent(map, "<h3><b>{{$location}}</b></h3><p>{{implode('<br/>',$companies_at_loc)}}</p>" , marker);
    @endforeach
  }



  function makeInfoWindowEvent(map, contentString, marker) {
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(contentString);
      infowindow.open(map, marker);
    });
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTrCTZUdHJZ_Dee7yK1-mSlIGJw2S140U&callback=initMap">
</script>





@stop