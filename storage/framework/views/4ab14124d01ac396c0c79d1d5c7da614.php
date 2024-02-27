<div>
    <div class="card mb-4">
        <h5 class="card-header">Изменение пароля</h5>
        <div class="card-body">
            <?php echo $__env->make('components.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <form id="formAccountSettings" wire:submit.prevent="submit"
                  method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework"
                  novalidate="novalidate">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="currentPassword">Текущий пароль</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="currentPassword" class="form-control <?php $__errorArgs = ['currentPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" name="currentPassword"
                                   id="currentPassword" placeholder="············" value="<?php echo e(old('currentPassword')); ?>">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <?php $__errorArgs = ['currentPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="fv-plugins-message-container invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="newPassword">Новый пароль</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="newPassword" class="form-control <?php $__errorArgs = ['newPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" id="newPassword" name="newPassword"
                                   placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <?php $__errorArgs = ['newPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="fv-plugins-message-container invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="confirmPassword">Подтверждение нового пароля</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="confirmPassword" class="form-control <?php $__errorArgs = ['confirmPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" name="confirmPassword"
                                   id="confirmPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <?php $__errorArgs = ['confirmPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="fv-plugins-message-container invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-12 mb-4">
                        <p class="fw-semibold mt-2">Требования к паролю:</p>
                        <ul class="ps-3 mb-0">
                            <li class="mb-1">
                                Минимум 8 символов - чем больше, тем лучше
                            </li>
                            <li class="mb-1">Хотя бы один символ нижнего регистра</li>
                            <li>Хотя бы одна цифра, символ или пробел</li>
                        </ul>
                    </div>
                    <div class="col-12 mt-1">
                        <button type="submit" class="btn btn-primary me-2">Сохранить изменения</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/components/security-update-password-form.blade.php ENDPATH**/ ?>