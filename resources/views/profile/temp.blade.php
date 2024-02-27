@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    @include('components.alerts')
    <div class="row">
        <!-- About Me -->
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Информация о себе</h5> <small class="text-muted float-end">Для формирования заказов</small>
                </div>
                <div class="card-body">
                    @if(session()->has('profile_update_success'))
                        <div class="alert alert-success">
                            {{ session('profile_update_success') }}
                        </div>
                    @endif
                    @if(session()->has('country_not_find'))
                        <div class="alert alert-danger">
                            {{ session('country_not_find') }}
                        </div>
                    @endif
                    <form action="{{ route('profile.information.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Имя</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Александр" value="{{ auth()->user()->name }}">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="surname">Фамилия</label>
                            <input name="surname" type="text" class="form-control" id="surname" placeholder="Попов" value="{{ auth()->user()->surname }}">
                            @error('surname') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Email адрес</label>
                            <div class="input-group input-group-merge">
                                <input name="email" type="text" id="email" class="form-control" placeholder="example@company.com" aria-label="john.doe" aria-describedby="basic-default-email2" value="{{ auth()->user()->email }}" disabled>
                            </div>
                            @if(!$errors->has('email')) <div class="form-text"> Вы можете использовать буквы, цифры и точки </div> @endif
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">Страна</label>
                            <input placeholder="Начните вводить название..." value="{{ old('country_name') ?? auth()->user()->country->name }}" name="country_name" class="form-control country_input" list="country_list" />
                            <datalist id="country_list">
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" />
                                @endforeach
                            </datalist>
                            @error('country_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Город</label>
                            <input value="{{ old('city') ?? auth()->user()->city }}" name="city" class="form-control city_input" id="city" placeholder="Ваш город" disabled>
                            @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Номер телефона</label>
                            <input name="phone_number" value="{{ old('phone_number') ?? auth()->user()->phone_number }}" type="text" id="phone" class="form-control phone-mask" placeholder="Введите номер телефона">
                            @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php
        session()->forget('data')
    @endphp
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $.ajax({
                method: 'GET',
                url: '{{ route('check-country') }}',
                data: {name: $('.country_input').val()},
                success: function (data){
                    console.log(data)
                    if (data) {
                        $('.city_input').prop("disabled", false)
                    } else {
                        $('.city_input').prop("disabled", true)
                    }
                }
            })
            $('.country_input').on('input', function(){
                $.ajax({
                    method: 'GET',
                    url: '{{ route('check-country') }}',
                    data: {name: $(this).val()},
                    success: function (data){
                        console.log(data)
                        if (data) {
                            $('.city_input').prop("disabled", false)
                        } else {
                            $('.city_input').prop("disabled", true)
                        }
                    }
                })
            })
        });
    </script>
@endsection

<div class="d-flex flex-column align-items-start">
    <div class="d-flex align-items-center mt-2 gap-2">
        <div class="form-group mr-2">
            <label for="add_service_name">Название</label>
            <input wire:model="add_service_name" id="add_service_name" class="form-control" type="text" placeholder="Название услуги">
        </div>
        <div class="form-group mr-2">
            <label for="add_service_price">Цена</label>
            <input wire:model="add_service_price" id="add_service_price" class="form-control" type="text" placeholder="Название услуги">
        </div>
        <div class="form-group">
            <label for="add_service_quantity">Количество</label>
            <input wire:model="add_service_quantity" id="add_service_quantity" class="form-control" type="text" placeholder="Количество">
        </div>
    </div>
    <button type="button" wire:click="createNewService" class="btn btn-primary">Добавить</button>
</div>
