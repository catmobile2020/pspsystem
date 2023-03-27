

<?php $__env->startSection('title','companies'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <h1 class="page-title">companies</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>companies</strong></li>
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
                        <a href="<?php echo e(route('companies.create')); ?>" class="btn btn-success">Add New</a>
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
                                    <th>Address</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($row->name); ?></td>
                                        <td><?php echo e($row->address); ?></td>
                                        <td><?php echo e($row->created_at->format('Y-m-d')); ?></td>
                                        <td class="size-80">
                                            <div class="btn-group-vertical">
                                                <a class="btn btn-blue" href="<?php echo e(route('marketing.index',$row->id)); ?>"><i class="fa fa-users"></i> Users</a>
                                                <a class="btn btn-info" href="<?php echo e(route('companies.edit',$row->id)); ?>"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                            </div>
                                               







                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <?php echo $rows->links(); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/pages/company/index.blade.php ENDPATH**/ ?>