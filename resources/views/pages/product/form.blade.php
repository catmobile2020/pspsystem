@extends('layouts.master')

@section('title','products')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>products</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
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
                        <form action="{{isset($product->id) ? route('products.update',$product->id) : route('products.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($product->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$product->name}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="description">{{$product->name}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paid_num">paid num</label>
                                    <input type="text" name="paid_num" class="form-control" id="paid_num" placeholder="paid num" value="{{$product->paid_num}}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="free_num">free num</label>
                                    <input type="text" name="free_num" class="form-control" id="free_num" placeholder="free num" value="{{$product->free_num}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company_id">Company</label>
                                   <select class="form-control" name="company_id">
                                       @foreach($companies as $company)
                                           <option value="{{$company->id}}" {{$company->id == $product->company_id ? 'selected' : ''}}>{{$company->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="program_id">Program</label>
                                   <select class="form-control" name="program_id">
                                       @foreach($programs as $program)
                                           <option value="{{$program->id}}" {{$program->id == $product->program_id ? 'selected' : ''}}>{{$program->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">Pack Image</label>
                                    <input type="file" name="photo" class="form-control" id="photo" />
                                </div>
                            </div>
                            @isset($product->id)
                                <div class="col-lg-6">
                                    <img src="{{$product->photo}}" class="img-responsive"/>
                                </div>
                            @endisset
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('products.index')}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
