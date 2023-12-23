<div class="modal fade" id="cardCreateModal" tabindex="-1" role="dialog" aria-labelledby="cardCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="id_card_create_form" action="<?php echo e(route('cards.store_card')); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="cardCreateModalLabel">Modal title</h5>
                    <button type="button" class="close modalCloseBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="card_title">Title</label>
                                <input type="text" name="name" id="card_title" class="form-control">
                            </div>
                            <small id="id_name_text" style="color: red"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="status1">Status</label>
                                <select name="status" id="status1"
                                    class="form-control">
                                    <option value="">-------</option>
                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>"><?php echo e($status); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <small id="id_status_text" style="color: red"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modalCloseBtn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/common/files/card_create_modal.blade.php ENDPATH**/ ?>