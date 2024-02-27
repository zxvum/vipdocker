@extends('layouts.app')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Профиль /</span> @yield('title')
    </h4>
    <div class="col-md-12" data-select2-id="15">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><a class="nav-link {{ request()->is('profile/account') ? 'active' : '' }}" href="{{ route('profile.account') }}"><i class="bx bx-user me-1"></i> Аккаунт</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->is('profile/security') ? 'active' : '' }}" href="{{ route('profile.security') }}"><i class="bx bx-lock-alt me-1"></i> Безопасность</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->is('profile/bills-and-payments') ? 'active' : '' }}" href="{{ route('profile.bills-and-payments') }}"><i class="bx bx-detail me-1"></i> Платежи &amp; Счета</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->is('profile/connection') ? 'active' : '' }}" href="{{ route('soon') }}"><i class="bx bx-link-alt me-1"></i> Способы входа</a></li>
        </ul>
        @yield('profile')
    </div>
@endsection
