<?php $__env->startSection('content'); ?>
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Профиль /</span> <?php echo $__env->yieldContent('title'); ?>
    </h4>
    <div class="col-md-12" data-select2-id="15">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link <?php echo e(request()->is('profile/account') ? 'active' : ''); ?>" href="<?php echo e(route('profile.account')); ?>"><i class="bx bx-user me-1"></i> Аккаунт</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->is('profile/security') ? 'active' : ''); ?>" href="<?php echo e(route('profile.security')); ?>"><i class="bx bx-lock-alt me-1"></i> Безопасность</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->is('profile/bills-and-payments') ? 'active' : ''); ?>" href="<?php echo e(route('profile.bills-and-payments')); ?>"><i class="bx bx-detail me-1"></i> Платежи &amp; Счета</a></li>
            <li class="nav-item"><a class="nav-link <?php echo e(request()->is('profile/connection') ? 'active' : ''); ?>" href="<?php echo e(route('soon')); ?>"><i class="bx bx-link-alt me-1"></i> Способы входа</a></li>
        </ul>
        <?php echo $__env->yieldContent('profile'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/layouts/profile.blade.php ENDPATH**/ ?>