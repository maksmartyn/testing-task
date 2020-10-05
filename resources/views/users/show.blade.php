@extends('layouts.master')

@section('content')



<h2 class="page-header">User</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View User    </div>

    <div class="panel-body">
                

        <form action="{{ url('/users') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="login" class="col-sm-3 control-label">Login</label>
            <div class="col-sm-6">
                <input type="text" name="login" id="login" class="form-control" value="{{$model['login'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control" value="{{$model['email'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-6">
                <input type="text" name="image" id="image" class="form-control" value="{{$model['image'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="about" class="col-sm-3 control-label">About</label>
            <div class="col-sm-6">
                <input type="text" name="about" id="about" class="form-control" value="{{$model['about'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Type</label>
            <div class="col-sm-6">
                <input type="text" name="type" id="type" class="form-control" value="{{$model['type'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="github" class="col-sm-3 control-label">Github</label>
            <div class="col-sm-6">
                <input type="text" name="github" id="github" class="form-control" value="{{$model['github'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label">City</label>
            <div class="col-sm-6">
                <input type="text" name="city" id="city" class="form-control" value="{{$model['city'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="is_finished" class="col-sm-3 control-label">Is Finished</label>
            <div class="col-sm-6">
                <input type="text" name="is_finished" id="is_finished" class="form-control" value="{{$model['is_finished'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" name="phone" id="phone" class="form-control" value="{{$model['phone'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="birthday" class="col-sm-3 control-label">Birthday</label>
            <div class="col-sm-6">
                <input type="text" name="birthday" id="birthday" class="form-control" value="{{$model['birthday'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email_verified_at" class="col-sm-3 control-label">Email Verified At</label>
            <div class="col-sm-6">
                <input type="text" name="email_verified_at" id="email_verified_at" class="form-control" value="{{$model['email_verified_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-6">
                <input type="text" name="password" id="password" class="form-control" value="{{$model['password'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="remember_token" class="col-sm-3 control-label">Remember Token</label>
            <div class="col-sm-6">
                <input type="text" name="remember_token" id="remember_token" class="form-control" value="{{$model['remember_token'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_at" class="col-sm-3 control-label">Created At</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="updated_at" class="col-sm-3 control-label">Updated At</label>
            <div class="col-sm-6">
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly">
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