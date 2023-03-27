 

<?php $__env->startSection('title','patients'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>patients</strong></li>
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
                        Patients
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
                        <?php if(session()->has('message')): ?>
                            <div class="alert alert-info">
                                <h4><?php echo e(session()->get('message')); ?></h4>
                            </div>
                        <?php endif; ?>
                        <div class="alert alert-success text-center sr-only" id="statusResult">

                        </div>
                        <form action="<?php echo e(isset($patient->id) ? route('patients.update',$patient->id) : route('patients.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php if(isset($patient->id)): ?>
                                <input type="hidden" name="_method" value="PUT"/>
                            <?php endif; ?>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="serial_number">Patient Card</label>
                                    <input type="text" name="serial_number" class="form-control serialValue" id="serial_number" placeholder="Patient Card" value="<?php echo e($patient->serial_number); ?>">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <a href="<?php echo e(route('patients.check-serial')); ?>" class="btn btn-info checkSerialCode">Check</a>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Select Doctor</label>
                                    <select class="form-control select" name="doctor_id" id="selectDoctor">
                                        <option selected value>Select Doctor</option>
                                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($doctor->id); ?>" <?php echo e($doctor->id == $patient->doctor_id ? 'selected' : ''); ?>><?php echo e($doctor->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?php echo e($patient->name); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">username</label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="username" value="<?php echo e($patient->username); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email" value="<?php echo e($patient->email); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="national_id">national id</label>
                                    <input type="text" name="national_id" class="form-control" id="national_id" placeholder="national_id" value="<?php echo e($patient->national_id); ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="age">age</label>
                                    <input type="number" min="1" name="age" class="form-control" id="age" placeholder="age" value="<?php echo e($patient->age); ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="email">sex</label>
                                    <select class="form-control" name="sex">
                                        <option value="1" <?php echo e($patient->sex ? 'selected' : ''); ?>>Male</option>
                                        <option value="2" <?php echo e($patient->sex ? '' : 'selected'); ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="address" value="<?php echo e($patient->address); ?>">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="specialty">Governorate</label>
                                    <select name="governorate_id" class="form-control" id="selectGovernorate">
                                        <option selected value>Select Governorate</option>
                                        <?php $__currentLoopData = $governorates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $governorate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($governorate->id); ?>" <?php echo e($governorate->id == $patient->governorate_id ? 'selected' : ''); ?>><?php echo e($governorate->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="phone">phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="phone" value="<?php echo e($patient->phone); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">diagnosis</label>
                                    <input type="text" name="diagnosis" class="form-control" id="diagnosis" placeholder="diagnosis" value="<?php echo e($patient->diagnosis); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="password">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password confirmation">
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-4">
                                <a href="<?php echo e(route('patients.index')); ?>" class="btn btn-white">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 <script>
     $(document).on('click','.checkSerialCode',function (e) {
         e.preventDefault();

         let serial = $('.serialValue').val();
         $.ajax({
             url:'<?php echo e(route('patients.check-serial')); ?>',
             data:{serial:serial},
             success:function (result) {
                 console.log(result);
                 if (result.status)
                 {
                    $('#selectDoctor').val(result.data['doctor_id']);
                    $('#selectGovernorate').val(result.data['governorate_id']);
                     console.log(result);
                 }
                 $('#statusResult').html(result.message);
                 $('#statusResult').removeClass('sr-only');
                 setTimeout(function () {
                     $('#statusResult').addClass('sr-only');
                 },3000)
             },
             error:function (errors) {
                 console.log(errors);
             }
         });
     });
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/pages/patient/form.blade.php ENDPATH**/ ?>