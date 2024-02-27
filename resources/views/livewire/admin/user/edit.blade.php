<div>
    @section('title', 'Редактированиe пользователя')

    @include('components.alerts')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Пользователь: {{ $user->name }} {{ $user->surname }}</h3>
        </div>

        <form wire:submit.prevent="createUser">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input wire:model="name" type="text" class="form-control" id="name"
                        placeholder="Имя пользователя">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="surname">Фамилия:</label>
                    <input wire:model="surname" type="text" class="form-control" id="surname"
                        placeholder="Фамилия пользователя">
                    @error('surname')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email адрес:</label>
                    <input wire:model="email" type="email" class="form-control" id="email" placeholder="Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="balance" class="form-label">Баланс:</label>
                    <input wire:model="balance" type="number" id="balance" class="form-control" placeholder="Баланс" step=".01">
                    @error('balance')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Роль:</label>
                    <div wire:ignore>
                        <select id="role" class="form-control select2" style="width: 100%;">
                            @foreach ($roles as $role)
                                <option @if($role_id == $role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('admin.user.table') }}" class="btn btn-danger">Отмена</a>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2">
            <h4 class="m-0">Адреса пользователя: {{ $user->addresses->count() }}</h4>
            <a href="{{ route('admin.user.address.create', ['user_id' => $user->id]) }}"
                class="btn btn-success d-flex align-items-center">
                <i class="fa fa-plus mr-1"></i>
                Добавить
            </a>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Адрес</th>
                        <th>Номер телефона</th>
                        <th>Email адрес</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr wire:key="address-{{ $address->id }}">
                            <td>{{ $address->user->id }}</td>
                            <td>{{ $address->name }}</td>
                            <td>{{ $address->surname }}</td>
                            <td>{{ $address->country->name }}, {{ $address->city }}, {{ $address->street }},
                                {{ $address->postal_code }}</td>
                            <td>{{ $address->phone_number }}</td>
                            <td>{{ $address->email }}</td>
                            <td>
                                <a href="{{ route('admin.user.address.edit', ['user_id' => $user->id, 'address_id' => $address->id]) }}" type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <button wire:click="deleteAddress({{ $address->id }})" type="button" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: 'bootstrap4'
                })
                $('#role').on('change', function (e) {
                    Livewire.emit('roleListener', $('#role').val())
                })
            })
        </script>
        @include('components.toasts')
    @endsection

</div>
