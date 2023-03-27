<!-- Main header -->
<div class="main-header row">
    <div class="col-sm-6 col-xs-7">

        <!-- User info -->
        <ul class="user-info pull-left">
            <li class="profile-info dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">








                </a>
            </li>
        </ul>
        <!-- /user info -->

    </div>

    <div class="col-sm-6 col-xs-5">
        <div class="pull-right">
            Welcome, <?php echo e(auth(explode('/',request()->route()->uri())[0])->user()->name); ?> |
            <a href="<?php echo e(route(explode('/',request()->route()->uri())[0].'.logout')); ?>">Logout <i class="icon-logout"></i> </a>
            <ul class="user-info pull-left">

                <!-- Notifications -->
                 <notify></notify>
                <!-- /notifications -->
            </ul>
        </div>
    </div>
</div>
<!-- /main header -->
<?php /**PATH /Users/ahmed_adel/Downloads/psp.cat-sw.com/resources/views/layouts/header.blade.php ENDPATH**/ ?>