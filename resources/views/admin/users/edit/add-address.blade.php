@extends('admin.layouts.app')

@section('title', 'Добавление адреса пользователю')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Пользователь: {{ $user->name }} {{ $user->surname }}</h3>
        </div>

        <form action="{{ route('admin.user.add-address.post', ['id' => $user->id]) }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя пользователя" value="{{ old('name') }}">
                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="surname">Фамилия:</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Фамилия" value="{{ old('surname') }}">
                    @error('surname') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="country" class="form-label">Страна:</label>
                    <select name="country" id="country" class="form-control select2">
                        @foreach($countries as $country)
                            <option @if(old('country') == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="region">Регион:</label>
                    <input type="text" class="form-control" id="region" name="region" placeholder="Регион" value="{{ old('region') }}">
                    @error('region') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="city">Город:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Город" value="{{ old('city') }}">
                    @error('city') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="postal_code">Почтовый индекс:</label>
                    <input type="number" class="form-control" id="postal_code" name="postal_code" placeholder="Почтовый индекс" value="{{ old('postal_code') }}">
                    @error('postal_code') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="street">Улица:</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Улица" value="{{ old('street') }}">
                    @error('street') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Номер телефона:</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Номер телефона" value="{{ old('phone_number') }}">
                    @error('phone_number') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') ? old('email') : $user->email }}">
                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Создать</button>
                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-danger">Отмена</a>
            </div>
        </form>
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
