@extends('admin.layouts.app')

@section('title', 'Создание заказа')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание заказа</h3>
                </div>

                <form action="{{ route('admin.order.create.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @livewire('components.user-id-input')
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Название заказа">
                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" value="{{ old('description') }}" name="description" id="description" placeholder="Название заказа">
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
@endsection
