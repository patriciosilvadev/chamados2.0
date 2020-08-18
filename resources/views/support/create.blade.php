@extends('layouts.dashboard.index')

@section('title', '| Abrir Chamado')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Abrir Chamado</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-support-component
                    :departments="{{ $departments }}"
                    http_verb="post"
                >
                </create-update-support-component>
            </div>
        </div>
    </div>
</div>
@endsection
