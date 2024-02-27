@extends('admin.layouts.app')

@section('title', 'Создание пользователя')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание пользователя</h3>
                </div>

                <form action="{{ route('admin.user.create.post') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Имя пользователя">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input value="{{ old('surname') }}" type="text" name="surname" id="surname" class="form-control" placeholder="Фамилия пользователя">
                            @error('surname') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control" placeholder="Почта пользователя">
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль">
                            @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="balance">Баланс</label>
                            <input value="{{ old('balance') ? old('balance') : 0 }}" type="number" name="balance" id="balance" class="form-control" placeholder="Баланс">
                            @error('balance') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Роль</label>
                            <select class="form-control select2" id="role" name="role">
                                @foreach($roles as $role)
                                    @if(old('role'))
                                        <option @if(old('role') == $role->name) selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
                                    @else
                                        <option @if($role->name == 'user') selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
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
@endsection

@section('js')
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(document).ready(function (){
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
