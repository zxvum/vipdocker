<div>
    @section('title', $order->title)

    <div class="col-12">
        @include('components.alerts')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Заказ: {{ $order->title }}</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="editOrder">
                    <div class="mb-3">
                        <label for="title" class="form-label">Название</label>
                        <input wire:model="title" type="text" class="form-control" id="title" name="name" placeholder="Название заказа">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea wire:model="description" class="form-control" name="description" style="max-height: 200px; min-height: 40px; height: 60px;"></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('order.product.add-product', ['order_id' => $order->id]) }}" class="btn btn-secondary">Товары</a>
                        </div>
                        <a href="{{ route('order.view', ['order_id' => $order->id]) }}" class="text-uppercase fw-semibold d-flex align-items-center gap-1">К заказу<i class='bx bx-right-arrow-alt fw-semibold'></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            document.addEventListener('orderEdited', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.success('Заказ успешно изменен!', 'Успех!')
            })
        </script>
    @endsection
</div>
