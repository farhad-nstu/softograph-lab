<?php $__env->startSection('title', $title); ?>
<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/fileinput.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/libs/toastr/css/toastr.min.css')); ?>">

    <style>
        .info {
            background-color: aqua;
        }
        #uploaded_documents {
            max-height: 355px;
            overflow-y: auto;
        }
        #added_expenses {
            max-height: 189px;
            overflow-y: auto;
        }
        #uploaded_documents img {
            height: 100px;
            width: 100px;
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
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-light waves-effect"><i
                                        class="fas-light fas fa-angle-double-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route(\Request::route()->getName())); ?>" method="get">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="card_id">Cards</label>
                                <select name="card_id" id="card_id"
                                    class="form-control select2"
                                    style="width:100%">
                                    <option value="">-------</option>
                                    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($card->id); ?>"><?php echo e($card->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status"
                                    class="form-control select2"
                                    style="width:100%">
                                    <option value="">-------</option>
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="mb-0 mb-md-3">
                                <button type="submit" class="btn btn-success">Search</button>
                                <a href="<?php echo e(route(\Request::route()->getName())); ?>" class="btn btn-info">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped  nowrap w-100">
                        <thead>
                            <tr class="table-hd-bg">
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($cards && count($cards) > 0): ?>
                                <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($card->name); ?></td>
                                        <td><?php echo e($card->status); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cards.show')): ?>
                                                <a href="<?php echo e(route('cards.show', $card->id)); ?>"
                                                    class="btn btn-primary waves-effect waves-light" target="_blank"><i class="fas fa-eye"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/cards.blade.php ENDPATH**/ ?>