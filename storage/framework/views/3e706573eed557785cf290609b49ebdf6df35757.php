

<?php $__env->startSection('title','doctors'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <h1 class="page-title">doctors</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>doctors</strong></li>
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
                        <a href="<?php echo e(route('doctors.create')); ?>" class="btn btn-success">Add New</a>
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
                                    <th>name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>specialty</th>
                                    <th>call center</th>
                                    <th>Created At</th>
                                    <th>Patient Cards</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->username); ?></td>
                                        <td><?php echo e($row->email); ?></td>
                                        <td><?php echo e($row->specialty); ?></td>
                                        <td><?php echo e($row->callCenter->name); ?></td>
                                        <td><?php echo e($row->created_at->format('Y-m-d')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('doctors.cards',$row->id)); ?>" class="btn btn-info">Patient Cards</a>
                                        </td>
                                        <td class="size-80">
                                            <div class="btn-group-vertical">
                                                <a class="btn btn-blue" href="<?php echo e(route('doctors.edit',$row->id)); ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                                <a class="btn btn-danger" href="<?php echo e(route('doctors.destroy',$row->id)); ?>"><i class="fa fa-trash-o"></i> Delete</a>
                                            </div>







                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <?php echo $rows->links(); ?>

                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>username</th>
                                    <th>email</th>
                                    <th>specialty</th>
                                    <th>call center</th>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/pages/doctor/index.blade.php ENDPATH**/ ?>