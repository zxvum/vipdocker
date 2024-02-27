<div>
    <div class="card mb-4">
        <h5 class="card-header">Изменение пароля</h5>
        <div class="card-body">
            @include('components.alerts')
            <form id="formAccountSettings" wire:submit.prevent="submit"
                  method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework"
                  novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="currentPassword">Текущий пароль</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="currentPassword" class="form-control @error('currentPassword') is-invalid @enderror" type="password" name="currentPassword"
                                   id="currentPassword" placeholder="············" value="{{ old('currentPassword') }}">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('currentPassword') <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div> @enderror
                        {{--                                @error('currentPassword') <p class="text-danger">{{ $message }}</p> @enderror--}}
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="newPassword">Новый пароль</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="newPassword" class="form-control @error('newPassword') is-invalid @enderror" type="password" id="newPassword" name="newPassword"
                                   placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('newPassword') <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-md-6 form-password-toggle fv-plugins-icon-container">
                        <label class="form-label" for="confirmPassword">Подтверждение нового пароля</label>
                        <div class="input-group input-group-merge has-validation">
                            <input wire:model="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" type="password" name="confirmPassword"
                                   id="confirmPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        @error('confirmPassword') <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div> @enderror
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
