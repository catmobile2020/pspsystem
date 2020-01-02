@extends('layouts.master')

@section('title','products')

@section('content')
    <div class="main-content">
        <h1 class="page-title">products</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>products</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <a href="{{route('products.create')}}" class="btn btn-success">Add New</a>
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
                                    <th>Description</th>
                                    <th>Company</th>
                                    <th>Program</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->description}}</td>
                                        <td>{{$row->company->name}}</td>
                                        <td>{{$row->program->name}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                        <td class="size-80">
                                            <a href="{{route('products.edit',$row->id)}}">Edit</a>
{{--                                            <a href="{{route('products.destroy',$row->id)}}">Delete</a>--}}
{{--                                            <div class="dropdown">--}}
{{--                                                <a href="" data-toggle="dropdown" class="more-link"><i class="icon-dot-3 ellipsis-icon"></i></a>--}}
{{--                                                <ul class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <li><a href="{{route('products.edit',$row->id)}}">Edit</a></li>--}}
{{--                                                    <li><a href="{{route('products.destroy',$row->id)}}">Delete</a></li>--}}
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
                                    <th>Description</th>
                                    <th>Company</th>
                                    <th>Program</th>
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
