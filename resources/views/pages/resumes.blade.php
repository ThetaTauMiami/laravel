@extends('layouts.default')
<style>
    body {
        padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }

    .img-center {
        margin: 0 auto;
    }
</style>
@section('content')
	<div class="jumbotron" style="background-image:url('{{ asset('img/banner.png') }}'); background-position: center;">
        <h1>RESUME BOOK</h1>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <h2 class="section-heading">Theta Tau Member Resumes</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-12">
          <form action="/resumes" method="post">
              {{ csrf_field() }}
            <h3>Major</h3>
              <input type="checkbox" name="majors[]" value="Software">
              <input type="checkbox" name="majors[]" value="General">
            <h3>Graduation Years</h3>
              <input type="checkbox" name="gradYears[]" value="2020">
              <input type="checkbox" name="gradYears[]" value="2019">

            <input type="submit" class="btn btn-primary">
          </form>
        </div>
        <div class="col-lg-3 col-md-8 col-sm-12" style="max-height:100%;overflow-y: auto;">
          <ul style="list-style-type: none;">
          @foreach ($members as $member)
            <li style="display: -webkit-flex;display: flex;">
                <h3 class="member_resume" resume_path="/members/{{$member->id}}/resume" style="cursor:pointer;display:inline-block;">{{$member->first_name}} {{$member->last_name}}
                    <br/><small>{{$member->major}} | Class of {{$member->school_class}}</small>
                </h3>
            </li>
          @endforeach
          </ul>
        </div>
        <div class="col-lg-7 col-md-12">
          <div id="resume_container" style="width:100%;">
            
          </div>
        </div>
    </div>
</div>



<script type="application/javascript">

$(".member_resume").click(function(event){
  $('#resume').remove();
  resume = $(this).attr("resume_path");
  $('#resume_container').append('<embed id="resume" src="'+resume+'" width="100%" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">');
  sizeResume();
});

function sizeResume() {
  $('#resume').attr('height',($('#resume').width()*1.33)+'px')
}

$(window).resize(sizeResume);

</script>





@stop