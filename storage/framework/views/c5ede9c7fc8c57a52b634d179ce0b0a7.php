<?php $__env->startSection('title', 'Главная'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12 order-1">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <div class="rounded w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(95, 97, 230, .3);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(95, 97, 230, 1);"><path d="M22 8a.76.76 0 0 0 0-.21v-.08a.77.77 0 0 0-.07-.16.35.35 0 0 0-.05-.08l-.1-.13-.08-.06-.12-.09-9-5a1 1 0 0 0-1 0l-9 5-.09.07-.11.08a.41.41 0 0 0-.07.11.39.39 0 0 0-.08.1.59.59 0 0 0-.06.14.3.3 0 0 0 0 .1A.76.76 0 0 0 2 8v8a1 1 0 0 0 .52.87l9 5a.75.75 0 0 0 .13.06h.1a1.06 1.06 0 0 0 .5 0h.1l.14-.06 9-5A1 1 0 0 0 22 16V8zm-10 3.87L5.06 8l2.76-1.52 6.83 3.9zm0-7.72L18.94 8 16.7 9.25 9.87 5.34zM4 9.7l7 3.92v5.68l-7-3.89zm9 9.6v-5.68l3-1.68V15l2-1v-3.18l2-1.11v5.7z"></path></svg>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                         aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="<?php echo e(route('package.all')); ?>">Все посылки</a>
                                        <a class="dropdown-item" href="<?php echo e(route('package.create')); ?>">Новая посылка</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Посылки</span>
                            <h3 class="card-title mb-2">0 шт.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <div class="rounded w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(3, 195, 236, .3);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(3, 195, 236, 1);"><path d="M21 4H3a1 1 0 0 0-1 1v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a1 1 0 0 0-1-1zm-9 9c-3.309 0-6-2.691-6-6h2c0 2.206 1.794 4 4 4s4-1.794 4-4h2c0 3.309-2.691 6-6 6z"></path></svg>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt2"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                         aria-labelledby="cardOpt2">
                                        <a class="dropdown-item" href="<?php echo e(route('order.table')); ?>">Все заказы</a>
                                        <a class="dropdown-item" href="<?php echo e(route('order.create')); ?>">Новый заказ</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Заказы</span>
                            <h3 class="card-title mb-2">12 шт.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>












































































































































































































































































































<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>