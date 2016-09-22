@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Attendance for {{$event->name}}</div>
              <br/>


              <div class="panel-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action='/events/{{$event->id}}/attendance/variable'>
                  {{method_field('PATCH')}}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                  @foreach($attendance as $a)
                  <div class="form-group">
                    <?php $u = App\User::where('id', '=', $a->user_id)->first() ?>
                    <label for="{{$a->user_id}}" class="col-md-4 control-label">{{$u->first_name." ".$u->last_name}}</label>
                    <div class="col-md-6">
                      <input id="{{$a->user_id}}" type="text" class="form-control" name="{{$a->user_id}}" value="{{ $a->points }}">
                    </div>
                  </div>
                  @endforeach


                  <div class="clearfix"></div>

                  <br/>
                  <br/>
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-5">
                          <button class="btn btn-primary" id="attendanceButton" type="submit">
                              Submit
                          </button>
                      </div>
                  </div>
            </form>





            </div>
          </div>
      </div>
  </div>
</div>



@endsection
