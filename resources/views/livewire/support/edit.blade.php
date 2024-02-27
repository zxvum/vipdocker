<div>
    @section('title', 'Создание обращения')

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Изображение</h5>
                    <button type="button" class="btn-close" wire:click="closeImageModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/'.$selectedImage) }}" class="img-fluid" id="previewImage" style="width: 100%; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-6">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Редактирование обращения: {{ $support->id }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update" enctype="multipart/form-data" method="get">
                        <div class="mb-3">
                            <label class="form-label" for="title">Название</label>
                            <input wire:model="title" type="text" class="form-control" name="name" id="title" placeholder="Наименование вашего обращения" value="{{ old('title') }}" required>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="theme_id">Тема обращения</label>
                            <select wire:model="theme_id" name="theme_id" id="theme_id" class="form-select">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" @if($theme->id = $support->theme_id) selected @endif>{{ $theme->name }}</option>
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
                        @if($attachments->count() > 0)
                            <div class="card accordion-item col-12 mb-3">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                        Прикрепленные файлы
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <div class="d-flex flex-column align-items-start">
                                            @foreach($attachments as $image)
                                                <button wire:click.prevent="openImageModal('{{ $image->path }}')" class="link-primary btn p-0 m-0">Открыть ({{ $image->filename }})</button>
                                            @endforeach
                                        </div>
                                        <div class="mt-2">
                                            <strong>!Важно: </strong> если вы загрузите новые файлы и обновите тикет, то ваши прошлые изображения будут автоматическки удалены.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Обновить</button>
                            <a href="{{ route('support.table') }}" class="btn btn-secondary">Назад</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            window.addEventListener('openImageModal', () => {
                $('#imageModal').modal('show');
            });

            window.addEventListener('closeImageModal', () => {
                $('#imageModal').modal('hide');
            });
        </script>
    @endsection
</div>
