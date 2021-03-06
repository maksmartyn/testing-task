@extends('layouts.master')

@section('content')


<h2 class="page-header">User_worker</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Add User_worker    </div>

    <div class="panel-body">
                
        <form action="{{ url('/user_workers'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="POST">
            @endif


                                                            <div class="form-group">
                <label for="user_id" class="col-sm-3 control-label">User Id</label>
                <div class="col-sm-2">
                    <input type="number" name="user_id" id="user_id" class="form-control" value="{{$model['user_id'] or ''}}">
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