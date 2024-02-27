<div>
    @section('title', $package->title)

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/multiselect/css/multi-select.css') }}">
    @endsection

    <div wire:ignore class="modal fade" id="products" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
            <form action="#" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Добавление товаров из списка</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th>
                                    <th class="text-center">Название</th>
                                    <th class="text-center">Статус</th>
                                    <th class="text-center">Кол-во</th>
                                    <th class="text-center">Цена</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($products_modal as $product)
                                    <tr wire:key="{{ $product->id }}">
                                        <td class="dt-checkboxes-cell">
                                            <input wire:model="selected_products.{{ $product->id }}" type="checkbox" class="dt-checkboxes form-check-input" @if($package->products->contains('id', $product->id)) checked @endif />
                                        </td>
                                        <td class="text-center">{{ $product->title }}</td>
                                        <td class="text-center"><p style="color: #000000;">Статус</p></td>
                                        <td class="text-center">12</td>
                                        <td class="text-center">599$</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Отменить
                    </button>
                    <button type="button" wire:click="add_selected_products" class="btn btn-primary">Добавить выбранные товары</button>
                </div>
            </form>
        </div>
    </div>

{{--    edit model--}}


    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h5 class="mb-0">Информация о посылке</h5> <span class="badge bg-info">{{ $package->status->name }}</span>
                </div>
                <span class="bx bx-edit h4 cursor-pointer" data-bs-toggle="modal" data-bs-target="#edit"></span>
            </div>
            <div class="card-body">
                <div class="item__text row fw-semibold">
                    <div class="col-md-6">
                        <div class="item__client">Клиент: {{ auth()->user()->name }} {{ auth()->user()->surname }}</div>
                        <div>Дата создания: {{ $package->created_at }}</div>
                        <div>Дата обновления: {{ $package->updated_at }}</div>
                        <div>Трек номер: {{ $package->track_number ?? 'Не присвоен' }}</div>
                        <div class="item__description"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="item__title">Данные доставки:</div>
                        <div class="item__fio">ФИО: {{ $package->address->name }} {{ $package->address->surname }}</div>
                        <div class="item__address text-truncate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" title="" data-bs-original-title="{{ $package->address->postal_code }}, {{ $package->address->country->name }}, {{ $package->address->region }}, {{{ $package->address->city }}}, {{ $package->address->street }}">Адрес: {{ $package->address->postal_code }}, {{ $package->address->country->name }}, {{ $package->address->region }}, {{{ $package->address->city }}}, {{ $package->address->street }}</div>
                        <div class="item__phone">Телефон: {{ $package->address->phone_number }}</div>
                    </div>
                </div>
                <div class="d-flex align-items-start flex-column flex-md-row justify-content-between gap-3 mt-3">
                    <div class="card accordion-item col-12 col-md-6">
                        <h2 class="accordion-header" id="headingTwo">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                Отслеживание по трек номеру
                            </button>
                        </h2>
                        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <span class="text-warning">Обратите внимание:</span> отслеживание по номеру отправления будет работать после того, как партия будет
                                принята в отделение Почты России в Европе. При присвоении вы получите уведомление на свой email адрес.
                                А также сможете самостоятельно отследивать статус на портале - <a href="https://pochta.ru">pochta.ru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card accordion-item col-12 col-md-6">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                                Параметры коробки
                            </button>
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body d-flex flex-column gap-1">
                                <div class="row row-cols-2">
                                    <p><span class="fw-semibold">Размер:</span> 2.54 / 31.75 / 19.05</p>
                                    <p class="text-truncate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" title="" data-bs-original-title="(СМ) ширина/глубина/высота">(СМ) ширина/глубина/высота</p>
                                </div>
                                <div class="row row-cols-2">
                                    <p><span class="fw-semibold">Вес:</span> 2.68</p>
                                    <p>(КГ)</p>
                                </div>
                                <div class="row row-cols-2">
                                    <p><span class="fw-semibold">Объемный вес:</span> 0.26</p>
                                    <p class="text-truncate" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="(КГ) <small>Объемный вес = ширина * высоту * ширину / 6000</small>">(КГ) <small>Объемный вес = ширина * высоту * ширину / 6000</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Товары в посылке</h5>
            </div>
            <div class="card-body">
                <div class="d-flex mb-2 mb-md-0 flex-column flex-md-row align-items-center justify-content-between gap-2 gap-md-0">
                    <div>Всего товаров: {{ $package->products->count() }}</div>
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button class="btn btn-primary">Добавить заказ целиком</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#products">Выбрать из списка товаров</button>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Название</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">Кол-во</th>
                            <th class="text-center">Цена</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($package->products as $product)
                            <tr>
                                <td class="text-center"><a href="#" class="link-primary">{{ $product->id }}</a></td>
                                <td class="text-center">{{ $product->title }}</td>
                                <td class="text-center"><p style="color: {{ $product->status->hex }};">{{ $product->status->name }}</p></td>
                                <td class="text-center">{{ $product->quantity }}</td>
                                <td class="text-center">{{ $product->price }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="bx bx-show"></i></a>
                                    <a href="#" type="button" class="btn btn-success btn-sm"><i class="bx bx-edit"></i></a>
                                    <a href="#" onclick="confirm('Вы действительно хотите удалить заказ?')" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
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
    @include('components.toasts')
@endsection
