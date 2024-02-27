@extends('admin.layouts.app')

@section('title', 'Проверка заказов')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(session()->has('order_not_found'))
                <div class="alert alert-warning">
                    {{ session('order_not_found') }}
                </div>
            @endif
        </div>
        <div class="col-12">
            @if(session()->has('order_delete_success'))
                <div class="alert alert-success">
                    {{ session('order_delete_success') }}
                </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список заказов для проверки</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Заказчик</th>
                            <th>Статус</th>
                            <th>Цена</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        @foreach($orders as $order)
                            <tr class="row1">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->user->name }} {{ $order->user->surname }}</td>
                                <td>
                                    <p style="color: {{ $order->status->hex }};">{{ $order->status->name }}</p>
                                </td>
                                <td>
                                    @php
                                        $cost = 0;
                                        foreach ($order->products as $product){
                                            $cost = $cost + ($product->price * $product->quantity);
                                        }
                                        echo $cost
                                    @endphp $
                                </td>
                                <td class="d-flex justify-content-end">
                                    <a href="#" class="btn btn-primary mr-1">Подтвердить</a>
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
