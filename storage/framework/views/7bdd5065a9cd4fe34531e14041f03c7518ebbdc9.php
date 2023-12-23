<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="<?php echo e(url('home')); ?>" class="waves-effect">
                        <i class='bx bxs-dashboard'></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(card_permissions())): ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-share-alt'></i>
                            <span key="t-multi-level">Card Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cards.index')): ?>
                                <li><a href="<?php echo e(route('cards.index')); ?>"><?php echo e(__('Card List')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cards.create')): ?>
                                <li><a href="<?php echo e(route('cards.create')); ?>"><?php echo e(__('Add New Card')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\softolab\resources\views/layouts/inc/navbar.blade.php ENDPATH**/ ?>