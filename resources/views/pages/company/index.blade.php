@extends('layouts.master')

@section('title','companies')

@section('content')
    <div class="main-content">
        <h1 class="page-title">companies</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>companies</strong></li>
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
                        <a href="{{route('companies.create')}}" class="btn btn-success">Add New</a>
                    </div>
                    <div class="panel-body">
                        @if (session()->has('message'))
                            <div class="alert alert-info">
                               <h4>{{session()->get('message')}}</h4>
                            </div>
                        @endif
                            <div class="alert alert-success text-center sr-only" id="statusResult">

                            </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->address}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                        <td class="size-80">
                                            <div class="btn-group-vertical">
                                                <a class="btn btn-blue" href="{{route('marketing.index',$row->id)}}"><i class="fa fa-users"></i> Users</a>
                                                <a class="btn btn-info" href="{{route('companies.edit',$row->id)}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                            </div>
                                               {{--<a href="{{route('companies.destroy',$row->id)}}">Delete</a>--}}
{{--                                            <div class="dropdown">--}}
{{--                                                <a href="" data-toggle="dropdown" class="more-link"><i class="icon-dot-3 ellipsis-icon"></i></a>--}}
{{--                                                <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <li><a href="{{route('companies.edit',$row->id)}}">Edit</a></li>--}}
{{--                                                    <li><a href="{{route('companies.destroy',$row->id)}}">Delete</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
