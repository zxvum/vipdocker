@section('title', 'Документы пользователей')

<div>
    <div class="row">
        @include('components.alerts')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список документов</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group-sm">
                                <a href="{{ route('admin.documents.user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        @foreach($documents as $document)
                            <tr class="row1" data-id="{{ $document->id }}">
                                <td>{{ $document->id }}</td>
                                <td>{{ $document->document->name }}</td>
                                <td>{{ $document->user->name }} {{ $document->user->surname }}</td>
                                <td>{{ $document->status->name }}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('admin.documents.user.edit', ['user_id' => $document->user_id, 'document_id' => $document->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    <button wire:click="deleteDocument({{ $document->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    @include('livewire.components.session-toasts')
    @include('components.toasts')
@endsection
