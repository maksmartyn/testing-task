@extends('layouts.master')

@section('content')


<h2 class="page-header">User_worker</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify User_worker    </div>

    <div class="panel-body">
                
        <form action="{{ url('/user_workers'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


                                    <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Id</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                </div>
            </div>
                                                                                                            <div class="form-group">
                <label for="login" class="col-sm-3 control-label">Login</label>
                <div class="col-sm-6">
                    <input type="text" name="login" id="login" class="form-control" value="{{$model['login'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" id="email" class="form-control" value="{{$model['email'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image</label>
                <div class="col-sm-6">
                    <input type="text" name="image" id="image" class="form-control" value="{{$model['image'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="about" class="col-sm-3 control-label">About</label>
                <div class="col-sm-6">
                    <input type="text" name="about" id="about" class="form-control" value="{{$model['about'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Type</label>
                <div class="col-sm-6">
                    <input type="text" name="type" id="type" class="form-control" value="{{$model['type'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="github" class="col-sm-3 control-label">Github</label>
                <div class="col-sm-6">
                    <input type="text" name="github" id="github" class="form-control" value="{{$model['github'] or ''}}">
                </div>
            </div>
                                                                                                            <div class="form-group">
                <label for="worker_id" class="col-sm-3 control-label">Worker Id</label>
                <div class="col-sm-2">
                    <input type="number" name="worker_id" id="worker_id" class="form-control" value="{{$model['worker_id'] or ''}}">
                </div>
            </div>
                                                
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/user_workers') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection