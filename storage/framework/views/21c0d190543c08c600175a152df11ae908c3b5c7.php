<?php $__env->startSection('title', $title); ?>
<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/libs/toastr/css/toastr.min.css')); ?>">

    <style>
        .info {
            background-color: aqua;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title"><?php echo $__env->yieldContent('title'); ?></h4>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-2 float-end">
                                <a href="javascript:void(0)" id="cardCreateButton" class="btn btn-primary waves-effect"><i
                                    class="fas-light fas fa-plus"></i> Add New</a>
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-light waves-effect"><i
                                        class="fas-light fas fa-angle-double-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="col-md-12">
                        <div class="row">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"><?php echo e(strtoupper($status)); ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($card->status == $status): ?>
                                                    <a href="<?php echo e(route('cards.show', $card->id)); ?>" target="_blank">
                                                        <div class="row border p-2">
                                                            <h5><?php echo e($card->name); ?></h5>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('layouts.pages.common.files.card_create_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php echo $__env->make('layouts.pages.common.js.card_create_form_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="<?php echo e(asset('backend/assets/libs/toastr/js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/form_clearer.js')); ?>"></script>
    <script>
        $("#cardCreateButton").on("click", function() {
            $("#cardCreateModal").modal('show');
        });
        $(".modalCloseBtn").on("click", function() {
            $("#cardCreateModal").modal('hide');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/cards.blade.php ENDPATH**/ ?>