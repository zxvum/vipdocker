<div>
    @section('title', 'Редактирование тикета')

{{--    MODAL--}}
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($selectedImage)
                        <img src="{{ asset('storage/'.$selectedImage) }}" class="img-fluid" id="previewImage" style="width: 100%; object-fit: contain;" alt="img">
                        <button wire:click="downloadImage" class="btn btn-primary mt-2">Скачать изображение</button>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

{{--    CONTENT--}}
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Редактирование тикета</h3>
                </div>

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">Пользователь</label>
                            <select class="form-control select2" id="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>{{ $user->name }} {{ $user->surname }}</option>
                                @endforeach
                            </select>
                            @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input wire:model="title" class="form-control" type="text">
                            @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="theme_id">Тема обращения</label>
                            <select class="form-control select2" id="theme_id">
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" @if($theme->id == $theme_id) selected @endif>{{ $theme->name }}</option>
                                @endforeach
                            </select>
                            @error('theme_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_id">Статус</label>
                            <select class="form-control select2" id="status_id">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" @if($status->id == $status_id) selected @endif>{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">Текст обращения</label>
                            <textarea wire:model="text" class="form-control" type="text"></textarea>
                            @error('text') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="attachments">Приложения</label>
                            <input wire:model="attachments" class="form-control" type="file" accept="image/jpeg, image/png, image/jpg, image/gif" multiple>
                            @error('attachments')
                                <p class="text-danger">{{ $message }}</p>
                            @else
                                <p class="text-muted">При загрузке новых изображений, старые удалятся!</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="btn btn-primary" data-toggle="collapse" data-target="#collapse">
                                Посмотреть приложения ({{ $ticket->attachments->count() }})
                            </div>
                            <ul class="collapse mt-2 list-group" id="collapse">
                                @foreach($ticket->attachments as $attachment)
                                    <li role="button" wire:click.prevent="openImageModal('{{ $attachment->path }}')" class="list-group-item list-group-item-action cursor-pointer">
                                        {{ $attachment->filename }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.support.table') }}" class="btn btn-secondary">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(() => {
                $('.select2').select2({
                    theme: 'bootstrap4'
                })
                $('#user_id').on('change', function (e) {
                    Livewire.emit('userListener', $('#user_id').val())
                })
                $('#theme_id').on('change', function (e) {
                    Livewire.emit('themeListener', $('#theme_id').val())
                })
                $('#status_id').on('change', function (e) {
                    Livewire.emit('statusListener', $('#status_id').val())
                })

                window.addEventListener('openImageModal', () => {
                    $('#imageModal').modal('show');
                });

                window.addEventListener('closeImageModal', () => {
                    $('#imageModal').modal('hide');
                });
            })
        </script>
        @include('components.toasts')
    @endsection
</div>
