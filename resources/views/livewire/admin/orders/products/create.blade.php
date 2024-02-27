@section('title', 'Добавление товара в заказ')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание товара</h3>
                </div>

                <form wire:submit.prevent="updateProduct">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status_id">Статус</label>
                            <div wire:ignore.self>
                                <x-inputs.select2 id="status_id">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" @if($status->id == $status_id) selected @endif>{{ $status->name }}</option>
                                    @endforeach
                                </x-inputs.select2>
                            </div>
                            @error('status_id') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="shop_id">Магазин</label>
                            <div wire:ignore.self>
                                <x-inputs.select2 id="shop_id">
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}" @if($shop->id == $shop_id) selected @endif>{{ $shop->name }}</option>
                                    @endforeach
                                </x-inputs.select2>
                            </div>
                            <a href="{{ route('admin.shop.add') }}">Создать новый</a>
                            @error('shop_id') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Ссылка</label>
                            <input wire:model="link" type="text" id="link" class="form-control" placeholder="Ссылка на товар">
                            @error('link') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input wire:model="title" type="text" name="title" id="title" class="form-control" placeholder="Название товара">
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
                            <label for="options">Опции</label>
                            <input wire:model="options" type="text" name="options" id="options" class="form-control" placeholder="Размер/Цвет/Параметры товара">
                            @error('quantity') <p class="text-danger"> {{ $message }} </p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Кол-во</label>
                            <input wire:model="quantity" type="number" name="quantity" id="quantity" class="form-control" placeholder="Количество товара">
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
</div>
