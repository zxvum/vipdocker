@section('title', 'Создание документа')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Добавление документа</h3>
                </div>

                <form wire:submit.prevent="submit">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название*</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Название документа">
                        </div>
                        <div class="form-group">
                            <label for="template_file">Файл шаблон</label>
                            <input wire:model="template_file" type="file" id="template_file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="example_file">Файл образец</label>
                            <input wire:model="example_file" type="file" id="example_file" class="form-control">
                        </div>
                        <div class="form-check">
                            <input wire:model="is_active" type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                            <label class="form-check-label" for="exampleCheck1">Активный</label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                        <a href="{{ route('admin.documents.form.table') }}" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')
    @include('components.toasts')
@endsection
