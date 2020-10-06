@extends('layouts.master')

@section('content')



<h2 class="page-header">Role</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Role    </div>

    <div class="panel-body">
                

        <form action="{{ url('/roles') }}" method="GET" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="slug" class="col-sm-3 control-label">Slug</label>
            <div class="col-sm-6">
                <input type="text" name="slug" id="slug" class="form-control" value="{{$model['slug']?:''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/roles') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection