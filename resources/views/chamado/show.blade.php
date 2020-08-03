@extends('layouts.dashboard.index')

@section('title', '| Chamados')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Chamado #{{ $chamado->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <details-chamado-component
                                :chamado="{{ $chamado }}"
                                :user="{{ $user }}"
                            ></details-chamado-component>
                            <description-chamado-component
                                :chamado="{{ $chamado }}"
                                :user="{{ $user }}"
                            ></description-chamado-component>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <edit-setor-servico-chamado-component
                                        :chamado="{{ $chamado }}"
                                        :user="{{ $user }}"
                                        :setores="{{ $setores }}"
                                    ></edit-setor-servico-chamado-component>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <mao-obra-chamado-component
                                        :chamado="{{ $chamado }}"
                                        :user="{{ $user }}"
                                    ></mao-obra-chamado-component>
                                </div>
                                <div class="col-md-6">
                                    <status-chamado-component
                                        :chamado="{{ $chamado }}"
                                        :user="{{ $user }}"
                                        :atendentes="{{ $atendentes }}"
                                    ></status-chamado-component>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <create-interacao-component
                                    :chamado="{{ $chamado }}"
                                    :user="{{ $user }}"
                                ></create-interacao-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
