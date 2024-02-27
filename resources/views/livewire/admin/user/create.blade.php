<div>
    @section('title', 'Создание пользователя')
    <div class="row">
        <div class="col-12">
            @include("components.alerts")

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание пользователя</h3>
                </div>

                <form wire:submit="create_user">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input wire:model.lazy="name" type="text" class="form-control" name="name" id="name" placeholder="Имя пользователя">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input wire:model.lazy="surname" type="text" name="surname" id="surname" class="form-control" placeholder="Фамилия пользователя">
                            @error('surname') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input wire:model.lazy="email" type="email" name="email" id="email" class="form-control" placeholder="Почта пользователя">
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input wire:model.lazy="password" type="password" name="password" id="password" class="form-control" placeholder="Пароль">
                            @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="balance">Баланс</label>
                            <input wire:model.lazy="balance" type="number" name="balance" id="balance" class="form-control" placeholder="Баланс">
                            @error('balance') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Роль</label>
                            <select wire:model.lazy="select_role" class="form-control select2" id="role" name="role">
                                @foreach($roles as $role)
                                    @if(old('role'))
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
