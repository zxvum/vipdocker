<?php $__env->startSection('title', 'Профиль'); ?>

<?php $__env->startSection('profile'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- Change Password -->
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('components.security-update-password-form')->html();
} elseif ($_instance->childHasBeenRendered('Gnix7mD')) {
    $componentId = $_instance->getRenderedChildComponentId('Gnix7mD');
    $componentTag = $_instance->getRenderedChildComponentTagName('Gnix7mD');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Gnix7mD');
} else {
    $response = \Livewire\Livewire::mount('components.security-update-password-form');
    $html = $response->html();
    $_instance->logRenderedChild('Gnix7mD', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <!--/ Change Password -->

            <!-- Two-steps verification -->
            <div class="card mb-4">
                <h5 class="card-header">Двухэтапная проверка</h5>
                <div class="card-body">
                    <p class="fw-semibold mb-3">Двухфакторная аутентификация не включена.</p>
                    <p class="w-75">Двухфакторная аутентификация добавляет дополнительный уровень безопасности вашей
                        учетной записи, требуя больше, чем просто пароль для входа в систему.
                    </p>
                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#" disabled>
                        Скоро...
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <!-- Enable OTP Modal -->
            <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-5">Включить одноразовый пароль</h3>
                            </div>
                            <h6>Verify Your Mobile Number for SMS</h6>
                            <p>Enter your mobile phone number with country code and we will send you a verification
                                code.</p>
                            <form id="enableOTPForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework"
                                  onsubmit="return false" novalidate="novalidate">
                                <div class="col-12 fv-plugins-icon-container">
                                    <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
                                    <div class="input-group input-group-merge has-validation">
                                        <span class="input-group-text">+1</span>
                                        <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone"
                                               class="form-control phone-number-otp-mask" placeholder="202 555 0111">
                                    </div>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel
                                    </button>
                                </div>
                                <input type="hidden"></form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Enable OTP Modal -->

            <!-- /Modal -->

            <!--/ Two-steps verification -->

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/profile/security.blade.php ENDPATH**/ ?>