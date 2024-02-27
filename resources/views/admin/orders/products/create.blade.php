@extends('admin.layouts.app')

@section('title', 'Добавление товара в заказ')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание товара</h3>
                </div>

                <form action="{{ route('admin.order.product.create.post', ['order_id' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status_id">Статус</label>
                            <select class="form-control" name="status_id" id="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_id">Магазин</label>
                            <select class="form-control" name="shop_id" id="shop_id">
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('admin.shop.add') }}">Создать новый</a>
                            @error('shop_id') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Ссылка на товар">
                            @error('link') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Название товара">
                            @error('title') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input name="price" id="price" placeholder="Цена товара" type="number" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            @error('price') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Кол-во</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Количество товара">
                            @error('quantity') <p class="text-danger"> {{ $message }} </p> @enderror
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
