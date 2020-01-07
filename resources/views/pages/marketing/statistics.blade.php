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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <a class="btn btn-primary btn-rounded" href="/{{explode('/',request()->route()->uri())[0]}}">Home</a>
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
                                    <th>Equation</th>
                                    <th>Orders</th>
                                    <th>Paid</th>
                                    <th>Free</th>
                                    <th>Patients</th>
                                    <th>Male </th>
                                    <th>Female</th>
                                    <th>Pharmacies</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{route('statistics.product',$row->id)}}">{{$row->name}}</a></td>
                                        <td>{{$row->paid_num.' : '.$row->free_num}}</td>
                                        <td><a href="{{route('statistics.product',$row->id)}}">{{$row->orders()->count()}}</a></td>
                                        <td>{{$row->orders()->where('has_free',0)->count()}}</td>
                                        <td>{{$row->orders()->where('has_free',1)->count()}}</td>
                                        <td>
                                            {{count($row->orders->unique('patient_id'))}}
                                        </td>
                                        <td>
                                            {{count($row->orders()->whereHas('patient',function ($patient){
                                                $patient->where('sex',1);
                                            })->get()->unique('patient_id'))}}
                                        </td>
                                        <td>
                                            {{count($row->orders()->whereHas('patient',function ($patient){
                                                $patient->where('sex',2);
                                            })->get()->unique('patient_id'))}}
                                        </td>
                                        <td>{{count($row->orders->unique('pharmacy_id'))}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                        <td><a href="{{route('statistics.product',$row->id)}}">
                                            <i class="fa fa-eye"></i></a></td>
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
