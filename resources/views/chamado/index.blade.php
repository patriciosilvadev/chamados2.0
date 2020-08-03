@extends('layouts.dashboard.index')

@section('title', '| Chamados')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Chamados</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-chamado-component
                    :user="{{ $user }}"
                    :usuarios="{{ $usuarios }}"
                    :departamentos="{{ $departamentos }}"
                ></index-chamado-component>
                <modal-chamado-component
                    :user='{{ $user }}'
                ></modal-chamado-component>
            </div>
        </div>
    </div>
</div>
@endsection
