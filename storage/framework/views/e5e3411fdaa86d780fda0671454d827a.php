<?php $__env->startSection('title', 'Документы для заполнения'); ?>

<div>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список документов</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group-sm">
                                <a href="<?php echo e(route('admin.documents.form.create')); ?>" class="btn btn-primary">
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
                            <th>Название</th>
                            <th>Активный</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr wire:key="<?php echo e($document->id); ?>" class="row1" data-id="<?php echo e($document->id); ?>">
                                <td><?php echo e($document->name); ?></td>
                                <td>
                                    <?php if($document->is_active): ?>
                                        Да
                                    <?php else: ?>
                                        Нет
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex justify-content-end">
                                    <a href="<?php echo e(route('admin.documents.form.edit', ['document_id' => $document->id])); ?>" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
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
    <script>
        $(function () {
            $("#tablecontents" ).sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                $('tr.row1').each(function(index,element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index+1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "<?php echo e(url('admin/documents/updateOrder')); ?>",
                    data: {
                        order:order,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });

            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/admin/document/form/table.blade.php ENDPATH**/ ?>