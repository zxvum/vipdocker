<div>
    <?php $__env->startSection('title', 'Создание посылки'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание посылки</h3>
                </div>

                <form action="<?php echo e(route('admin.order.create.post')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.user-id-input')->html();
} elseif ($_instance->childHasBeenRendered('l2489581432-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2489581432-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2489581432-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2489581432-0');
} else {
    $response = \Livewire\Livewire::mount('components.user-id-input');
    $html = $response->html();
    $_instance->logRenderedChild('l2489581432-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="name"
                                   placeholder="Название заказа">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group" data-select2-id="61">
                            <label for="user-select">Пользователь</label>
                            <select id="user-select" class="form-control form-select select2"
                                    style="width: 100%;">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> <?php echo e($user->surname); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" value="<?php echo e(old('description')); ?>" name="description"
                                   id="description" placeholder="Название заказа">
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-danger"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startSection('js'); ?>
        <script src="<?php echo e(asset('admin-assets/plugins/select2/js/select2.js')); ?>"></script>
        <script>
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        </script>
    <?php $__env->stopSection(); ?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/package/create.blade.php ENDPATH**/ ?>