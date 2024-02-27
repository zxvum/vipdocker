<div>
    @section('title', 'Таблица заказов')
    @include('components.alerts')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Список заказов</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="btn-group-sm">
                            <a href="{{ route('admin.support.create') }}" class="btn btn-primary">
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
                    <select wire:model="statusFilter" class="form-control mr-2" style="width: 150px; height: 31px;">
                        <option value="-1">Все статусы</option>
                        @foreach($ticketStatuses as $ticket_status)
                            <option value="{{ $ticket_status->id }}">{{ $ticket_status->name }}</option>
                        @endforeach
                    </select>
                    <select wire:model="sortDirection" class="form-control mr-2" style="width: 150px; height: 31px;">
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
                        <th>ФИ</th>
                        <th>Название</th>
                        <th>Статус</th>
                        <th>Тема</th>
                        <th class="d-flex justify-content-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody id="tablecontents">
                    @foreach($tickets as $ticket)
                        <tr wire:key="{{ $ticket->id }}" class="row1">
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->name }} {{ $ticket->user->surname }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>
                                <p class="badge badge-{{ $ticket->status->color_name }}">{{ $ticket->status->name }}</p>
                            </td>
                            <td>
                                {{ $ticket->theme->name }}
                            </td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('admin.support.edit', ['ticket_id' => $ticket->id]) }}" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>
                                <button wire:click="deleteTicket({{ $ticket->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('js')
        @include('components.toasts')
    @endsection
</div>
