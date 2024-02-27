@section('title', 'Добавление адреса пользователю')

<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Пользователь: {{ $user->name }} {{ $user->surname }}</h3>
        </div>

        <form wire:submit.prevent="createAddress">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input wire:model="name" type="text" class="form-control" id="name" placeholder="Имя пользователя">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="surname">Фамилия:</label>
                    <input wire:model="surname" type="text" class="form-control" id="surname" placeholder="Фамилия">
                    @error('surname') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="country_id" class="form-label">Страна:</label>
                    <div wire:ignore>
                        <select id="country_id" class="form-control select2">
                            @foreach($countries as $country)
                                <option @if($country_id == $country->id) selected
                                        @endif value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country_id') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="region">Регион:</label>
                    <input wire:model="region" type="text" class="form-control" id="region" placeholder="Регион">
                    @error('region') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="city">Город:</label>
                    <input wire:model="city" type="text" class="form-control" id="city" placeholder="Город">
                    @error('city') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="postal_code">Почтовый индекс:</label>
                    <input wire:model="postal_code" type="number" class="form-control" id="postal_code"
                           placeholder="Почтовый индекс"
                    >
                    @error('postal_code') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="street">Улица:</label>
                    <input wire:model="street" type="text" class="form-control" id="street" placeholder="Улица">
                    @error('street') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Номер телефона:</label>
                    <input wire:model="phone_number" type="number" class="form-control" id="phone_number"
                           placeholder="Номер телефона"
                    >
                    @error('phone_number') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input wire:model="email" type="email" class="form-control" id="email" placeholder="Email">
                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Создать</button>
                <a href="{{ route('admin.user.edit', ['user_id' => $user->id]) }}" class="btn btn-danger">Отмена</a>
            </div>
        </form>
    </div>
</div>

@section('js')
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('#country_id').on('change', function (e) {
                Livewire.emit('countryListener', $('#country_id').val())
            })
        })
    </script>
@endsection
