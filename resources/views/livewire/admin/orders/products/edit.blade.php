<div>
    @section('title', 'Добавление товара в заказ')

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование товара</h3>
                </div>

                <form wire:submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="shop">Статус</label>
                            <div wire:ignore.self>
                                <x-inputs.select2 id="status_id">
                                    @foreach($statuses as $status)
                                        <option @if($status->id == $status_id) selected @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </x-inputs.select2>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop">Магазин</label>
                            <div wire:ignore.self>
                                <x-inputs.select2 id="shop_id">
                                    @foreach($shops as $shop)
                                        <option @if($shop->id == $shop_id) selected @endif value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </x-inputs.select2>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input wire:model="link" type="text" id="link" class="form-control" placeholder="Ссылка на товар">
                            @error('link') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input wire:model="title" type="text" id="title" class="form-control" placeholder="Название товара">
                            @error('title') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="options">Опции</label>
                            <input wire:model="options" type="text" id="options" class="form-control" placeholder="Опции товара">
                            @error('title') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input wire:model="price" id="price" placeholder="Цена товара" type="number" class="form-control">
                            </div>
                            @error('price') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Кол-во</label>
                            <input wire:model="quantity" type="number" name="quantity" id="quantity" class="form-control" placeholder="Количество товара">
                            @error('quantity') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.order.edit', ['order_id' => $order->id]) }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            document.addEventListener('productUpdated', () => {
                toastr.success('Товар успешно отредактирован!', 'Успех!', {
                    timeOut: 5000,
                    progressBar: true,
                    closeButton: true
                })
            })
        </script>
    @endsection
</div>
