

<?php $__env->startSection('title','statistics'); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <h1 class="page-title">statistics</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>statistics</strong></li>
        </ol>

        <div class="col-lg-12 text-center">
            <a class="btn btn-primary" href="/<?php echo e(explode('/',request()->route()->uri())[0]); ?>">
                <i class="icon-back"></i> Back to homepage</a>
        </div>
        <div class="height-50"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                    </div>
                    <div class="panel-body">
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-info">
                                <h4><?php echo e(session()->get('message')); ?></h4>
                            </div>
                        <?php endif; ?>
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
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><a href="<?php echo e(route('statistics.product',$row->id)); ?>"><?php echo e($row->name); ?></a></td>
                                        <td><?php echo e($row->paid_num.' : '.$row->free_num); ?></td>
                                        <td><a href="<?php echo e(route('statistics.product',$row->id)); ?>"><?php echo e($row->orders()->count()); ?></a></td>
                                        <td><?php echo e($row->orders()->where('has_free',0)->count()); ?></td>
                                        <td><?php echo e($row->orders()->where('has_free',1)->count()); ?></td>
                                        <td>
                                            <?php echo e(count($row->orders->unique('patient_id'))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(count($row->orders()->whereHas('patient',function ($patient){
                                                $patient->where('sex',1);
                                            })->get()->unique('patient_id'))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(count($row->orders()->whereHas('patient',function ($patient){
                                                $patient->where('sex',2);
                                            })->get()->unique('patient_id'))); ?>

                                        </td>
                                        <td><?php echo e(count($row->orders->unique('pharmacy_id'))); ?></td>
                                        <td><?php echo e($row->created_at->format('Y-m-d')); ?></td>
                                        <td><a href="<?php echo e(route('statistics.product',$row->id)); ?>">
                                            <i class="fa fa-eye"></i></a></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/pages/marketing/statistics.blade.php ENDPATH**/ ?>