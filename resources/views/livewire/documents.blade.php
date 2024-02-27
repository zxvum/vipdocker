<div>
    @section('title', 'Загрузка документов')

    <div
        class="col-12"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <div x-show="isUploading" x-transition class="progress mb-3">
            <div class="progress-bar" role="progressbar" x-bind:style="{ width: progress + '%' }"
                 x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100" x-text="progress + '%'">0%
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h5 class="mb-0">Ваши документы</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Название документа</th>
                            <th>Статус</th>
                            <th></th>
                            <th>Образец заполнения</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($documents as $key => $document)
                            <tr wire:key="document-{{ $document->id }}">
                                <td>
                                    {{ $document->name }}
                                    @if($document->template_file)
                                        (<button wire:click="downloadDocumentFile('{{ $document->template_file }}')" class="btn p-0 link-primary">скачать шаблон</button>)
                                    @endif
                                </td>
                                <td>{{ $this->getStatusName($document->id) }}</td>
                                <td>
                                    @if($this->hasUserDocument($document->id) && $user_document = $userDocuments->firstWhere('document_id', $document->id))
                                        <button
                                            wire:click="downloadDocument('{{ $user_document->filename }}')"
                                            class="link-primary btn p-0"
                                            type="button"
                                        >
                                            Скачать документ
                                        </button>
                                        <button wire:click="deleteDocument({{ $user_document->id }})" class="btn p-0 text-danger"><i class='bx bx-x-circle'></i></button>
                                    @else
                                        <input type="file" wire:model="files.{{$document->name}}"
                                               wire:change="setDocument({{ $document->id }})">
                                    @endif
                                    @error('files.'.$document->name)
                                        <script>
                                            sendError('{{ $message }}')
                                        </script>
                                    @enderror
                                </td>
                                <td>
                                    @if($document->example_file)
                                        (<button wire:click="downloadDocumentFile('{{ $document->example_file }}')" class="btn p-0 link-primary">скачать шаблон</button>)
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            document.addEventListener('successUploaded', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.success('Документ успешно загружен!', 'Успех!');
            })
            document.addEventListener('errorUploaded', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.error('Документ не загружен!', 'Ошибка!');
            })
            document.addEventListener('successDeleted', () => {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.error('Документ успешно удален!', 'Успех!');
            })
            function sendError(message) {
                toastr.options.timeOut = 5000;
                toastr.options.progressBar = true;
                toastr.options.closeButton = true;
                toastr.error(message, 'Ошибка!');
            }
        </script>
    @endsection
</div>
