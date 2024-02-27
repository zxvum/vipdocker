@section('title', 'Счета')

<div>
    <div class="row">
        @include('components.alerts')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список счетов</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="margin-right: 300%;">
                                    <a class="dropdown-item" href="{{ route('admin.invoice.create.order') }}">Под заказ</a>
                                    <a class="dropdown-item" href="{{ route('admin.invoice.create.package') }}">Под посылку</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Пользователь</th>
                            <th>Статус</th>
                            <th>Кол-во услуг</th>
                            <th>Стоимость</th>
                            <th>Тип</th>
                            <th class="d-flex justify-content-end">Действия</th>
                        </tr>
                        </thead>
                        <tbody id="tablecontents">
                        @foreach($invoices as $invoice)
                            <tr class="row1" data-id="{{ $invoice->id }}">
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->user->fullname() }}</td>
                                <td>{{ $invoice->status->name }}</td>
                                <td>{{ $invoice->services->count() }}</td>
                                <td>{{ $invoice->total_price }}</td>
                                <td>
                                    @if($invoice->order_id) Заказ @elseif($invoices->package_id) Посылка @endif
                                </td>
                                <td class="d-flex justify-content-end">
                                    @if($invoice->order_id)
                                        <a href="{{ route('admin.invoice.edit.order', ['invoice_id' => $invoice->id, 'order_id' => $invoice->order_id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    @else
                                        <a href="#" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                    @endif
                                    <button wire:click="deleteInvoice({{ $invoice->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
