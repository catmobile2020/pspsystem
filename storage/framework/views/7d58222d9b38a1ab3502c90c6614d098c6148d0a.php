

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
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($row->serial_number); ?></td>
                                        <td><?php echo e($row->patient->serial_number); ?></td>
                                        <td><?php echo e($row->patient->age); ?></td>
                                        <td><?php echo e($row->patient->sex ? 'Male' : 'Female'); ?></td>
                                        <td><?php echo e($row->patient->governorate->name); ?></td>
                                        <td><?php echo e($row->pharmacy->name); ?></td>
                                        <td>
                                            <img src="<?php echo e($row->has_free_photo); ?>" />
                                        </td>
                                        <td><?php echo e($row->created_at->format('Y-m-d h:i A')); ?></td>
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/pages/marketing/order.blade.php ENDPATH**/ ?>