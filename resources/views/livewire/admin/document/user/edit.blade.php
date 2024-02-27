@section('title', 'Редактирование адреса пользователя')

<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Документ пользователя: {{ $this->user->name }} {{ $this->user->surname }}</h3>
        </div>

        <form wire:submit.prevent="create">
            <div class="card-body">
                <div class="form-group">
                    <label for="user_id">Пользователь:</label>
                    <div wire:ignore>
                        <select name="user_id" id="user_id" class="select2" style="width: 100%">
                            @foreach ($users as $user)
                                <option @if($user->id == $this->user->id) selected
                                        @endif value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="document_id">Документ:</label>
                    <div wire:ignore>
                        <select class="select2" style="width: 100%" name="document_id" id="document_id">
                            @foreach ($documents as $document)
                                <option @if($document->id == $this->user_document->document_id) selected
                                        @endif value="{{ $document->id }}">{{ $document->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('document_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="document_file">Файл документа:</label>
                    <input wire:model="document_file" type="file" class="form-control">
                    @error('file') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label for="status_id">Статус документа</label>
                    <div wire:ignore>
                        <select style="width: 100%;" name="status_id" id="status_id" class="select2">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('status_id') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Создать</button>
                <a href="{{ route('admin.documents.user.table') }}" class="btn btn-danger">Отмена</a>
            </div>
        </form>
    </div>
</div>

@section('js')
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('#user_id').on('change', function (e) {
                Livewire.emit('userListener', $('#user_id').val())
            })
            $('#document_id').on('change', function (e) {
                Livewire.emit('documentListener', $('#document_id').val())
            })
            $('#status_id').on('change', function (e) {
                Livewire.emit('statusListener', $('#status_id').val())
            })
        })
    </script>
@endsection
