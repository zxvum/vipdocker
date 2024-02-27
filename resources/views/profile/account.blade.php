@extends('layouts.profile')

@section('title', 'Аккаунт')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('profile')
    @include('components.alerts')
    <div class="card mb-4" data-select2-id="14">
        <h5 class="card-header">Редактирование профиля</h5>
        <!-- Account -->
        <div class="card-body" data-select2-id="13">
            <form action="{{ route('profile.account.update.post') }}" id="formAccountSettings" method="POST"
                  class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                  data-select2-id="formAccountSettings">
                @csrf
                <div data-select2-id="12">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="name" class="form-label">Имя</label>
                        <input class="form-control" type="text" id="name" name="name"
                               value="{{ old('name') ?? auth()->user()->name }}"
                               autofocus="">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="surname" class="form-label">Фамилия</label>
                        <input class="form-control" type="text" name="surname" id="surname"
                               value="{{ old('surname') ?? auth()->user()->surname }}">
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email"
                               value="{{ old('email') ?? auth()->user()->email }}"
                               placeholder="john.doe@example.com" disabled>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Сохранить изменения</button>
                </div>
                <input type="hidden"></form>
        </div>
        <!-- /Account -->
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2-country').select2({
                placeholder: 'Выберите страну',
                allowClear: true,
                minimumInputLength: 0,
            });
        });
    </script>
    <script>
        const checkbox = document.getElementById("accountActivation");
        const button = document.querySelector(".deactivate-account");

        checkbox.addEventListener("change", function() {
            if(this.checked) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        });
    </script>
@endsection
