@extends('admin.layouts.app')

@section('title', 'Редактирование заказа')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование заказ: {{ $order->name }}</h3>
                </div>

                <form action="{{ route('admin.order.edit.post', ['id' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название*</label>
                            <input type="text" class="form-control" name="title" id="name" value="{{ $order->title }}" placeholder="Название заказа">
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Описание</label>
                            <textarea style="max-height: 300px; min-height: 50px;" type="text" class="form-control" name="name" id="name" placeholder="Название заказа">{{ $order->description }}</textarea>
                        </div>
                        @livewire('components.user-id-input', ['user_id' => $order->user_id])
                        <div class="form-group">
                            <label for="status_id">Статус заказа</label>
                            <select class="form-control" name="status_id" id="status_id">
                                @foreach($order_statuses as $status)
                                    <option value="{{ $status->id }}" @if($status->id == $order->status_id) selected @endif>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        @if($order->status_id == 3)
                            <a href="{{ route('admin.invoice.order.create', ['order_id' => $order->id]) }}" class="btn btn-success">Выставить счет</a>
                        @endif
                        <a href="{{ route('admin.order.all') }}" class="btn btn-secondary">Назад</a>
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
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td><a href="{{ $product->link }}" target="_blank">тык</a></td>
                                <td><p style="color: {{ $product->hex }};">{{ $product->status->name }}</p></td>
                                <td>{{ $product->shop->name }}</td>
                                <td>{{ $product->price * $product->quantity }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('admin.order.product.edit', ['order_id' => $order->id, 'id' => $product->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.order.product.delete', ['order_id' => $order->id, 'id' => $product->id]) }}" class="btn btn-danger" onclick="confirm('Вы действительно хотите удалить товар?')"><i class="far fa-trash-alt"></i></a>
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
