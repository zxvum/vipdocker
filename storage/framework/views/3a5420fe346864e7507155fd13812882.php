<?php $__env->startSection('title', 'Добавление адреса пользователю'); ?>

<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание документа для пользователя</h3>
        </div>

        <form wire:submit.prevent="create">
            <div class="card-body">
                <div class="form-group">
                    <label for="user_id">Пользователь:</label>
                    <div wire:ignore>
                        <select name="user_id" id="user_id" class="select2" style="width: 100%">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> <?php echo e($user->surname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label for="document_id">Документ:</label>
                    <div wire:ignore>
                        <select class="select2" style="width: 100%" name="document_id" id="document_id">
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($document->id); ?>"><?php echo e($document->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['document_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label for="document_file">Файл документа:</label>
                    <input wire:model="document_file" type="file" class="form-control">
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label for="status_id">Статус документа</label>
                    <div wire:ignore>
                        <select style="width: 100%;" name="status_id" id="status_id" class="select2">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php $__errorArgs = ['status_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Создать</button>
                <a href="<?php echo e(route('admin.documents.user.table')); ?>" class="btn btn-danger">Отмена</a>
            </div>
        </form>
    </div>
</div>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin-assets/plugins/select2/js/select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('#user_id').on('change', function(e) {
                Livewire.emit('userListener', $('#user_id').val())
            })
            $('#document_id').on('change', function(e) {
                Livewire.emit('documentListener', $('#document_id').val())
            })
            $('#status_id').on('change', function(e) {
                Livewire.emit('statusListener', $('#status_id').val())
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/admin/document/user/create.blade.php ENDPATH**/ ?>