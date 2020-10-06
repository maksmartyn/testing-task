@extends('layouts.master')

@section('content')


<h2 class="page-header">Worker</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify Worker    </div>

    <div class="panel-body">
                
        <form action="{{ url('/workers'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PUT">
            @endif
                                                                   
            <div class="form-group">
                <label for="department_id" class="col-sm-3 control-label">Department Id</label>
                <div class="col-sm-2">
                    <input type="number" name="department_id" id="department_id" class="form-control" value="{{$model['department_id']?:''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="position_id" class="col-sm-3 control-label">Position Id</label>
                <div class="col-sm-2">
                    <input type="number" name="position_id" id="position_id" class="form-control" value="{{$model['position_id']?:''}}">
                </div>
            </div>
                                                                                                                        <div class="form-group">
                <label for="adopted_at" class="col-sm-3 control-label">Adopted At</label>
                <div class="col-sm-6">
                    <input type="date" name="adopted_at" id="adopted_at" class="form-control" value="{{$model['adopted_at']?:''}}">
                </div>
            </div>
                        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/workers') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection