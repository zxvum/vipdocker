@extends('layouts.profile')

@section('title', 'Способы входа')

@section('profile')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <h5 class="card-header">Social Accounts</h5>
                    <div class="card-body">
                        <!-- Social Accounts -->
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/brands/vk.png') }}" alt="vkontakte" class="me-3"
                                     height="30">
                            </div>
                            <div class="flex-grow-1 row">
                                <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                    <h6 class="mb-0">VK</h6>
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'vkontakte')->exists()) <small class="text-primary">Привязан</small> @else
                                        <small class="text-muted">Не привязан</small> @endif
                                </div>
                                <div class="col-4 col-sm-5 text-end">
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'vkontakte')->exists())
                                        <a href="{{ route('unlink.socialite', ['provider' => 'vkontakte']) }}" class="btn btn-icon btn-label-danger">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('login.vk') }}" class="btn btn-icon btn-label-secondary">
                                            <i class="bx bx-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/brands/google.png') }}" alt="google" class="me-3"
                                     height="30">
                            </div>
                            <div class="flex-grow-1 row">
                                <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                    <h6 class="mb-0">Google</h6>
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'google')->exists()) <small class="text-primary">Привязан</small> @else
                                        <small class="text-muted">Не привязан</small> @endif
                                </div>
                                <div class="col-4 col-sm-5 text-end">
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'google')->exists())
                                        <a href="{{ route('unlink.socialite', ['provider' => 'google']) }}" class="btn btn-icon btn-label-danger">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('login.google') }}" class="btn btn-icon btn-label-secondary">
                                            <i class="bx bx-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/brands/discord.png') }}" alt="discord" class="me-3"
                                     height="30">
                            </div>
                            <div class="flex-grow-1 row">
                                <div class="col-8 col-sm-7 mb-sm-0 mb-2">
                                    <h6 class="mb-0">Discord</h6>
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'discord')->exists()) <small class="text-primary">Привязан</small> @else
                                        <small class="text-muted">Не привязан</small> @endif
                                </div>
                                <div class="col-4 col-sm-5 text-end">
                                    @if(\App\Models\SocialAccount::where('user_id', auth()->user()->id)->where('provider', 'discord')->exists())
                                        <a href="{{ route('unlink.socialite', ['provider' => 'discord']) }}" class="btn btn-icon btn-label-danger">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('login.discord') }}" class="btn btn-icon btn-label-secondary">
                                            <i class="bx bx-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /Social Accounts -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
