<div>
    <?php $__env->startSection('title', 'Таблица посылок'); ?>
    <?php echo $__env->make('components.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список посылок</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="btn-group-sm">
                            <a href="<?php echo e(route('admin.package.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form wire:submit.prevent="filter" class="d-flex align-items-center justify-content-between" style="padding: 0.75rem 1.25rem; border-bottom: 1px solid rgba(0,0,0,.125);">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <select wire:model="status_filter" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="-1">Все статусы</option>
                        <?php $__currentLoopData = $package_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <select wire:model="sort_direction" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="DESC">Самые новые</option>
                        <option value="ASC">Самые старые</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Применить</button>
                </div>
            </form>

            <div class="card-body table-responsive p-0">
                <table id="table" class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Заказчик</th>
                        <th>Статус</th>
                        <th>Товаров</th>
                        <th>Цена</th>
                        <th class="d-flex justify-content-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody id="tablecontents">
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row1" wire:id="package-<?php echo e($package->id); ?>">
                            <td><?php echo e($package->id); ?></td>
                            <td><?php echo e($package->name); ?></td>
                            <td><?php echo e($package->user->name); ?> <?php echo e($package->user->surname); ?></td>
                            <td>
                            <p style="color: <?php echo e($package->status->hex); ?>;"><?php echo e($package->status->name); ?></p>
                            </td>
                            <td>
                                <?php
                                    $cost = 0;
                                    foreach ($package->products as $product){
                                        $cost = $cost + ($product->price * $product->quantity);
                                    }
                                    echo $cost
                                ?> $
                            </td>
                            <td class="d-flex justify-content-end">
                                <a href="<?php echo e(route('admin.order.edit', ['id' => $order->id])); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                <button wire:click="delete(<?php echo e($package->id); ?>)" class="btn btn-danger" onclick="confirm('Вы действительно хотите удалить посылку?')"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/package/table.blade.php ENDPATH**/ ?>