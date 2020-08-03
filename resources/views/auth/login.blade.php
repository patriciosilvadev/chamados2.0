@extends('layouts.auth')

@section('title', ' | Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4>{{ __('Login') }}</h4>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a class="btn" href="{{ route('socialite.provider', 'google') }}">
                                    <img class="img-fluid img-thumbnail google-logo" src="{{ asset('img/google_logo.png') }}" alt="GOOGLE_LOGO"></i>&nbsp;<span>Login com conta Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
