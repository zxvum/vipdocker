<?php $__env->startSection('title', 'Скоро...'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-misc.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('include'); ?>
    <div class="container-xxl py-3">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Скоро появится...</h2>
            <p class="mb-4 mx-2">Мы создаем что-то потрясающее.</p>






            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">На главную</a>
            <div class="mt-5">
                <img src="<?php echo e(asset('assets/img/illustrations/boy-with-rocket-light.png')); ?>" alt="boy-with-rocket-light"
                     width="500"
                     class="img-fluid" data-app-dark-img="illustrations/boy-with-rocket-dark.png"
                     data-app-light-img="illustrations/boy-with-rocket-light.png">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.connection-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/coming-soon.blade.php ENDPATH**/ ?>