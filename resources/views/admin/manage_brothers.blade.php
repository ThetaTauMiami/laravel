@extends('layouts.default')

@section('content')

<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Administration</p>


                        <ul class="nav nav-pills roster-nav">
                            <li class="active" x-toggles="actives"><a href="javascript:;">Actives</a></li>
                            <li x-toggles="alum"><a href="javascript:;">Alumni</a></li>
                            <li x-toggles="all"><a href="javascript:;">All</a></li>
                        </ul>


                        <?php

                            function displayHeader($type){ ?>

                                <tr>
                                    <th>Roll</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Class</th>
                                    <?php if($type == 'actives'){ ?>
                                    <th>Role</th>
                                    <?php } if($type == 'actives'){ ?>
                                    <th>Make Alumni</th>
                                    <?php } if($type == 'alum'){ ?>
                                    <th>Make Active</th>
                                    <?php } if($type == 'all'){ ?>
                                    <th>Status</th>
                                    <?php } ?>
                                </tr>

                        <?php }

                            function displayMember($member,$roles,$type){ ?>

                                <tr>
                                    <input type="hidden" name="id[]" value="{{$member->id}}">
                                    <td>{{ $member->roll_number }} </td>
                                    <td><a href="/members/{{$member->id}}">{{ $member->first_name." ".$member->last_name }}</a></td>
                                    <td><a href="mailto:{{$member->email}}">{{$member->email}}</a></td>
                                    <td>{{$member->chapter_class}}</td>
                                    <?php if($type == 'actives'){ ?>
                                    <td><select name="role[] " class="form-control">
                                        <option value=""></option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" <?php

                                            if(isset($member->roles->first()->id) && $member->roles->first()->id == $role->id)
                                                echo "selected";

                                            ?>>
                                            {{$role->name}}
                                        </option>

                                        @endforeach

                                    </select></td>

                                    <?php } if($type == 'actives'){ ?>
                                      <!--My Check Box-->
                                      <td><input type ="checkbox" name = "alumni_request[]" value ="{{$member->id}}"/></td>
                                      <!--Original button by Matt<td><button class="btn btn-primary make-alum" id="toggle_alum_{{$member->id}}" brother-id="{{$member->id}}" type="button"><i class="fa fa-paper-plane"></i></button></td>-->
                                    <?php } if($type == 'alum'){ ?>
                                      <td><input type ="checkbox" name = "active_request[]" value ="{{$member->id}}"/></td>
                                    <!--<td><button class="btn btn-primary make-active" id="toggle_active_{{$member->id}}" brother-id="{{$member->id}}" type="button"><i class="fa fa-reply"></i></button></td>-->
                                        <?php if($member->active_status == 0){


                                        } ?>
                                    <?php } if($type == 'all'){ ?>
                                      <!--<td><select  name = "alumni[]" class"form-control">
                                          <option value ="Active">Active</option>
                                          <option value ="Alumni">Alumni</option>
                                        </select></td>-->

                                        <!-- This is where I will need to retrieve their status from the database-->
                                        <?php if($member->active_status == 0){ ?>
                                          <td> Alumni</td>
                                        <?php } if($member->active_status == 1){ ?>
                                          <td> Active</td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>

                        <?php }

                            function displayRoster($members,$roles,$type,$name){ ?>

                                <div id="{{$type}}" class="roster" style="{{ ($type == 'actives')?'':'display:none' }}">

                                    <h2>{{$name}} <a href="mailto:<?php

                                        $first = true;

                                        foreach($members as $member){
                                            if(($member->active_status && $type == "actives") || (!$member->active_status && $type == "alum") || ($type == "all")){
                                                if($first) $first = false;
                                                else echo ',';
                                                echo $member->email;
                                            }
                                        }

                                    ?>"><i class="fa fa-envelope"></i></a></h2>


                                    <?php if($type=='actives'|| $type=='alum'){ ?><form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/edit/brothers') }}"> <?php }?>


                                        {{ csrf_field() }}
                                        <table class="table table-responsive table-striped table-hover">


                                            <?php displayHeader($type); ?>

                                            @foreach($members as $member)


                                            <?php if(($member->active_status && $type == "actives") || (!$member->active_status == 1 && $type == "alum") || ($type == "all")){


                                                displayMember($member,$roles,$type);
                                            } ?>

                                            @endforeach

                                        </table>

                                        <?php if($type=='alum'||$type=='actives'){ ?><input type="submit" class="btn btn-primary" value="Submit"><?php } ?>


                                    </form>
                                </div>

                        <?php } ?>




                        {{ displayRoster($members,$roles,"actives","Active Brothers") }}
                        {{ displayRoster($members,$roles,"alum","Alumni") }}
                        {{ displayRoster($members,$roles,"all","All Members") }}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
