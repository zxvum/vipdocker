<div>
    @section('title', 'Создание заказа')

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Создание заказа</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="createOrder">
                        <div class="mb-3">
                            <label class="form-label" for="title">Название</label>
                            <input wire:model="title" type="text" class="form-control" name="name" id="title" placeholder="Новый заказ" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Описание</label>
                            <input wire:model="description" type="text" class="form-control" name="description" id="description" placeholder="Описание и пожелания к заказу">
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Перейти к добавлению товаров</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
