@extends('layouts.master')

@section('title','patients')

@section('content')
    <div class="main-content">
        <h1 class="page-title">patients</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>tests</strong></li>
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
                        Patients
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success text-center sr-only" id="statusResult">

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>call center</th>
                                    <th>All packs</th>
                                    <th>Paid packs</th>
                                    <th>Free packs</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr class="gradeX">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->callCenter->name}}</td>
                                        <td>{{ $row->patientOrders->count() }}</td>--}}
                                         <td>{{ $row->patientOrders->where('has_free', 0)->count() }}</td>
                                        <td>{{ $row->patientOrders->where('has_free', 1)->count()}}</td>
                                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                                        <td>
                                            <a class="btn btn-success" href="{{route('my-orders.singlePatient',$row->id)}}"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {!! $rows->links() !!}
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>call center</th>
                                    <th>All packs</th>
                                    <th>Paid packs</th>
                                    <th>Free packs</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
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

@section('js')
    <script>
        $(document).on('change','.changeStatus',function () {
            let  active = $(this).val();
            let  id = $(this).data('id');
            $.ajax({
                data:{id:id,active:active},
                success:function (result) {
                    $('#statusResult').removeClass('sr-only');
                    $('#statusResult').html(result);
                },
                error:function (errors) {
                    console.log(errors);
                }
            });
        });
    </script>
@endsection
