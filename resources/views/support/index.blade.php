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
                <index-support-component></index-support-component>
            </div>
        </div>
    </div>
</div>
<modal-support-component></modal-support-component>
@endsection
