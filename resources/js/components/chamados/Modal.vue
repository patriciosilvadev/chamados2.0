<template>
    <div
        class="modal fade"
        id="chamadoModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="chamadoModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="chamadoModalLabel"
                        v-html="
                            `Chamado <b>#${chamado.id}</b> - Solicitante: <b>${chamado.usuario.nome}</b>`
                        "
                        v-if="chamado.hasOwnProperty('id')"
                    ></h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container fluid">
                        <div class="row">
                            <div class="col-md-4" v-if="chamado.local">
                                <label for="">Local:</label>
                                <span
                                    v-text="chamado.local.nome"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div class="col-md-4" v-if="chamado.ambiente">
                                <label for="">Ambiente:</label>
                                <span
                                    v-text="chamado.ambiente.nome"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Setor:</label>
                                <span
                                    v-text="chamado.setor.nome"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>

                            <div class="col-md-4">
                                <label for="">Serviço:</label>
                                <span
                                    v-text="chamado.servico.nome"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Status:</label>
                                <span
                                    v-html="status"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Departamento:</label>
                                <span
                                    v-text="chamado.departamento.nome"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div class="col-md-4">
                                <label>Mão de Obra:</label>
                                <span v-text="mao_de_obra"></span>
                            </div>
                            <div
                                class="col-md-4"
                                v-if="chamado.data_desejada != null"
                            >
                                <label>Data desejada:</label>
                                <span v-text="data_desejada"></span>
                            </div>
                            <div
                                class="col-md-4"
                                v-if="chamado.data_prevista != null"
                            >
                                <label>Data prevista:</label>
                                <span v-text="data_prevista"></span>
                            </div>
                            <div
                                class="col-md-4"
                                v-if="chamado.data_real != null"
                            >
                                <label>Data real:</label>
                                <span v-text="data_real"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Data criação:</label>
                                <span
                                    v-text="created"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>

                            <div class="col-md-4">
                                <label for="">Data modificado:</label>
                                <span
                                    v-text="updated"
                                    v-if="chamado.hasOwnProperty('id')"
                                ></span>
                            </div>
                            <div
                                class="col-md-4"
                                v-if="chamado.horas_previstas != null"
                            >
                                <label>Horas previstas:</label>
                                <span
                                    v-text="
                                        `${chamado.horas_previstas} hora(s)`
                                    "
                                ></span>
                            </div>
                            <div
                                class="col-md-4"
                                v-if="chamado.horas_real != null"
                            >
                                <label>Horas real:</label>
                                <span
                                    v-text="`${chamado.horas_real} hora(s)`"
                                ></span>
                            </div>

                            <div
                                class="col-md-12"
                                v-if="chamado.atendida_por != null"
                            >
                                <label>Atendida por:</label>
                                <span
                                    v-for="(atendente,
                                    index) in chamado.atendida_por"
                                    v-text="`${atendente.nome}; `"
                                    :key="index"
                                ></span>
                            </div>

                            <div class="col-md-12">
                                <label for="">Descrição:</label>
                                <span v-text="chamado.descricao"></span>
                            </div>

                            <div
                                class="col-md-12 d-flex justify-content-end align-items-center"
                            >
                                <span
                                    class="d-inline-block"
                                    tabindex="0"
                                    data-toggle="tooltip"
                                    title="Download do Anexo"
                                >
                                    <a
                                        v-if="chamado.anexo"
                                        :href="
                                            `/chamados/get/anexo/${chamado.anexo}`
                                        "
                                        class="btn btn-dark"
                                        ><i
                                            class="fas fa-cloud-download-alt"
                                        ></i
                                    ></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="modal-footer"
                    v-if="suporte || chamado.usuario_id == user.cod_usuario"
                >
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="col-md-12 d-flex justify-content-end align-items-center"
                            >
                                <a
                                    class="btn btn-success"
                                    :href="`/chamados/${chamado.id}/interacoes`"
                                    ><i class="fas fa-binoculars"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["user"],
    data() {
        return {
            chamado: {},
            loading: false,
        };
    },
    computed: {
        created() {
            return moment(this.chamado.created_at).format("DD/MM/YYYY");
        },
        updated() {
            return moment(this.chamado.updated_at).format("DD/MM/YYYY");
        },
        data_desejada() {
            return this.chamado.data_desejada != null
                ? moment(this.chamado.data_desejada).format("DD/MM/YYYY")
                : null;
        },
        data_prevista() {
            return this.chamado.data_prevista != null
                ? moment(this.chamado.data_prevista).format("DD/MM/YYYY")
                : null;
        },
        data_real() {
            return this.chamado.data_real != null
                ? moment(this.chamado.data_real).format("DD/MM/YYYY")
                : null;
        },
        mao_de_obra() {
            return this.chamado.mao_de_obra == 1 ? "Própria" : "Terceirizada";
        },
        status() {
            if (this.chamado.status === 1)
                return '<span class="badge badge-warning">Aberto</span>';
            else if (this.chamado.status === 2)
                return '<span class="badge badge-primary">Andamento</span>';
            else if (this.chamado.status === 0)
                return '<span class="badge badge-success">Concluído</span>';
            else if (this.chamado.status === 3)
                return '<span class="badge badge-danger">Recusado</span>';
        },
        diretoria() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 3) boolean = true;
            });
            return boolean;
        },
        gestorSuporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                this.user.departamentos.forEach((departamento) => {
                    if (
                        funcao.cod_papel === 2 &&
                        (departamento.cod_grupo === 2 ||
                            departamento.cod_grupo === 13)
                    )
                        boolean = true;
                });
            });
            return boolean;
        },
        gestor() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 2 && !this.gestorSuporte)
                    boolean = true;
            });
            return boolean;
        },
        suporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 8 || this.gestorSuporte)
                    boolean = true;
            });
            return boolean;
        },
    },
    created() {
        window.events.$on("sendchamado", (chamado) => {
            this.chamado = chamado;
        });
    },
};
</script>
