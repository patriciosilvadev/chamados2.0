<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png"> --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name') }} @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons" />
    <link href="{{ asset('css/chamados.css') }}" rel="stylesheet" />
    <script>
        var user = {
            name: '{{ auth()->user()->name }}',
            id: {{ auth()->user()->id }},
            department_id: {{ auth()->user()->department->id }},
            subdepartment_id: {{ auth()->user()->subdepartment->id }},
            role: '{{ auth()->user()->role() }}'
        }
    </script>
</head>
<body>
    <div class="wrapper" id="app">
        @include('layouts.dashboard.sidebar')
        <div class="main-panel">
            @include('layouts.dashboard.navbar')
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    {{-- @include('layouts.dashboard.content') --}}
                </div>
                @include('layouts.dashboard.footer')
            </div>
        </div>
        <flash message="{{ session('flash') }}"></flash>
    </div>
    <script src="{{ asset('js/chamados.js') }}"></script>
</body>
</html>
