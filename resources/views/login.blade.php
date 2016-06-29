@extends('layout')

@section('content')

    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="{{ asset('/img/login-logo.png') }}" />
        <p id="profile-name" class="profile-name-card">Theta Tau | Miami University</p>
        <form class="form-signin">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div><!-- /card-container -->


@stop