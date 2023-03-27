<?php $__env->startSection('title','products'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>products</strong></li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <ul class="panel-tool-options">
                            <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                            <li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
                            <li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(isset($product->id) ? route('products.update',$product->id) : route('products.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php if(isset($product->id)): ?>
                                <input type="hidden" name="_method" value="PUT"/>
                            <?php endif; ?>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?php echo e($product->name); ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="description"><?php echo e($product->name); ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="paid_num">paid num</label>
                                    <input type="text" name="paid_num" class="form-control" id="paid_num" placeholder="paid num" value="<?php echo e($product->paid_num); ?>" <?php echo e(isset($product->id) ? 'readonly' : ''); ?>>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="free_num">free num</label>
                                    <input type="text" name="free_num" class="form-control" id="free_num" placeholder="free num" value="<?php echo e($product->free_num); ?>" <?php echo e(isset($product->id) ? 'readonly' : ''); ?>>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="company_id">Company</label>
                                   <select class="form-control" name="company_id">
                                       <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($company->id); ?>" <?php echo e($company->id == $product->company_id ? 'selected' : ''); ?>><?php echo e($company->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="program_id">Program</label>
                                   <select class="form-control" name="program_id">
                                       <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($program->id); ?>" <?php echo e($program->id == $product->program_id ? 'selected' : ''); ?>><?php echo e($program->name); ?></option>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="photo">Pack Image</label>
                                    <input type="file" name="photo" class="form-control" id="photo" />
                                </div>
                            </div>
                            <?php if(isset($product->id)): ?>
                                <div class="col-lg-6">
                                    <img src="<?php echo e($product->photo); ?>" class="img-responsive"/>
                                </div>
                            <?php endif; ?>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Mahmoud\Desktop\pspsystem\resources\views/pages/product/form.blade.php ENDPATH**/ ?>