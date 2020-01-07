@extends('layouts.master')

@section('title','programs')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>programs</strong></li>
        </ol>
        <div class="col-lg-12 text-center">
            <a class="btn btn-primary" href="/{{explode('/',request()->route()->uri())[0]}}">
                <i class="icon-back"></i> Back to homepage</a>
        </div>
        <div class="height-50"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Edit Program
                    </div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{isset($program->id) ? route('programs.update',$program->id) : route('programs.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($program->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$program->name}}">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('programs.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
