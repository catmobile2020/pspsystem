@extends('layouts.master')

@section('title','statistics')
@section('css')

@endsection
@section('content')
    <div class="main-content">
        <h1 class="page-title">statistics</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>statistics</strong></li>
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
                                    <th>Order Serial</th>
                                    <th>CLIENT Card Number</th>
                                    <th>CLIENT Gender</th>
                                    <th>CLIENT Age</th>
                                    <th>CLIENT Governorate</th>
                                    <th>Pharmacy NAME</th>
                                    <th>PURCHASE TYPE</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->serial_number}}</td>
                                        <td>{{$row->patient->serial_number}}</td>
                                        <td>{{$row->patient->age}}</td>
                                        <td>{{$row->patient->sex ? 'Male' : 'Female'}}</td>
                                        <td>{{$row->patient->governorate->name}}</td>
                                        <td>{{$row->pharmacy->name}}</td>
                                        <td>
                                            <img src="{{$row->has_free_photo}}" />
                                        </td>
                                        <td>{{$row->created_at->format('Y-m-d h:i A')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
