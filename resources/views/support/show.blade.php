@extends('layouts.dashboard.index')

@section('title', '| Chamados')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Chamado #{{ $support->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9">
                            <details-support-component
                                :support_data="{{ $support }}"
                            ></details-support-component>
                            {{-- <description-support-component
                                :support="{{ $support }}"
                                :user="{{ $user }}"
                            ></description-support-component> --}}
                            {{-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <edit-setor-servico-support-component
                                        :support="{{ $support }}"
                                        :user="{{ $user }}"
                                        :setores="{{ $setores }}"
                                    ></edit-setor-servico-support-component>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <mao-obra-support-component
                                        :support="{{ $support }}"
                                        :user="{{ $user }}"
                                    ></mao-obra-support-component>
                                </div>
                                <div class="col-md-6">
                                    <status-support-component
                                        :support="{{ $support }}"
                                        :user="{{ $user }}"
                                        :atendentes="{{ $atendentes }}"
                                    ></status-support-component>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="row">
                                <create-interacao-component
                                    :support="{{ $support }}"
                                    :user="{{ $user }}"
                                ></create-interacao-component>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
