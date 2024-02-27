<div>
    @section('title', 'Редактирование заказа')

    @section('css')

    @endsection

    <div class="row">
        <div class="col-12">
            @include('components.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование заказ: {{ $order->name }}</h3>
                </div>

                <form wire:submit.prevent="updateOrder">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название*</label>
                            <input wire:model="title" type="text" class="form-control" id="name" placeholder="Название заказа">
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea wire:model="description" style="max-height: 300px; min-height: 50px;" type="text" class="form-control" id="description" placeholder="Описание заказа"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Владелец заказа(ID)</label>
                            <select class="select2 form-control" name="user_id" id="user_id" style="width: 100%">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>{{ $user->id }} - {{ $user->name }} {{ $user->surname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_id">Статус заказа</label>
                            <select class="form-control select2" name="status_id" id="status_id" style="width: 100%;">
                                @foreach($order_statuses as $status)
                                    <option value="{{ $status->id }}" @if($status->id == $status_id) selected @endif>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="admin_message">Сообщение от админа</label>
                            <textarea wire:model="admin_message" class="form-control" name="admin_message" id="admin_message" style="max-height: 300px; min-height: 50px;"></textarea>
                            <p class="text-muted">Заполнить при необходимости</p>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        @if($order->status_id == 3)
                            <a href="{{ route('admin.invoice.create.order', ['user_id' => $user_id, 'order_id' => $order->id]) }}" class="btn btn-success mr-0.5">Выставить счет</a>
                        @endif
                        <a href="{{ route('admin.order.table') }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Товары в заказе</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group-sm">
                                <a href="{{ route('admin.order.product.create', ['order_id' => $order->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Ссылка</th>
                            <th>Статус</th>
                            <th>Магазин</th>
                            <th>Цена</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr wire:key="{{ $product->id }}">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td><a href="{{ $product->link }}" target="_blank">тык</a></td>
                                <td><p style="color: {{ $product->hex }};">{{ $product->status->name }}</p></td>
                                <td>{{ $product->shop->name }}</td>
                                <td>{{ $product->price * $product->quantity }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('admin.order.product.edit', ['order_id' => $order->id, 'product_id' => $product->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger" wire:click="deleteProduct({{ $product->id }})"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(() => {
                $('.select2').select2({
                    theme: 'bootstrap4'
                })
                $('#status_id').on('change', function(e) {
                    Livewire.emit('statusListener', $('#status_id').val());
                });
                $('#user_id').on('change', function (e) {
                    Livewire.emit('userListener', $('#user_id').val())
                })
            })
        </script>
        @include('components.toasts')
    @endsection
</div>
