<?php $__env->startSection('include'); ?>
    <?php echo $__env->yieldContent('modals'); ?>
    <div class="modal fade" id="balance" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="#" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Пополнение баланса</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="way" class="form-label">Выберите способ оплаты</label>
                            <select class="form-select" id="way" required>
                                <option selected>Мир/Visa/Mastercard</option>
                                <option>MTS</option>
                                <option>Tele 2</option>
                                <option>Biline</option>
                                <option>Megafone</option>
                                <option>BTC</option>
                                <option>YooMoney</option>
                                <option>Qiwi</option>
                                <option>СБП</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="promocode" class="form-label">Промокод</label>
                            <input type="text" maxlength="20" class="form-control" id="promocode" placeholder="Промокод (при наличии)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="amount" class="form-label">Сумма</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" list="prices" class="form-control" placeholder="Сумма пополнения" value="100" id="amount" required>
                                <span class="input-group-text">.00</span>
                            </div>
                            <datalist id="prices">
                                <option value="10"></option>
                                <option value="50"></option>
                                <option value="100"></option>
                                <option value="500"></option>
                                <option value="1000"></option>
                                <option value="3000"></option>
                                <option value="10000"></option>
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col gap-2 d-flex">
                            <input class="form-check-input" type="checkbox" value="" id="soglasen">
                            <label class="form-check-label" for="soglasen"> Принимаю условия <a href="#">Соглашения</a> </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Отменить
                    </button>
                    <button type="submit" class="btn btn-primary">Пополнить</button>
                </div>
            </form>
        </div>
    </div>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php echo $__env->make('components.sidebar-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.connection-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>