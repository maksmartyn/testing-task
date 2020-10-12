@extends('layouts.master')

@section('content')



<h2 class="page-header">User_worker</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View User_worker    </div>

    <div class="panel-body">
                

        <form action="{{ url('/user_workers') }}" method="GET" class="form-horizontal">


                
        <div class="form-group">
            <label for="login" class="col-sm-3 control-label">Login</label>
            <div class="col-sm-6">
                <input type="text" name="login" id="login" class="form-control" value="{{$model['login']}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="{{$model['email']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-6">
                <input type="text" name="image" id="image" class="form-control" value="{{$model['image']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="about" class="col-sm-3 control-label">About</label>
            <div class="col-sm-6">
                <input type="text" name="about" id="about" class="form-control" value="{{$model['about']?:''}}" readonly="readonly">
            </div>
        </div>
        
        
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/user_workers') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection