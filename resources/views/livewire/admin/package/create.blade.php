<div>
    @section('title', 'Создание посылки')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание посылки</h3>
                </div>

                <form action="{{ route('admin.order.create.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @livewire('components.user-id-input')
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name"
                                   placeholder="Название заказа">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group" data-select2-id="61">
                            <label for="user-select">Пользователь</label>
                            <select id="user-select" class="form-control form-select select2"
                                    style="width: 100%;">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{$user->name}} {{$user->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" value="{{ old('description') }}" name="description"
                                   id="description" placeholder="Название заказа">
                            @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('admin-assets/plugins/select2/js/select2.js') }}"></script>
        <script>
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        </script>
    @endsection
</div>
