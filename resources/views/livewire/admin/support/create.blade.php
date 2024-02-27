<div>
    @section('title', 'Создание тикета')

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание тикета</h3>
                </div>

                <form wire:submit.prevent="create" enctype="multipart/form-data">
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
                            @error('attachments') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
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
            })
        </script>
        @include('components.toasts')
    @endsection
</div>
