<div>
    @section('title', 'Аккаунт')

    @include('components.alerts')
    <div class="card mb-4">
        <h5 class="card-header">Редактирование профиля</h5>
        <!-- Account -->
        <div class="card-body">
            <form wire:submit.prevent="updateProfile"
                  class="fv-plugins-bootstrap5 fv-plugins-framework">
                <div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input wire:model="name" class="form-control" type="text" id="name">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input wire:model="surname" class="form-control" type="text" id="surname">
                        @error('surname') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input wire:model="email" class="form-control" type="text" id="email"
                               placeholder="john.doe@example.com" disabled>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Сохранить изменения</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>

    @section('js')
        <script>
            document.addEventListener('profileUpdated', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.success('Профиль успешно обновлен!', 'Успех!')
            })
        </script>
    @endsection
</div>
