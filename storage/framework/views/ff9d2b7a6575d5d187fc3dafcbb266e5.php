<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/vendor/css/pages/page-auth.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('include'); ?>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <?php echo $__env->yieldContent('content'); ?>
                <!-- /Register -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.connection-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/sallyqx/Desktop/archive/resources/views/layouts/auth.blade.php ENDPATH**/ ?>