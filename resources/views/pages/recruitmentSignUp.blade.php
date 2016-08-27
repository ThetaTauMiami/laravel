@extends('layouts.default')
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">
@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Sign Up</div>
              <div class="panel-body">
                  <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="/recruitment/signup">
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                      <label for="first_name" class="col-md-4 control-label">First Name</label>

                      <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name">
                      </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                      <label for="last_name" class="col-md-4 control-label">Last Name</label>

                      <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name">
                      </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email" class="col-md-4 control-label">Email</label>

                      <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email">
                      </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                              Submit
                          </button>
                      </div>
                  </div>
                </form>


                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection
