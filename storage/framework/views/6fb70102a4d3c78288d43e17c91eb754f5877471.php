<div class="<?php echo e($wrap); ?>">
    <div class="mb-3">
        <?php if(isset($label)): ?>
            <label for="<?php echo e($id); ?>" class="form-label col-md-12"><?php echo e($label); ?><?php if(isset($required)): ?><span class="text-danger"> *</span><?php endif; ?></label>
        <?php endif; ?>
        <input type="<?php echo e($type); ?>" name="<?php echo e($field); ?>"
            class="form-control <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php echo e(isset($class_name) ? $class_name : ''); ?>"
            id="<?php echo e(isset($id) ? $id : ''); ?>" placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>"
            value="<?php echo e(old($field, isset($value) ? $value : '')); ?>"
            <?php echo e(isset($event) ? $event . '=' : ''); ?><?php echo e(isset($function) ? $function : ''); ?>

            <?php echo e(isset($event1) ? $event . '=' : ''); ?><?php echo e(isset($function1) ? $function : ''); ?>

            <?php echo e(isset($event2) ? $event . '=' : ''); ?><?php echo e(isset($function2) ? $function : ''); ?> <?php if(isset($disabled) && $disabled): ?> disabled <?php endif; ?> <?php if(isset($readOnly) && $readOnly): ?> readonly <?php endif; ?> <?php if(isset($required) && $required): ?> required <?php endif; ?>>
        <?php echo $errors->first($field, '<span class="invalid-feedback">:message</span>'); ?>


        
        <small id="<?php echo e(isset($id) ? $id : ''); ?>_text" style="color: red"></small>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/components/input.blade.php ENDPATH**/ ?>