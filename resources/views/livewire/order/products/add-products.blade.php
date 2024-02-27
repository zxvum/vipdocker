<div>
    @section('title', 'Добавление товара')

    <div class="row d-flex justify-content-center">
        @include('components.alerts')

{{--        form--}}
        <div class="col-12 col-xl-6 order-1">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Добавление товара в заказ: {{ $order->name }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="createProduct">
                        @csrf
                        <div class="mb-3">
                            <label for="shop" class="form-label">Магазин</label>
                            <select wire:model.lazy="shop" name="shop_id" id="shop" class="form-select" autofocus required>
                                @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                            @error('shop_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="link">Ссылка на товар</label>
                            <input wire:model="link" name="link" type="text" class="form-control" id="link" placeholder="Вставьте ссылку на товар" required>
                            @error('link') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Точно как указано на сайте магазина, на том же языке, также укажите размер и цвет, если надо.">Название товара/Размер/Цвет:</label>
                            <input wire:model="title" name="title" type="text" class="form-control" id="title" placeholder="Введите название на товар прямо с сайта" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="options" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Укажите все дополнительные опции вашего товара">Опции товара(материал и прочее):</label>
                            <input wire:model="options" name="options" type="text" class="form-control" id="options" placeholder="Укажите дополнительные опции товара">
                            @error('options') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="price" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="Важно: при неверно указанной сумме цена будет скорректирована">Цена товара</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input wire:model="price" name="price" type="number" class="form-control" placeholder="Цена за один товар" id="price" required>
                            </div>
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="quantity">Количество:</label>
                            <input wire:model="quantity" name="quantity" type="number" class="form-control" id="quantity" placeholder="Введите название на товар прямо с сайта" required>
                            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                                @if($order->products->count() == 0)
                                    <button wire:click="deleteOrder" class="btn btn-danger">Удалить заказ</button>
                                @endif
                            </div>
                            @if($order->products->count() != 0)
                                <a href="{{ route('order.table') }}" class="text-uppercase fw-semibold d-flex align-items-center gap-1">Все заказы<i class='bx bx-right-arrow-alt fw-semibold'></i></a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{--        table--}}
        <div class="col-12 col-xl-6 order-2">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Товары в заказе</h5>
                </div>
                <div class="card-body">
                    @if($order->products->count() > 0)
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Название</th>
                                    <th class="text-center">Ссылка</th>
                                    <th class="text-center">Статус</th>
                                    <th class="text-center">Магазин</th>
                                    <th class="text-center">Цена</th>
                                    <th class="text-center">Действия</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($products as $product)
                                    <tr wire:key="product-{{ $product->id }}">
                                        <td class="text-center"><a href="#">{{ $product->id }}</a></td>
                                        <td class="text-center text-truncate cursor-pointer" style="max-width: 120px" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="{{ $product->title }}">{{ $product->title }}</td>
                                        <td class="text-center"><a href="{{ $product->link }}" target="_blank">тык</a></td>
                                        <td class="text-center fw-semibold" style="color: {{ $product->status->hex }}">{{ $product->status->name }}</td>
                                        <td class="text-center">{{ $product->shop->name }}</td>
                                        <td class="text-center">{{ $product->price * $product->quantity }}$</td>
                                        <td class="text-center">
                                            <a href="{{ route('order.product.view', ['order_id' => $order->id, 'product_id' => $product->id]) }}" class="btn btn-primary btn-sm"><i class="bx bx-show"></i></a>
                                            <a href="{{ route('order.product.edit', ['order_id' => $order->id, 'product_id' => $product->id]) }}" class="btn btn-success btn-sm"><i class="bx bx-edit"></i></a>
                                            <button wire:click="productDelete({{ $product->id }})" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h4 class="p-0 m-0 text-center">Тут пусто</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @section('js')
        @if(session()->has('is_toast'))
            <script>
                $(document).ready(function () {
                    toastr.options.closeButton = true;
                    toastr.options.closeDuration = 300;
                    toastr.options.timeOut = 5000;
                    toastr.options.progressBar = true;
                    toastr.warning('Вы еще не заполнили данный заказ.', 'Внимание!!!')
                })
            </script>
        @endif
        <script>
            document.addEventListener('productCreated', () => {
                toastr.options.closeButton = true;
                toastr.options.closeDuration = 300;
                toastr.options.timeOut = 3000;
                toastr.options.progressBar = true;
                toastr.success('Товар успешно добавлен.', 'Успех!')
            });
            document.addEventListener('productDeleted', () => {
                toastr.options.closeButton = true;
                toastr.options.closeDuration = 300;
                toastr.options.timeOut = 3000;
                toastr.options.progressBar = true;
                toastr.error('Товар успешно удален.', 'Успех!')
            });
        </script>
    @endsection
</div>
