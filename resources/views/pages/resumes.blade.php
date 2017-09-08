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
        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
          <form action="/resumes" method="post">
              {{ csrf_field() }}
            <h3>Graduation Years</h3>
              <ul style="list-style-type: none;">
              @foreach ($gradYears as $gradYear)
                <?php $checked = (in_array($gradYear, $filteredYears)) ? "checked" : ""; ?>
                <li><input id="{{$gradYear}}" type="checkbox" name="gradYears[]" value="{{$gradYear}}" {{$checked}}> <label for="{{$gradYear}}">{{$gradYear}}</label></li>
              @endforeach
              </ul>
            <h3>Major</h3>
              <ul style="list-style-type: none;">
              @foreach ($majors as $major)
                <?php $checked = (in_array($major, $filteredMajors)) ? "checked" : ""; ?>
                <li><input id="{{$major}}" type="checkbox" name="majors[]" value="{{$major}}" {{$checked}}> <label for="{{$major}}">{{$major}}</label></li>
              @endforeach
              </ul>

            <input type="submit" class="btn btn-primary">
          </form>
        </div>
        <div class="col-lg-3 col-md-8 col-sm-8 col-xs-12" style="max-height:50%;overflow-y: auto;">
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
  $('#resume_container').append('<embed id="MyResume" src="'+resume+'" width="100%" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">');
  setTimeout(sizeResume, 100);
});

function sizeResume() {
  $('#MyResume').attr('height',($('#MyResume').width()*1.33)+'px')
}

$(window).resize(sizeResume);

</script>





@stop