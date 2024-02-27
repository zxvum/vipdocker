<div>
    @section('title', 'Все обращения')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <h5 class="mb-0">Все ваши обращения</h5>
                </div>
                <a href="{{ route('support.create') }}" data-bs-toggle="tooltip" data-bs-offset="0,8" data-bs-placement="top" data-bs-original-title="Доступно: {{ 5 - $tickets_count }}" class="btn btn-primary" @if($tickets_count >= 5) disabled @endif>
                    Новое
                    <i class="bx bx-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Название</th>
                            <th class="text-center">Тема</th>
                            <th>Статус</th>
                            <th class="text-center">Действия</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if($supports->count() < 1)
                            <tr>
                                <td colspan="6" class="text-center">У вас еще нет обращений, <a href="{{ route('support.create') }}" class="link-info">создайте новое</a>, чтобы оно тут появилось.</td>
                            </tr>
                        @else
                            @foreach($supports as $support)
                                <tr>
                                    <td class="text-center">{{ $support->id }}</td>
                                    <td class="text-center">{{ $support->title }}</td>
                                    <td class="text-center">{{ $support->theme->name }}</td>

                                    <td><span @if($support->status->is_custom) class="badge me-1" style="color: {{ $support->status->text_color }} !important; background: {{ $support->status->bg_color }};" @else class="badge bg-label-{{ $support->status->color_name }} me-1" @endif>{{ $support->status->name }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('support.view', ['id' => $support->id]) }}" class="btn btn-primary btn-sm"><i class="bx bx-show"></i></a>
                                        <a href="{{ route('support.edit', ['id' => $support->id]) }}" type="button" class="btn btn-success btn-sm"><i class="bx bx-edit"></i></a>
                                        <a href="#" onclick="confirm('Вы действительно хотите удалить заказ?')" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
