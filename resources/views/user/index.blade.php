@extends('layouts.app')

@section('content')
<style>
.modal-body label{
    font-size: 12px;
    padding-left: 0px;
}
input[type="text"], input[type="email"] {
        font-size: 12px;
        color: #010100;
        width: 100%;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Users<small>advanced tables</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
        
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users List</h3>
                        <div class="form-group pull-right">
                            <a href="{{ route('user_create') }}" class="btn btn-sm btn-primary">Create</a>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"><i class="fa fa-fw fa-filter"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <div class="flash-message">
							@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							  @if(Session::has('alert-' . $msg))

							  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
							  @endif
							@endforeach
                          </div> 
                           
                          
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" id="search-form" class="form-inline" role="form">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Filter</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                </div>
                                                <br />
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Role <span class="dengertext">*</span></label>
                                                    {!! Form::select('roles',$role_id,null,['class' => 'form-control', 'placeholder' => 'Please Select']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="email" class="col-md-12">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email">
                                                </div>
                                                <br />
                                                <div class="form-group">
                                                    <label for="name" class="col-md-12">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="yes">Enebled</option>
                                                        <option value="no">Disebled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="email" class="col-md-12">Username</label>
                                                    <input type="text" class="form-control" name="user_name" id="user_name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">Close</button>
                                        <button type="submit" id="search-form" class="btn btn-primary">Search</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection