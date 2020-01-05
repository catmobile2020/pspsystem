@extends('layouts.master')

@section('title','vouchers')

@section('content')
    <div class="main-content">
        <h1 class="page-title">vouchers</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>vouchers</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <a class="btn btn-primary btn-rounded" href="/{{explode('/',request()->route()->uri())[0]}}">Home</a>
                        <h3 class="panel-title">
                            <a class="btn btn-success btn-rounded" href="{{route('patient.vouchers.create',$patient->id)}}">Add Voucher</a>
                        </h3>
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
                                    <th>Verification code</th>
                                    <th>was_used</th>
                                    <th>notes</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>Eye Center NAME</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->code}}</td>
                                        <td><span class="label label-{{$row->was_used ? 'success':'danger'}}">{{$row->was_used ? 'Yes' : 'No'}}</span></td>
                                        <td>{{$row->notes}}</td>
                                        <td>{{$row->patient->serial_number}}</td>
                                        <td>{{$row->patient->name}}</td>
                                        <td>{{$row->user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Verification code</th>
                                    <th>was_used</th>
                                    <th>notes</th>
                                    <th>CLIENT CODE</th>
                                    <th>CLIENT NAME</th>
                                    <th>Eye Center NAME</th>
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
