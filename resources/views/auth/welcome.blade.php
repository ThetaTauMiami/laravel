@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
                    <h1>Welcome to Theta Tau!</h1>
                    <p>
                        Welcome to our brotherhood. Be sure to <a href="/linkedin">connect your LinkedIn account</a> and later view your profile so that you can upload a profile picture and upload your resume.
                    </p>
                    <p>
                        If you have any questions or find any issues related to the site, contact <a href="mailto:deperomm@miamioh.edu,hoffbact@miamioh.edu">the tech chairs</a> Matt DePero and Cole Hoffbauer.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
