@extends('layouts.master')

@section('title','companies')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>companies</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <a class="btn btn-primary btn-rounded" href="/{{explode('/',request()->route()->uri())[0]}}">Home</a>
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
                        <form action="{{isset($company->id) ? route('companies.update',$company->id) : route('companies.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($company->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$company->name}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="description">{{$company->name}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="url">Website url</label>
                                    <input type="text" name="url" class="form-control" id="url" placeholder="url" value="{{$company->url}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="map_link">map link</label>
                                    <input type="text" name="map_link" class="form-control" id="map_link" placeholder="map link" value="{{$company->map_link}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="address" value="{{$company->address}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">Logo</label>
                                    <input type="file" name="photo" class="form-control" id="photo" />
                                </div>
                            </div>
                            @isset($company->id)
                                <div class="col-lg-6">
                                    <img src="{{$company->photo}}" class="img-responsive"/>
                                </div>
                            @endisset
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('companies.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
