<div>
    @section('title', 'Таблица пользователей')
    @include('components.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список пользователей</h3>
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
            <form wire:submit.prevent="filter" class="d-flex align-items-center justify-content-between" style="padding: 0.75rem 1.25rem; border-bottom: 1px solid rgba(0,0,0,.125);">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <select wire:model="role_filter" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="-1">Все статусы</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <select wire:model="sort_direction" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="DESC">Самые новые</option>
                        <option value="ASC">Самые старые</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Применить</button>
                </div>
            </form>

            <div class="card-body table-responsive p-0">
                <table id="table" class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФИ</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Баланс</th>
                        <th>Заказов</th>
                        <th>Посылок</th>
                        <th class="d-flex justify-content-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody id="tablecontents">
                    @foreach($users as $user)
                        <tr wire:key="user-{{ $user->id }}" class="row1">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }} {{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()[0] }}</td>
                            <td>{{ $user->balance }}</td>
                            <td>{{ $user->orders()->count() }}</td>
                            <td>{{ $user->packages()->count() }}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('admin.user.edit', ['user_id' => $user->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                @if(!$user->id === auth()->user()->id or !$user->getRoleNames()->contains("owner"))
                                    <button wire:click="delete({{ $user->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
