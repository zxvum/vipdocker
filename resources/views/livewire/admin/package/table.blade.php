<div>
    @section('title', 'Таблица посылок')
    @include('components.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список посылок</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="btn-group-sm">
                            <a href="{{ route('admin.package.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form wire:submit.prevent="filter" class="d-flex align-items-center justify-content-between" style="padding: 0.75rem 1.25rem; border-bottom: 1px solid rgba(0,0,0,.125);">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <select wire:model="status_filter" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="-1">Все статусы</option>
                        @foreach($package_statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    <select wire:model="sort_direction" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="DESC">Самые новые</option>
                        <option value="ASC">Самые старые</option>
                    </select>
                    <button class="btn btn-sm btn-primary">Применить</button>
                </div>
            </form>

            <div class="card-body table-responsive p-0">
                <table id="table" class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Заказчик</th>
                        <th>Статус</th>
                        <th>Товаров</th>
                        <th>Цена</th>
                        <th class="d-flex justify-content-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody id="tablecontents">
                    @foreach($packages as $package)
                        <tr class="row1" wire:id="package-{{ $package->id }}">
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->user->name }} {{ $package->user->surname }}</td>
                            <td>
                            <p style="color: {{ $package->status->hex }};">{{ $package->status->name }}</p>
                            </td>
                            <td>
                                @php
                                    $cost = 0;
                                    foreach ($package->products as $product){
                                        $cost = $cost + ($product->price * $product->quantity);
                                    }
                                    echo $cost
                                @endphp $
                            </td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                <button wire:click="delete({{ $package->id }})" class="btn btn-danger" onclick="confirm('Вы действительно хотите удалить посылку?')"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
