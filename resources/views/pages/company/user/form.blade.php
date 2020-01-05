@extends('layouts.master')

@section('title','users')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>users</strong></li>
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
                        <form action="{{isset($marketing->id) ? route('marketing.update',[$company->id,$marketing->id]) : route('marketing.store',$company->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($marketing->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$marketing->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="username" value="{{$marketing->username}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{$marketing->email}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>type</label>
                                    <select name="type" class="form-control changeType">
                                        <option value="2" {{$marketing->type == 2 ? 'selected' : ''}}>User</option>
                                        <option value="1" {{$marketing->type == 1 ? 'selected' : ''}}>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 {{$marketing->type == 1 ? 'sr-only' : ''}} " id="typeProductType">
                                <div class="form-group">
                                    <label for="title">Product</label>
                                    <select name="product_id" class="form-control">
                                        <option selected value>Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" {{$marketing->product_id == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password confirmation">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="{{route('marketing.index',$company->id)}}" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('.changeType').change(function () {
        let value=$(this).val();
        if(value == 1)
        {
            $('#typeProductType').addClass('sr-only');
        }else
        {
            $('#typeProductType').removeClass('sr-only');
        }
    });
</script>
@endsection
