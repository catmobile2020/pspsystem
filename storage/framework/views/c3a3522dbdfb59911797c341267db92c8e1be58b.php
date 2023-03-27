
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="auth_id" content="<?php echo e(auth()->id()); ?>">
    <title>PSP System | <?php echo $__env->yieldContent('title'); ?></title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo e(asset('assets/admin/images/favicon.ico')); ?>' />
    <!-- /site favicon -->

    <?php echo $__env->make('layouts.assets.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>
<body>

<!-- Page container -->
<div class="page-container">

   <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main container -->
    <div class="main-container" id="app">

        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(auth('marketing')->check()): ?>
                <div class="row" style="background-color: #f5f5f5; padding: 12px 50px">
                    <img class="center-block" src="<?php echo e(auth('marketing')->user()->company->photo); ?>" style="height: 115px">
                </div>
        <?php endif; ?>
        <!-- Main content -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- /main content -->

    </div>
    <!-- /main container -->

</div>
<!-- /page container -->

<?php echo $__env->make('layouts.assets.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH /home/catsw/psp.cat-sw.com/resources/views/layouts/master.blade.php ENDPATH**/ ?>