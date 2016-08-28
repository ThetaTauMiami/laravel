@extends('layouts.default')

@section('content')

    <link href="css/home.css" rel="stylesheet">
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <img src="img/login-logo.png" height="214" width="125">
                <h1 id="homeHeading">Theta Tau</h1>
                <hr>
                <h2 id="homeHeading">Tau Delta Chapter of Miami University</h2>
                <h4 id="homeHeading">Professional Engineering Fraternity</h4>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">

            

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Welcome!</h2>
                    <hr class="light">
                    <p class="text-faded">Theta Tau is the oldest, largest, and foremost Fraternity for Engineers. Since its founding at the University of Minnesota in 1904, over 35,000 have been initiated over the years. With emphasis on quality and a strong fraternal bond, the Fraternity has chapters only at ABET accredited schools and limits the number of student members in any one of its chapters across the nation. </p>
                    <a href="/recruitment" class="btn btn-info btn-xl">HOW TO JOIN</a>
                    <a href="#pillars" class="page-scroll btn btn-default btn-xl sr-button">ABOUT US</a>
                </div>
            </div>
        </div>
    </section>

    <section id="pillars">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="img/rose.png" height="182" width="166">
                    <h2 class="section-heading">Our Purpose</h2>
                    <hr class="primary">
                    <p>The purpose of Theta Tau is to develop and maintain a high standard of professional interest among its members, and to unite them in a strong bond of fraternal fellowship.</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <h2 class="section-heading">The Pillars of Theta Tau</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sign-language text-primary sr-icons"></i>
                        <h3>Service</h3>
                        <p class="text-muted">We are known for our service to our college, university and the larger community. Our service projects create a unifying environment for learning and personal growth for our members.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-university text-primary sr-icons"></i>
                        <h3>Professional Development</h3>
                        <p class="text-muted">We develop and nurture engineers with strong communication, problem-solving, collaboration, and leadership skills that we demonstrate in our profession, our community, and in our lives.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-users text-primary sr-icons"></i>
                        <h3>Brotherhood</h3>
                        <p class="text-muted">We forge lifelong bonds of fraternal friendship, a journey that develops and delivers a network of lasting personal and professional relationships. We foster an inviting, safe, and social environment in which our members become lifelong friends.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>


@stop
