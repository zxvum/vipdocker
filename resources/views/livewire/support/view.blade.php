<div>
    @section('title', 'Обращение в поддержку, ID: '.$support->id)

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Изображение</h5>
                    <button type="button" class="btn-close" wire:click="closeImageModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($selectedImage)
                        <img src="{{ asset('storage/'.$selectedImage) }}" class="img-fluid" id="previewImage" style="width: 100%; object-fit: contain;">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Обращение: {{ $support->title }}</h5>
            </div>
            <div class="card-body">
                <div class="item__text row fw-semibold">
                    <div class="col-md-6">
                        <div>Название: {{ $support->title }}</div>
                        <div>Тема: {{ $support->theme->name }}</div>
                        <div>Статаус: <span @if($support->status->is_custom) class="badge me-1" style="color: {{ $support->status->text_color }} !important; background: {{ $support->status->bg_color }};" @else class="badge bg-label-{{ $support->status->color_name }} me-1" @endif>{{ $support->status->name }}</span></div>
                        <div class="item__description"></div>
                    </div>
                    <div class="col-md-6 d-flex flex-column align-items-start">
                        @foreach($support->attachments as $image)
                            <button wire:click.prevent="openImageModal('{{ $image->path }}')" class="link-primary btn p-0 m-0">Открыть ({{ $image->filename }})</button>
                        @endforeach
                    </div>
                </div>
{{--                <div class="mt-2 d-flex flex-column align-items-start justify-content-start">--}}
{{--                    --}}
{{--                </div>--}}
                <div class="d-flex align-items-start flex-column flex-md-row justify-content-between gap-3 mt-3">
                    <div class="card accordion-item col-12 col-md-6">
                        <h2 class="accordion-header" id="headingTwo">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                Текст обращения
                            </button>
                        </h2>
                        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body">
                                <p>
                                    {{ $support->text }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('support.edit', ['id' => $support->id]) }}" class="btn btn-primary">Редактировать</a>
                    </div>
                    <a href="{{ route('support.table') }}" class="text-uppercase fw-semibold d-flex align-items-center gap-1">Все обращения<i class='bx bx-right-arrow-alt fw-semibold'></i></a>
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
