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
            <?php
            $total_general = 0;
            $total_service = 0;
            $total_pd = 0;
            $total_brotherhood = 0;
            $total_peeps = 0; ?>
          @foreach($members as $member)
            <?php
            $total_peeps+=1;
              $userAtt = DB::table('attendance')->where('user_id', '=', $member->id)->get();
              $general = 0;
              $service = 0;
              $pd = 0;
              $brotherhood = 0;
              foreach($userAtt as $ua){
                $event = DB::table('events')->where('id', '=', $ua->event_id)->where('semester_id', '=', app('App\Http\Controllers\HomeController')->getCurrentSemester()->id)->first();
                if($event != null){
                  if($event->type_id == "General"){
                    $general += $ua->points;
                  }elseif($event->type_id == "Service"){
                    $service += $ua->points;
                  }elseif($event->type_id == "PD"){
                    $pd += $ua->points;
                  }elseif($event->type_id == "Brotherhood"){
                    $brotherhood += $ua->points;
                  }
                }
                if($service > 5) {
                  $general += $service - 5;
                  $service = 5;
                }
                if($brotherhood > 5) {
                  $general += $brotherhood - 5;
                  $brotherhood = 5;
                }
                if($pd > 5) {
                  $general += $pd - 5;
                  $pd = 5;
                }

              }
              $total_general += $general;
              $total_service += $service;
              $total_pd += $pd;
              $total_brotherhood += $brotherhood;
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

        <div>
          <?="Avg general: "?><b><?=round(($total_general/$total_peeps), 2); ?></b>
          <br/>
          <?="Avg service: "?><b><?=round(($total_service/$total_peeps), 2); ?></b>
          <br/>
          <?="Avg pd: "?><b><?=round(($total_pd/$total_peeps), 2); ?></b>
          <br/>
          <?= "Avg brotherhood: "?><b><?=round(($total_brotherhood/$total_peeps), 2); ?></b>

        </div>

    		</div>
	     </div>
    </div>
@stop
