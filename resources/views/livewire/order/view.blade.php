<div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ $order->name }}</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-2">
                    <p style="font-size: 16px; color: #020202">ID: {{ $order->id }}</p>
                    <p style="font-size: 16px; color: #020202">Статус: <span style="color: {{ $order->status->hex }}">{{ $order->status->name }}</span></p>
                    <p style="font-size: 16px; color: #020202">Название: {{ $order->title }}</p>
                    @if($order->description)
                        <p style="font-size: 16px; color: #020202">Описание: {{ $order->description }}</p>
                    @endif
                    <p style="font-size: 16px; color: #020202">Сумма заказа: {{ $total_price }}$</p>
                    <p style="font-size: 16px; color: #020202">Дата создания: {{ $order->created_at }}</p>
                    <p style="font-size: 16px; color: #020202">Дата изменения: {{ $order->updated_at }}</p>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('order.edit', ['order_id' => $order->id]) }}" class="btn btn-primary">Редактировать</a>
                        <a href="{{ route('order.product.add-product', ['order_id' => $order->id]) }}" class="btn btn-secondary">Товары</a>
                        @if($order->status_id == 2)
                            <button wire:click="allowOrder" class="btn btn-success">Подтвердить</button>
                        @endif
                        @if($order->status_id == 4)
                            <button wire:click="allowOrder" class="btn btn-success">Исправлен</button>
                        @endif
                    </div>
                    <a href="{{ route('order.table') }}" class="text-uppercase fw-semibold d-flex align-items-center gap-1">Все заказы<i class='bx bx-right-arrow-alt fw-semibold'></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
