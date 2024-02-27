<div>
    <div class="form-group">
        <label for="user_id">Владелец заказа(ID)</label>
        <input type="text" class="form-control" wire:model="user_id" name="user_id" id="user_id" placeholder="ID пользователя">
        @if($errors->any())
            @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
        @else
            <p class="text-{{ $color }}">{{ $msg }}</p>
        @endif
    </div>
</div>
