@extends('admin.layouts.app')

@section('title', 'Редактированиe пользователя')

@section('content')
    @include('components.alerts')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Пользователь: {{ $user->name }} {{ $user->surname }}</h3>
        </div>

        <form action="{{ route('admin.user.edit.post', ['id' => $user->id]) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Имя пользователя">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="surname">Фамилия:</label>
                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}" placeholder="Фамилия пользователя">
                    @error('surname') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email адрес:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="balance" class="form-label">Баланс:</label>
                    <input type="number" value="{{ $user->balance }}"
                           name="balance" id="balance" class="form-control" placeholder="Баланс">
                    @error('balance') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="role">Роль:</label>
                    <select name="role" id="role" class="form-control select2">
                        @foreach($roles as $role)
                            <option @if($user->getRoleNames()->contains($role->name)) selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('admin.user.all-users') }}" class="btn btn-danger">Отмена</a>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2">
            <h4 class="m-0">Адреса пользователя: {{ $user->addresses->count() }}</h4>
            <a href="{{ route('admin.user.address.create', ['id' => $user->id]) }}" class="btn btn-success d-flex align-items-center">
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
                @foreach($user->addresses as $address)
                    <tr>
                        <td>{{ $address->user->id }}</td>
                        <td>{{ $address->name }}</td>
                        <td>{{ $address->surname }}</td>
                        <td>{{ $address->country->name }}, {{ $address->city }}, {{ $address->street }}, {{ $address->postal_code }}</td>
                        <td>{{ $address->phone_number }}</td>
                        <td>{{ $address->email }}</td>
                        <td>
                            {{--                                <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button>--}}
                            <a href="#" type="button" class="btn btn-success"><i class="fas fa-edit"></i></a>
                            <button onclick="document.getElementById('delete_address').submit()" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>

                            <form action="{{ route('admin.user.address.delete', ['address_id' => $address->id, 'user_id' => $user->id]) }}" method="post" id="delete_address" hidden>@csrf</form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
