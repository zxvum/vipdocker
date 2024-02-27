@if($package->status->id < 3)
    <div wire:ignore class="modal fade" id="edit" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form wire:submit.prevent="editPackage" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTitle">Редактирование заказа</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-1">
                        <div class="col">
                            <label for="edit_title" class="form-label">Название</label>
                            <input wire:model="title" type="text" id="edit_title" class="form-control" placeholder="Название заказа" value="{{ $package->title }}">
                        </div>
                        <div class="col mt-3">
                            <label for="edit_address" class="form-label">Адрес</label>
                            <select wire:model="address_id" id="edit_address" class="form-select">
                                <option selected disabled>---</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}" @if($address->id == $address_id) selected @endif>{{ $address->country->name }}, {{ $address->city }}, {{ $address->street }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mt-3">
                            <label for="edit_description" class="form-label">Описание</label>
                            <textarea wire:model="description" id="edit_description" cols="2" style="max-height: 150px" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endif
