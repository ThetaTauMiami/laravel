@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>ATTENDANCE</h1>
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-xs-12">
          <table class="table">
            <thead>
              <tr>
                <th>Member</th>
                <th>General Points</th>
                <th>Service Points</th>
                <th>PD Points</th>
                <th>Brotherhood Points</th>
              </tr>
            </thead>
          @foreach($members as $member)
            <?php
              $userAtt = DB::table('attendance')->where('user_id', '=', $member->id)->get();
              $general = 0;
              $service = 0;
              $pd = 0;
              $brotherhood = 0;
              foreach($userAtt as $ua){
                $event = DB::table('events')->where('id', '=', $ua->event_id)->where('semester_id', '=', app('App\Http\Controllers\HomeController')->getCurrentSemester()->id)->first();

                if($event->type_id == "General"){
                  $general += $event->points;
                }elseif($event->type_id == "Service"){
                  $service += $event->points;
                }elseif($event->type_id == "PD"){
                  $pd += $event->points;
                }elseif($event->type_id == "Brotherhood"){
                  $brotherhood += $event->points;
                }

              }
             ?>
            <tr>
              <td><a href="/members/{{$member->id}}/attendance">{{$member->first_name}} {{$member->last_name}}</a></td>
              <td>{{$general}}</td>
              <td>{{$service}}</td>
              <td>{{$pd}}</td>
              <td>{{$brotherhood}}</td>
            </tr>

          @endforeach
        </table>
    		</div>
	     </div>
    </div>
@stop
