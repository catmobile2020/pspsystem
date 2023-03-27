<?php $__env->startSection('title','adverse'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <h1 class="page-title">adverse</h1>
        <!-- Breadcrumb -->
        <ol class="breadcrumb breadcrumb-2">
            <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i>Home</a></li>
            <li class="active"><strong>adverse</strong></li>
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
                                    <th>Report type</th>
                                    <th>Patient initials</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reaction onset date</th>
                                    <th>Suspected Novartis Drug</th>
                                    <th>Dose</th>
                                    <th>Indication</th>
                                    <th>Reaction description</th>
                                    <th>Is it serious</th>
                                    <th>Is it drug-related</th>
                                    <th>Concomitant medications</th>
                                    <th>Other relevant medical history</th>
                                    <th>Batch number</th>
                                    <th>Treating physician</th>
                                    <th>Reporter name</th>
                                    <th>Date</th>
                                    <th>NAME</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($row->report_type); ?></td>
                                        <td><?php echo e($row->patient_initials); ?></td>
                                        <td><?php echo e($row->age); ?></td>
                                        <td><?php echo e($row->gender); ?></td>
                                        <td><?php echo e($row->reaction_onset_date); ?></td>
                                        <td><?php echo e($row->suspected_novartis_drug); ?></td>
                                        <td><?php echo e($row->dose); ?></td>
                                        <td><?php echo e($row->indication); ?></td>
                                        <td><?php echo e($row->reaction_description); ?></td>
                                        <td><?php echo e($row->is_serious ? 'Yes' : 'No'); ?></td>
                                        <td><?php echo e($row->is_drug_related ? 'Yes' : 'No'); ?></td>
                                        <td><?php echo e($row->concomitant_medications); ?></td>
                                        <td><?php echo e($row->medical_history); ?></td>
                                        <td><?php echo e($row->batch_number); ?></td>
                                        <td><?php echo e($row->treating_physician); ?></td>
                                        <td><?php echo e($row->reporter_name); ?></td>
                                        <td><?php echo e($row->Date); ?></td>
                                        <td><?php echo e($row->callCenter->name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <?php echo $rows->links(); ?>

                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Report type</th>
                                    <th>Patient initials</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Reaction onset date</th>
                                    <th>Suspected Novartis Drug</th>
                                    <th>Dose</th>
                                    <th>Indication</th>
                                    <th>Reaction description</th>
                                    <th>Is it serious</th>
                                    <th>Is it drug-related</th>
                                    <th>Concomitant medications</th>
                                    <th>Other relevant medical history</th>
                                    <th>Batch number</th>
                                    <th>Treating physician</th>
                                    <th>Reporter name</th>
                                    <th>Date</th>
                                    <th>NAME</th>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Mahmoud\Desktop\pspsystem\resources\views/pages/adverse/index.blade.php ENDPATH**/ ?>