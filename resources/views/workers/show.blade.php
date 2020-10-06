@extends('layouts.master')

@section('content')



<h2 class="page-header">Worker</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Worker    </div>

    <div class="panel-body">
                

        <form action="{{ url('/workers') }}" method="GET" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="department_id" class="col-sm-3 control-label">Department Id</label>
            <div class="col-sm-6">
                <input type="text" name="department_id" id="department_id" class="form-control" value="{{$model['department_id']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="position_id" class="col-sm-3 control-label">Position Id</label>
            <div class="col-sm-6">
                <input type="text" name="position_id" id="position_id" class="form-control" value="{{$model['position_id']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="adopted_at" class="col-sm-3 control-label">Adopted At</label>
            <div class="col-sm-6">
                <input type="text" name="adopted_at" id="adopted_at" class="form-control" value="{{$model['adopted_at']?:''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/workers') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection