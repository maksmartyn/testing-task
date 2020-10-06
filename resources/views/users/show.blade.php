@extends('layouts.master')

@section('content')



<h2 class="page-header">User</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View User    </div>

    <div class="panel-body">
                

        <form action="{{ url('/users') }}" method="GET" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
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
            <label for="type" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-6">
                <input type="text" name="type" id="type" class="form-control" value="{{$model['type']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="github" class="col-sm-3 control-label">Github</label>
            <div class="col-sm-6">
                <input type="text" name="github" id="github" class="form-control" value="{{$model['github']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label">City</label>
            <div class="col-sm-6">
                <input type="text" name="city" id="city" class="form-control" value="{{$model['city']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="is_finished" class="col-sm-3 control-label">Is Finished</label>
            <div class="col-sm-6">
                <input type="text" name="is_finished" id="is_finished" class="form-control" value="{{$model['is_finished']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" name="phone" id="phone" class="form-control" value="{{$model['phone']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="birthday" class="col-sm-3 control-label">Birthday</label>
            <div class="col-sm-6">
                <input type="text" name="birthday" id="birthday" class="form-control" value="{{$model['birthday']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email_verified_at" class="col-sm-3 control-label">Email Verified At</label>
            <div class="col-sm-6">
                <input type="text" name="email_verified_at" id="email_verified_at" class="form-control" value="{{$model['email_verified_at']?:''}}" readonly="readonly">
            </div>
        </div>

        
                
        <div class="form-group">
            <label for="created_at" class="col-sm-3 control-label">Created At</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at']?:''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="updated_at" class="col-sm-3 control-label">Updated At</label>
            <div class="col-sm-6">
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at']?:''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/users') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection