@extends('layouts.email')

@section('content')

<div class="col-xs-12">

	<h2>Attendance Reminder</h2>

	<p>
		Hey, {{ $name }} here's a reminder of your point totals!
	</p>
  <ul>
    <li>General: {{ $generalTotal }}</li>
    <li>Brotherhood: {{ $brotherhoodTotal }}</li>
    <li>PD: {{ $pdTotal }}</li>
    <li>Service: {{ $serviceTotal }}</li>
  </ul>
  <br/>
  <h5>You still need...</h5>
  <ul>
    <li>{{ max(5-($generalTotal+max($brotherhoodTotal-5, 0)+max($pdTotal-5, 0)+max($serviceTotal-5, 0)), 0) }} General Points</li>
    <li>{{ max(0, 5-$brotherhoodTotal) }} Brotherhood Points</li>
    <li>{{ max(0, 5-$pdTotal) }} PD Points</li>
    <li>{{ max(0, 5-$serviceTotal) }} Service Points</li>
  </ul>
  <br/><br/>
  <p>
    If you think there's anything wrong with the above totals, please contact exec or the person who was in charge of the event you didn't get points for.
  </p>

</div>

@stop
