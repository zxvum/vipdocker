<?php $__env->startSection('title', 'Создание посылки'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Создание посылки</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('package.create.post')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label" for="title">Название</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Новый заказ" value="Заказ №<?php echo e($user_package_count+1); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Адрес для доставки</label>
                            <select name="address_id" id="address" class="form-select">
                                <option value="" selected>---</option>
                                <?php $__currentLoopData = $user_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($address->id); ?>"><?php echo e($address->country->name); ?>, <?php echo e($address->city); ?>, <?php echo e($address->street); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('address_id')): ?>
                                <small class="text-danger"><?php echo e($errors->first('address_id')); ?></small>
                            <?php else: ?>
                                <a href="<?php echo e(route('address.create')); ?>">Добавить адрес</a>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Описание</label>
                            <input type="text" class="form-control" id="description" placeholder="Описание и пожелания к заказу">
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Дальше</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/packages/create.blade.php ENDPATH**/ ?>