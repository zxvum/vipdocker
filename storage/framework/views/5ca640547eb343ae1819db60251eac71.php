<div>
    <?php $__env->startSection('title', 'Счета и платежи'); ?>


    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Оплата счета</h5>
                    <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Вы уверены что хотите оплатить счет?</strong> <br/>
                    Стоимость чека:
                </div>
                <div class="modal-footer">
                    <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h5 class="mb-0">Все ваши счета</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Тип</th>
                            <th>Название</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">Сумма</th>
                            <th class="text-center">Услуг</th>
                            <th class="text-center">
                                Действия
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        <?php if($invoices->count() >= 1): ?>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($invoice->id); ?></td>
                                    <td><?php echo e($invoice->order_id ? 'Заказ' : 'Посылка'); ?></td>
                                    <td>
                                        <?php if($invoice->order_id): ?>
                                            <?php echo e($invoice->order->title); ?>

                                        <?php elseif($invoice->package_id): ?>
                                            <?php echo e($invoice->package->title); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge bg-label-<?php echo e($invoice->status->color); ?> me-1"><?php echo e($invoice->status->name); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php echo e($invoice->total_price + $invoice->tax); ?>$
                                    </td>
                                    <td class="text-center"><?php echo e($invoice->services()->count()); ?></td>
                                    <td class="text-end">
                                        <?php if($invoice->status_id != 4): ?>
                                            <button wire:click="payInvoice(<?php echo e($invoice->id); ?>)" class="btn btn-primary">Оплатить счет</button>
                                        <?php endif; ?>
                                        <button class="btn btn-outline-primary"><i class='bx bx-show'></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">У вас еще нет чеков на оплату.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('components.toasts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/profile/billing-and-payments.blade.php ENDPATH**/ ?>