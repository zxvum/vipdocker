@section('title', 'Счета')

<div>
    <div class="row">
        <div class="col-12">
            @include('components.alerts')
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Создание счета</h3>
                </div>

                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user_id">Пользователь</label>
                            <x-inputs.select2 id="user_id">
                                <option selected disabled>Выберите пользователя</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullname() }}</option>
                                @endforeach
                            </x-inputs.select2>
                        </div>

                        <div class="form-group">
                            <label for="type">Тип</label>
                            <x-inputs.select2 id="type" placeholder="Select Members">
                                <option selected disabled>Выберите тип</option>
                                <option value="order">Заказ</option>
                                <option value="package">Посылка</option>
                            </x-inputs.select2>
                        </div>

                        <div style="display: @if($type === 'order') block @else none @endif" class="form-group">
                            <label for="order_id">Заказ</label>
                            <x-inputs.select2 id="order_id">
                                <option selected disabled>Выберите заказ</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->id }} - {{ $order->name }}</option>
                                @endforeach
                            </x-inputs.select2>
                        </div>

                        <div style="display: @if($type === 'package') block @else none @endif" class="form-group">
                            <label for="package_id">Посылка</label>
                            <x-inputs.select2 id="package_id">
                                <option selected disabled>Выберите посылку</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->id }} - {{ $package->name }}</option>
                                @endforeach
                            </x-inputs.select2>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="#" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
