<?php $__env->startSection('title', 'Счета'); ?>

<div>
    <div class="row">
        <?php echo $__env->make('components.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список счетов</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="margin-right: 300%;">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.invoice.create.order')); ?>">Под заказ</a>
                                    <a class="dropdown-item" href="<?php echo e(route('admin.invoice.create.package')); ?>">Под посылку</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th>Кол-во услуг</th>
                            <th>Стоимость</th>
                            <th>Тип</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row1" data-id="<?php echo e($invoice->id); ?>">
                                <td><?php echo e($invoice->id); ?></td>
                                <td><?php echo e($invoice->user->fullname()); ?></td>
                                <td><?php echo e($invoice->status->name); ?></td>
                                <td><?php echo e($invoice->services->count()); ?></td>
                                <td><?php echo e($invoice->total_price); ?></td>
                                <td>
                                    <?php if($invoice->order_id): ?> Заказ <?php elseif($invoices->package_id): ?> Посылка <?php endif; ?>
                                </td>
                                <td class="d-flex justify-content-end">
                                    <?php if($invoice->order_id): ?>
                                        <a href="<?php echo e(route('admin.invoice.edit.order', ['invoice_id' => $invoice->id, 'order_id' => $invoice->order_id])); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <?php endif; ?>
                                    <button wire:click="deleteInvoice(<?php echo e($invoice->id); ?>)" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH /var/www/html/resources/views/livewire/admin/invoice/table.blade.php ENDPATH**/ ?>