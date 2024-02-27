<div>
    @section('title', 'Редактирование товара')

    @include('components.alerts')

    <div class="col-12 order-1">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Добавление товара</h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="editProduct">
                    <div class="mb-3">
                        <label for="shop" class="form-label">Магазин</label>
                        <select wire:model="shop" id="shop" class="form-select" required>
                            @foreach($shops as $shop)
                                <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                        </select>
                        @error('shop_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="link">Ссылка на товар</label>
                        <input wire:model="link" type="text" class="form-control" id="link" placeholder="Вставьте ссылку на товар" required>
                        @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Точно как указано на сайте магазина, на том же языке, также укажите размер и цвет, если надо.">Название товара/Размер/Цвет:</label>
                        <input wire:model="title" type="text" class="form-control" id="title" placeholder="Введите название на товар прямо с сайта" required>
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="options" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Материал, Цвет, Размер.">Параметры товара (Материал и тд)</label>
                        <input wire:model="options" type="text" class="form-control" id="options" placeholder="Введите прочие параметры товара">
                        @error('options') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Важно: при неверно указанной сумме цена будет скорректирована">Цена товара</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input wire:model="price" type="number" class="form-control" placeholder="Цена за один товар" id="price" required>
                            <span class="input-group-text">.00</span>
                        </div>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Количество:</label>
                        <input wire:model="quantity" type="number" class="form-control" id="quantity" placeholder="Введите название на товар прямо с сайта" required>
                        @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        @if($order->products->count() != 0)
                            <a href="{{ route('order.product.add-product', ['order_id' => $order->id]) }}" class="text-uppercase fw-semibold d-flex align-items-center gap-1">Товары<i class='bx bx-right-arrow-alt fw-semibold'></i></a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            document.addEventListener('productEdited', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.success('Информация товара успешно изменена!', 'Успех!')
            })
        </script>
    @endsection
</div>
