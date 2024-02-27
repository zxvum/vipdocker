<div>
    <div class="modal fade" id="products" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                                    <th class="text-center">#</th>
                                    <th class="text-center">Название</th>
                                    <th class="text-center">Статус</th>
                                    <th class="text-center">Кол-во</th>
                                    <th class="text-center">Цена</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($products_modal as $product)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox">
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
                    <button type="submit" class="btn btn-primary">Добавить выбранные товары</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Товары в посылке</h5>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>Всего товаров: 0</div>
                <div class="d-flex gap-2">
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
                    <tr>
                        <td class="text-center"><a href="#" class="link-primary">1</a></td>
                        <td class="text-center">Товар такой-то</td>
                        <td class="text-center"><p style="color: #000000;">Статус</p></td>
                        <td class="text-center">12</td>
                        <td class="text-center">599$</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm"><i class="bx bx-show"></i></a>
                            <a href="#" type="button" class="btn btn-success btn-sm"><i class="bx bx-edit"></i></a>
                            <a href="#" onclick="confirm('Вы действительно хотите удалить заказ?')" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
