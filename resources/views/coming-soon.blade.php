@extends('layouts.connection-layout')

@section('title', 'Скоро...')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}">
@endsection

@section('include')
    <div class="container-xxl py-3">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Скоро появится...</h2>
            <p class="mb-4 mx-2">Мы создаем что-то потрясающее.</p>
{{--            <form onsubmit="return false">--}}
{{--                <div class="d-flex gap-2">--}}
{{--                    <input type="text" class="form-control" placeholder="email" autofocus="">--}}
{{--                    <button type="submit" class="btn btn-primary">Подписаться</button>--}}
{{--                </div>--}}
{{--            </form>--}}
            <a href="{{ route('home') }}" class="btn btn-primary">На главную</a>
            <div class="mt-5">
                <img src="{{ asset('assets/img/illustrations/boy-with-rocket-light.png') }}" alt="boy-with-rocket-light"
                     width="500"
                     class="img-fluid" data-app-dark-img="illustrations/boy-with-rocket-dark.png"
                     data-app-light-img="illustrations/boy-with-rocket-light.png">
            </div>
        </div>
    </div>
@endsection
