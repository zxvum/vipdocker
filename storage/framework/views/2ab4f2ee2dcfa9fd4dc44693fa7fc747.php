<?php $__env->startSection('title', 'Документы пользователей'); ?>

<div>
    <div class="row">
        <?php echo $__env->make('components.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список документов</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group-sm">
                                <a href="<?php echo e(route('admin.documents.user.create')); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row1" data-id="<?php echo e($document->id); ?>">
                                <td><?php echo e($document->id); ?></td>
                                <td><?php echo e($document->document->name); ?></td>
                                <td><?php echo e($document->user->name); ?> <?php echo e($document->user->surname); ?></td>
                                <td><?php echo e($document->status->name); ?></td>
                                <td class="d-flex justify-content-end">
                                    <a href="<?php echo e(route('admin.documents.user.edit', ['user_id' => $document->user_id, 'document_id' => $document->id])); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <button wire:click="deleteDocument(<?php echo e($document->id); ?>)" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
    <?php echo $__env->make('livewire.components.session-toasts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('components.toasts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/admin/document/user/table.blade.php ENDPATH**/ ?>