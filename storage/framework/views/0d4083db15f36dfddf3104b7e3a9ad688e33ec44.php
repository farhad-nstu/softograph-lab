<div class="card">
    <div class="card-header py-2">
        <h6>Add Checklist</h6>
    </div>
    <div class="card-body">
        <form id="card_checklist_form" action="<?php echo e(route('cards.store_card_checklist')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="form-group col-md">
                    <label for="checklist_title" class="col-form-label col-form-label-sm">Title</label>
                    <input type="hidden" id="checklist_id" name="checklist_id">
                    <input type="text" class="form-control form-control-sm isNonLeadingZeroNumber"
                        id="checklist_title"
                        name="checklist_title">
                    <div class="invalid-feedback">
                    </div>
                    <small style="color: red" id="id_checklist_title_text"></small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm submit_button" name="submit_button">Submit</button>
        </form>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/common/files/check_list_setter.blade.php ENDPATH**/ ?>