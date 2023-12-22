
<?php $__env->startSection('title', 'Login'); ?>


<?php $__env->startPush('style'); ?>
    <style>
        .img-fluid {
            margin-top: 34%;
            max-width: 100%;
            height: auto;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('body'); ?>
    <h3><?php echo e($login_title); ?></h3>
    <form method="POST" action="<?php echo e(route($login_title == 'Admin Login' ? 'admin.login' : 'login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="email" class="fw-semibold">E-Mail Address</label>
            <input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>"
                id="email" name="email" placeholder="Enter email address">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3 mb-4">
            <label for="password" class="fw-semibold">Password</label>
            <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="password" placeholder="Enter password" required autocomplete="current-password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="row align-items-center">
            <div class="col-6">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input font-size-16" name="remember" id="remember"
                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">Remember
                        me</label>
                </div>
            </div>
            <div class="col-6">
                <div class="text-end">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                </div>
            </div>
            <?php if(Route::has('password.request')): ?>
                <div class="mt-4">
                    <a href="<?php echo e(route('password.request')); ?>" class="text-muted"><i class="mdi mdi-lock me-1"></i>
                        <?php echo e(__('Forgot your password?')); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\softolab\resources\views/auth/pages/login.blade.php ENDPATH**/ ?>