@extends('admin.layouts.app')

@section('title', 'Все пользователи')

@section('content')
    @include('components.alerts')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Пользователи</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group-sm">
                                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <form class="d-flex align-items-center justify-content-between" style="padding: 0.75rem 1.25rem; border-bottom: 1px solid rgba(0,0,0,.125);">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input value="{{ request('search') }}" type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>ФИ</th>
                            <th>Email</th>
                            <th>Адресов</th>
                            <th>Баланс</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->addresses->count() }}</td>
                                <td>{{ $user->balance }}$</td>
                                <td>
                                    <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    @if($user->id !== auth()->user()->id)
                                        <button type="button" onclick="deleteUser()" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        <form method="post" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" id="deleteUser">@csrf</form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function deleteUser(){
            if (confirm('Вы действительно хотите удалить пользователя?')) {
                document.getElementById("deleteUser").submit();
            }
        }
    </script>
@endsection
