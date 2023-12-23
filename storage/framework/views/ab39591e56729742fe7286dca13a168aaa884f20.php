<div class="<?php echo e($wrap); ?>">
    <div class="mb-3">
        <?php if(isset($label)): ?>
            <label for="<?php echo e($id); ?>" class="form-label col-md-12"><?php echo e($label); ?><?php if(isset($required)): ?><span class="text-danger"> *</span><?php endif; ?></label>
        <?php endif; ?>

        <select name="<?php echo e($field); ?>"
            class="form-control form-select select2  <?php $__errorArgs = [$field];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <?php echo e(isset($class_name) ? $class_name : ''); ?>"
            id="<?php echo e(isset($id) ? $id : ''); ?>" placeholder="<?php echo e(isset($placeholder) ? $placeholder : ''); ?>" <?php echo e(isset($multiple) ? $multiple : ''); ?>

            style="width:100%!important" <?php echo e(isset($event) ? $event . '=' : ''); ?><?php echo e(isset($function) ? $function : ''); ?>

            <?php echo e(isset($event1) ? $event . '=' : ''); ?><?php echo e(isset($function1) ? $function : ''); ?>

            <?php echo e(isset($event2) ? $event . '=' : ''); ?><?php echo e(isset($function2) ? $function : ''); ?> <?php if(isset($disabled) && $disabled): ?> disabled <?php endif; ?>>
            <option value=""><?php echo e($placeholder); ?></option>
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value_type == 'indexed'): ?>
                    <option value="<?php echo e(isset($index) ? $key : $value); ?>"
                        <?php echo e(old($field, isset($current_value) ? $current_value : '') == (isset($index) ? $key : $value) ? 'selected' : ''); ?>>
                        <?php echo e(ucwords($value)); ?>

                    </option>
                <?php endif; ?>
                <?php if($value_type == 'associative'): ?>
                    <option value="<?php echo e($value[isset($index) ? $index : $key]); ?>"
                        <?php echo e(old($field, isset($current_value) ? $current_value : '') == $value[isset($index) ? $index : $key] && !is_null($value[isset($index) ? $index : $key]) ? 'selected' : ''); ?>>
                        <?php echo e(ucwords($value[$value_key])); ?>  <?php echo e(isset($second_value_key) ? '-'. ucwords($value[$second_value_key]):''); ?>

                    </option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php echo $errors->first($field, '<span class="invalid-feedback">:message</span>'); ?>


        
        <small id="<?php echo e(isset($id) ? $id : ''); ?>_id_text" style="color: red"></small>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/components/select.blade.php ENDPATH**/ ?>