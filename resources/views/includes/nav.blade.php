<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target="#myNavbar"
                    data-toggle="collapse" type="button"><span class=
                                                               "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                                                                                       "icon-bar"></span></button> <a class="navbar-brand" href=
            "/"><span id="nav">THETA TAU | MIAMI UNIVERSITY</span></a>
            <a href="/"><img src=
                             "{{asset('/img/navbar-logo.png')}}" class="navbar-brand"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">HOME</a>
                </li>
                <li>
                    <a href="/gallery">GALLERY</a>
                </li>
                <li>
                    <a href="/events">EVENTS</a>
                </li>
                <li>
                    <a href="/recruitment">RECRUITMENT</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">MEMBERS
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/members">ACTIVES</a></li>
                        <li><a href="/alumni">ALUMNI</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/contact">CONTACT</a>
                </li>

                <!--This php script is to dynamically change the login to a logout button with other options-->
                <?php
                $user = Auth::user();
                if (Auth::check()) {
                        echo '<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Welcome, '.$user->name.'!
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">MY PROFILE</a></li>
                        <li><a href="/admin">ADMIN PANEL</a></li>
                        <li><a href="/logout">LOGOUT</a></li>
                    </ul>
                </li>';
                } else {
                    echo ' <a href="/login"><button class="btn btn-warning" type=
                        "button">LOG IN</button></a>';
                }
                ?>
            </ul>

        </div>
    </div>
</nav>
