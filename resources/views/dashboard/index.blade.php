@extends('layouts.dashboard.index')

@section('title', '| Dashboard')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Dashboard</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <report-chamado-component :user="{{ $user }}" :users="{{ $users }}" :departments="{{ $departments }}"></report-chamado-component>
                <div class="container-fluid">
                    <div class="row status mt-3">
                        <div class="col-md-12">
                            <h3 class="text-center">Gráficos</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="text-center">Chamados/Setores</h5>
                            <chart-setores-component></chart-setores-component>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="text-center">Chamados/Status</h5>
                            <chart-status-component></chart-status-component>
                        </div>
                        <div class="col-md-12">
                            <h5 class="text-center">Chamados/Serviços</h5>
                            <chart-servicos-component></chart-servicos-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
