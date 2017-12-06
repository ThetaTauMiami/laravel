<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target="#myNavbar"
                    data-toggle="collapse" type="button"><span class=
                                                               "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                                                                                       "icon-bar"></span></button> <a class="navbar-brand" href=
            "/"><span id="nav">THETA TAU | <span class="hidden-xs">MIAMI UNIVERSITY</span><span class="hidden-sm hidden-md hidden-lg hidden-xl">ΤΔ</span></span></a>
            <span class="hidden-xs"><a href="/"><img src=
                             "{{asset('/img/navbar-logo.png')}}" class="navbar-brand"></a></span>
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
                        <li><a href="/resumes">MEMBER RESUMES</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/contact">CONTACT</a>
                </li>

                <!--This php script is to dynamically change the login to a logout button with other options-->
                <?php
                $user = Auth::user();

                $userDropDown = '';

                if (isExecOrAdmin() || hasRole() || Auth::Check()) {
                    $userDropDown .= '
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Welcome, '. $user->first_name .'!
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/members/'.$user->id.'">MY PROFILE</a></li>';
                }

                if (isExecOrAdmin()){
                    $userDropDown .= '
                        <li><a href="/admin">ADMIN PANEL</a></li>';
                }

                if (hasRole() || isExecOrAdmin()) {
                    $userDropDown .= '
                        <li><a href="/chair">CHAIR PANEL</a></li>';
                }

                if(Auth::check()) {
                    $userDropDown .= '
                        <li><a href="/logout">LOGOUT</a></li>
                    </ul>
                </li>';
                }

                if(!Auth::Check()) {
                    $userDropDown = ' <a href="/login"><button class="btn btn-warning" type=
                        "button" id="log-in-button">LOG IN</button></a>';
                }

                echo $userDropDown;
                ?>
            </ul>

        </div>
    </div>
</nav>
