@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>Attendance for {{$user->first_name}}</h1>
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-xs-12">
          <?php
          $member = Auth::User();
          $userAtt = DB::table('attendance')->where('user_id', '=', $member->id)->get();
          $general = 0;
          $service = 0;
          $pd = 0;
          $brotherhood = 0;
          foreach($userAtt as $ua){
            $event = DB::table('events')->where('id', '=', $ua->event_id)->where('semester_id', '=', app('App\Http\Controllers\HomeController')->getCurrentSemester()->id)->first();

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
           ?>
         <table class="table">
           <thead>
             <tr>
               <th>General Points</th>
               <th>Service Points</th>
               <th>PD Points</th>
               <th>Brotherhood Points</th>
             </tr>
           </thead>
         <tr>
           <td>{{$general}}</td>
           <td>{{$service}}</td>
           <td>{{$pd}}</td>
           <td>{{$brotherhood}}</td>
         </tr>
       </table>
          <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Event</th>
                <th>Attended</th>
              </tr>
            </thead>



              @foreach($events as $event)
              <tr>
                <td>{{$event->name}}</td>
                <?php
                $attended = App\Attendance::where('event_id', '=', $event->id)->where('user_id', '=', $user->id)->first();
                 ?>
                 @if($attended)
                 <td style="color: #eb3812">{{$event->type_id}}: {{$attended->points}}</td>
                 @else
                 <td>Didn't Attend</td>
                 @endif
               </tr>
              @endforeach



        </table>
      </div>
    		</div>
	     </div>
    </div>
@stop
