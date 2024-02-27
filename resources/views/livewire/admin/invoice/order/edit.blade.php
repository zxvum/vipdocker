@section('title', 'Редактирование чека')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование чека под заказ: {{ $order->id }}</h3>
                </div>

                <form wire:submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">Пользователь</label>
                            <x-inputs.select2 id="user_id">
                                <option selected disabled>Выберите пользователя</option>
                                @foreach($users as $user)
                                    <option @if($user_id == $user->id) selected @endif value="{{ $user->id }}">{{ $user->fullname() }}</option>
                                @endforeach
                            </x-inputs.select2>
                            @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="order_id">Заказ</label>
                            <x-inputs.select2 id="order_id">
                                <option selected disabled>Выберите заказ</option>
                                @foreach($orders as $order)
                                    <option @if($order_id == $order->id) selected @endif value="{{ $order->id }}">{{ $order->title }}</option>
                                @endforeach
                            </x-inputs.select2>
                            @error('order_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="services">Услуги</label>
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <input wire:model="name" placeholder="Название" class="form-control" type="text">
                                <input wire:model="cost" placeholder="Цена" class="form-control" type="number">
                                <input wire:model="amount" placeholder="Кол-во" class="form-control" type="number">
                                <button type="button" wire:click="addService" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <table id="sortable" class="table table-bordered my-2">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Кол-во</th>
                                    <th style="width: 120px;">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                    <tr class="row1" data-id="{{ $loop->index }}" wire:key="{{ $loop->index }}">
                                        <td>{{ $service['name'] }}</td>
                                        <td>
                                            {{ $service['cost'] }}
                                        </td>
                                        <td>{{ $service['amount'] }}</td>
                                        <td class="d-flex justify-content-end">
                                            <button type="button" wire:click="deleteService({{ $loop->index }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="status_id">Статус</label>
                            <x-inputs.select2 id="status_id">
                                <option selected disabled>Выберите статус</option>
                                @foreach($statuses as $status)
                                    <option @if($status->id == $status_id) selected @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </x-inputs.select2>
                            @error('status_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label for="tax">Налог</label>
                            <input wire:model="tax" class="form-control" type="number" placeholder="Введите сумму налога">
                            @error('tax') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                        <a href="{{ route('admin.invoice.table') }}" type="button" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

