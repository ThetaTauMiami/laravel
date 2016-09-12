@extends('layouts.default')

@section('content')
    <div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>Attendance for {{$user->first_name}}</h1>
    </div>

    <div class="container">
    	<div class="row">
    		<div class="col-xs-12">
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
                $attended = DB::table('attendance')->where('event_id', '=', $event->id)->where('user_id', '=', $user->id)->first();
                 ?>
                 @if($attended)
                 <td style="color: #eb3812">{{$event->type_id}}: {{$event->points}}</td>
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
