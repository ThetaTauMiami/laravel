<!DOCTYPE html>
<html>
<head>
    <title>Theta Tau | Tau Delta Chapter</title>
    <link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="/img/favicon.ico" rel="icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel=
    "stylesheet" type="text/css">
    <link href=
          "{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}"
          rel="stylesheet">
    <link href=
          "{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/footer-distributed.css') }}" rel="stylesheet">
    <script crossorigin="anonymous" integrity=
    "sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target="#myNavbar"
                    data-toggle="collapse" type="button"><span class=
                                                               "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                                                                                       "icon-bar"></span></button> <a class="navbar-brand" href=
            "/"><span id="nav">THETA TAU | MIAMI UNIVERSITY</span></a>
            <a href="/"><img src=
                             "{{asset('/img/navbar-logo.png')}}"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">HOME</a>
                </li>
                <li>
                    <a href="gallery">GALLERY</a>
                </li>
                <li>
                    <a href="events">EVENTS</a>
                </li>
                <li>
                    <a href="recruitment">RECRUITMENT</a>
                </li>
                <li>
                    <a href="members">MEMBERS</a>
                </li>
                <li>
                    <a href="alumni">ALUMNI</a>
                </li>
                <li>
                    <a href="contact">CONTACT</a>
                </li>
                    <a href="login"><button class="btn btn-warning" type=
                        "button">LOG IN</button></a>
            </ul>

        </div>
    </div>
</nav>@yield('content')<br>
<br>
<footer class="footer-distributed">
    <div class="footer-right">
        <a href="https://www.facebook.com/ThetaTauMU/?fref=ts" target=
        "_blank"><i class="fa fa-facebook"></i></a> <a href="#" target=
        "_blank"><i class="fa fa-twitter"></i></a> <a href="#" target=
        "_blank"><i class="fa fa-linkedin"></i></a> <a href="#" target=
        "_blank"><i class="fa fa-github"></i></a>
    </div>
    <div class="footer-left">
        <p class="footer-links"><a href="/">Home</a> · <a href=
                                                          "gallery">Gallery</a> · <a href="events">Events</a> · <a href=
                                                                                                                   "recruitment">Recruitment</a> · <a href="members">Members</a> ·
            <a href="alumni">Alumni</a> · <a href="contact">Contact Us</a></p>
        <p>Theta Tau | Tau Delta Chapter of Miami University &copy;
            2016</p>
    </div>
</footer>
<script crossorigin="anonymous" integrity=
"sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" src=
        "{{asset('https://code.jquery.com/jquery-3.0.0.min.js')}}">
</script>
<script src=
        "{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')}}">
</script>
</body>
</html>