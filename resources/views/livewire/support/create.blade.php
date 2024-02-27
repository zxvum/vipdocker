<div>
    @section('title', 'Создание обращения')

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Создание обращения</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data" method="get">
                        <div class="mb-3">
                            <label class="form-label" for="title">Название</label>
                            <input wire:model="title" type="text" class="form-control" name="name" id="title" placeholder="Наименование вашего обращения" value="{{ old('title') }}" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="theme_id">Тема обращения</label>
                            <select wire:model="theme_id" name="theme_id" id="theme_id" class="form-select">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                @endforeach
                            </select>
                            @error('theme_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="text">Текст обращения</label>
                            <textarea wire:model="text" placeholder="Опишите подробно вашу проблему" name="text" id="text" class="form-control" style="min-height: 100px; height: 150px !important; max-height: 300px;"></textarea>
                            @error('text') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="media" class="form-label">Выбор файлов</label>
                            <input wire:model="files" class="form-control" type="file" id="media" name="media[]" multiple="" accept=".jpg,.png,.jpeg,.webp" max="5">
                            @if($errors->has('files'))
                                @error('files') <p class="text-danger">{{ $message }}</p> @enderror
                            @else
                                <p><strong>!Внимание:</strong> не более 5 файлов.</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
