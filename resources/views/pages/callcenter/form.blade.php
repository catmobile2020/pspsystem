@extends('layouts.master')

@section('title','call centers')

@section('content')
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>call centers</strong></li>
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
                        Call centers
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
                        <form action="{{isset($callcenter->id) ? route('callcenters.update',$callcenter->id) : route('callcenters.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @isset($callcenter->id)
                                <input type="hidden" name="_method" value="PUT"/>
                            @endisset
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{$callcenter->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="username" value="{{$callcenter->username}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{$callcenter->email}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="title">Company</label>
                                    <select name="" class="form-control changeCompany">
                                        <option selected disabled value>Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}" {{in_array($callcenter->product_id ,$company->products()->pluck('id')->toArray()) ? 'selected' : ''}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group insertCompanyProduct">
                                    <label for="title">Product</label>
                                    <select name="product_id" class="form-control">
                                        <option selected value>Select Product</option>
                                        @isset($callcenter->id)
                                            @foreach($callcenter->product->company->products as $product)
                                                <option value="{{$product->id}}" {{$callcenter->product_id == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                            @endforeach
                                        @endisset
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
                                <a href="{{route('callcenters.index')}}" class="btn btn-white">Cancel</a>
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
    $(document).on('change','.changeCompany',function () {
        let value = $(this).val();
        if (!value)
        {
            return;
        }
        $.ajax({
            url:'/admin/callcenters/companies/'+value,
            success:function (result) {
                console.log(result);
                $('.insertCompanyProduct').html(result);
            },
            error:function (errors) {
                console.log(errors);
            }
        });
    });
</script>
@endsection
