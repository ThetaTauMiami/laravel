@extends('layouts.default')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Register</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/edit/roles') }}">
                    	{{ csrf_field() }}

                        <div class="row">
                            <div class="col-xs-4 col-xs-offset-4">
                                <img id="profile-img" class="img-responsive" src="{{ asset('/img/login-logo.png') }}" />
                            </div>
                        </div>
                        <p id="profile-name" class="profile-name-card">Theta Tau | Administration<br/>Manage Roles</p>
                        <p>
                            
                        </p>
                        @if ($errors->has('general_error'))
                        <div class="col-xs-12 has-error">
                            <span class="help-block">
                                <strong>{{ $errors->first('general_error') }}</strong>
                            </span>
                        </div>
                        @endif
                        

                        <div class="form-group row">
                            <div class="col-xs-12">
                                <label for="name" class="col-md-4 control-label">Manage Available Roles</label>
                                <table id="roles_list">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Retire?</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($roles as $role)

                                        <tr>
                                            <input type="hidden" name="role_id[]" value="{{$role->id}}">
                                            <input type="hidden" name="role_rank[]" value="">
                                            <td style="cursor:move;padding-left:5px;padding-right:5px;"><i class="fa fa-sort"></i></td>
                                            <td><input class="form-control" name="name[]" value="{{$role->name}}"></td>
                                            <td><select name="type[]" class="form-control">
                                                <option value="exec" {{($role->type=="exec")?"selected":""}}>Exec</option>
                                                <option value="admin" {{($role->type=="admin")?"selected":""}}>Site Admin</option>
                                                <option value="chair" {{($role->type=="chair")?"selected":""}}>Chair</option>
                                            </select></td>
                                            <td>&nbsp;&nbsp;<input type="checkbox" class="" name="retire[]" value="{{$role->id}}"></td>
                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>

                                <br/><button type="button" id="newRole" class="btn btn-default"><i class="fa fa-plus"></i></button>
                                
                            </div>
                        </div>

                        <script type="text/javascript">

                        function makeTableSortable(){
                            $("#roles_list tbody").sortable({
                                stop: updateRank
                            });
                        }

                        function updateRank(){
                            var rank = 1;
                            $("input[name='role_rank\[\]']").each(function(){
                                $(this).val(rank++);
                            });
                        }

                        $("#newRole").click(function(){
                            $("#roles_list tbody").append('<tr><input type="hidden" name="role_id[]" value="NEW"><input type="hidden" name="role_rank[]" value=""><td style="cursor:move;padding-left:5px;padding-right:5px;"><i class="fa fa-sort"></i></td><td><input class="form-control" name="name[]" value=""></td><td><select name="type[]" class="form-control"><option value="exec">Exec</option><option value="admin">Site Admin</option><option value="chair">Chair</option></select></td><td>&nbsp;&nbsp;<input type="checkbox" class="" name="retire[]"></td></tr>');
                            makeTableSortable();
                            updateRank();
                        });

                        $(document).ready(makeTableSortable);
                        $(document).ready(updateRank);
                        
                        </script>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-user"></i> Submit
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
