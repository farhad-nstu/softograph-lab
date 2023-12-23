<?php $__env->startSection('title', 'CARD DETAILS'); ?>
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
    <div class="row">
        <?php if($errors->any() && !old('_method')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    CARD INFORMATION
                                </div>
                                <div class="card-body">
                                    <form id="id_card_edit_form" method="POST" action="<?php echo e(route('cards.update_card')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="card_id" id="card_id" value="<?php echo e($card->id); ?>">
                                        <div class="row">
                                            <?php echo $__env->make('layouts.components.input', [
                                                'wrap' => 'col-md-6',
                                                'label' => 'Card name',
                                                'type' => 'text',
                                                'field' => 'name',
                                                'id' => 'id_card_name',
                                                'placeholder' => 'Card name',
                                                'required' => true,
                                                'value' => $card->name
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('layouts.components.select', [
                                                'wrap' => 'col-md-6',
                                                'label' => 'Status',
                                                'field' => 'status',
                                                'id' => 'status1',
                                                'placeholder' => 'Choose One',
                                                'values' => $statuses,
                                                'value_type' => 'indexed',
                                                'value_key' => 'name',
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submit_card">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.attachment_uploader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.attachment_setter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.check_list_setter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.check_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.task_list_setter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-md">
                            <?php echo $__env->make('layouts.pages.common.files.task_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php echo $__env->make('layouts.pages.common.js.card_edit_form_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.pages.common.js.card_attachment_uploader_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.pages.common.js.card_attachment_setter_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.pages.common.js.card_checklist_setter_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.pages.common.js.card_task_setter_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="<?php echo e(asset('backend/assets/libs/toastr/js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/form_clearer.js')); ?>"></script>

<script>
    $("#document_submit_button").attr('disabled',true)

    $("#card_documents").fileinput({
        'showUpload': false,
        'previewFileType': 'any',
        'allowedFileExtensions': ['jpg', 'jpeg', 'png', 'pdf'],
    });

    $(document).ready(function(){
        setTimeout(function(){
            $('#id_card_name').trigger('click');
        }, 2000);
    });

    $("#id_card_name").on("click", function () {
        get_card_details();
    });

    $("#id_card_name").on("blur change", function () {
        get_card_details();
    });

    function unset_fields() {
        $("#id_card_name").val('');
        $("#status1").val('');
    }

    function get_card_details() {
        if ($("#card_id").val() == "") {
            unset_fields();
            return false;
        }
        axios.get("<?php echo e(route('cards.get_card_details')); ?>", {
                params: {
                    card_no: $("#card_id").val(),
                }
            })
            .then(function (response) {
                if (response.data.length <= 0) {
                    unset_fields();
                    return false;
                }
                data = response.data.data;

                if (Object.entries(data).length === 0 && data.constructor === Object) { // checking for empty response
                    unset_fields();
                    return false;
                }

                $("#status1").val(data.status).trigger("change");
                $("#document_submit_button").attr('disabled',false)
            })
            .then(function () {
                set_card_documents(data.card_attachments);
                set_card_checklists(data.card_checklists);
                set_card_tasks(data.card_tasks);
            })
            .catch(function (error) {
                unset_fields();
                if(error.response){
                    let status = error.response.status;
                    message = error.response.data.message
                    if(status == 422){
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(message);
                        return false;
                    }
                    if(status == 404){
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(message);
                        return false;
                    }
                    if (error instanceof ReferenceError) {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(error.message);
                    }
                    return false;
                }
            });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/pages/card_details.blade.php ENDPATH**/ ?>