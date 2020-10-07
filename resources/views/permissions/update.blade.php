@extends('layouts.master')

@section('content')


<h2 class="page-header">Permission</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify Permission    </div>

    <div class="panel-body">
                
        <form action="{{ url('/permissions'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PUT">
            @endif
            
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{$model['name']?:''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="slug" class="col-sm-3 control-label">Slug</label>
                <div class="col-sm-6">
                    <input type="text" name="slug" id="slug" class="form-control" value="{{$model['slug']?:''}}">
                </div>
            </div>
                        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/permissions') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection