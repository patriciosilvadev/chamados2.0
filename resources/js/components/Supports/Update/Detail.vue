<template>
    <div class="status mb-3">
        <div class="row">
            <div class="col-md-4">
                <label>Solicitante:</label>
                <span v-text="local_chamado.usuario.nome"></span>
            </div>
            <div class="col-md-4">
                <label>Status:</label>
                <span v-html="status"></span>
            </div>
            <div class="col-md-6" v-if="local_chamado.status == 3">
                <label>Justificativa:</label>
                <span v-html="local_chamado.justificativa.justificativa"></span>
            </div>
            <div class="col-md-4">
                <label>Data criação:</label> <span v-text="created"></span>
            </div>
            <div class="col-md-4">
                <label>Data modificado:</label>
                <span v-text="updated"></span>
            </div>
            <div class="col-md-4" v-if="local_chamado.local">
                <label>Local:</label>
                <span v-text="local_chamado.local.nome"></span>
            </div>
            <div class="col-md-4" v-if="local_chamado.ambiente">
                <label>Ambiente:</label>
                <span v-text="local_chamado.ambiente.nome"></span>
            </div>
            <div class="col-md-4">
                <label>Setor:</label>
                <span v-text="local_chamado.setor.nome"></span>
            </div>
            <div class="col-md-4">
                <label>Serviço:</label>
                <span v-text="local_chamado.servico.nome"></span>
            </div>
            <div class="col-md-4">
                <label>Departamento:</label>
                <span v-text="local_chamado.departamento.nome"></span>
            </div>
            <div class="col-md-4">
                <label>Mão de Obra:</label>
                <span v-text="mao_de_obra"></span>
            </div>
            <div class="col-md-4" v-if="local_chamado.horas_previstas != null">
                <label>Horas previstas:</label>
                <span
                    v-text="`${local_chamado.horas_previstas} hora(s)`"
                ></span>
            </div>
            <div class="col-md-4" v-if="local_chamado.horas_real != null">
                <label>Horas real:</label>
                <span v-text="`${local_chamado.horas_real} hora(s)`"></span>
            </div>
            <div class="col-md-4" v-if="data_desejada != null">
                <label>Data desejada:</label>
                <span v-text="data_desejada"></span>
            </div>
            <div class="col-md-4" v-if="data_prevista != null">
                <label>Data prevista:</label>
                <span v-text="data_prevista"></span>
            </div>
            <div class="col-md-4" v-if="data_real != null">
                <label>Data real:</label>
                <span v-text="data_real"></span>
            </div>
            <div class="col-md-12" v-if="local_chamado.atendida_por != null">
                <label>Atendida por:</label>
                <span
                    v-for="(atendente, index) in local_chamado.atendida_por"
                    v-text="`${atendente.nome}; `"
                    :key="index"
                ></span>
            </div>
            <div class="col-md-12">
                <label>Descrição:</label>
                <span v-text="local_chamado.descricao"></span>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button
                    v-if="
                        local_chamado.status == 1 &&
                            local_chamado.user_id == user.id
                    "
                    class="btn"
                    :class="{ 'btn-info': !show, 'btn-danger': show }"
                    @click.prevent="editar()"
                >
                    {{ !show ? "Editar Descrição" : "Cancelar" }}
                </button>
                <span
                    v-if="local_chamado.anexo"
                    class="d-inline-block ml-3"
                    tabindex="0"
                    data-toggle="tooltip"
                    title="Download do Anexo"
                >
                    <a
                        :href="`/chamados/get/anexo/${local_chamado.anexo}`"
                        class="btn btn-dark"
                        ><i class="fas fa-cloud-download-alt"></i
                    ></a>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["chamado", "user"],
    data() {
        return {
            local_chamado: this.chamado,
            show: false,
        };
    },
    computed: {
        status() {
            if (this.local_chamado.status === 1)
                return '<span class="badge badge-pill badge-warning">Aberto</span>';
            else if (this.local_chamado.status === 2)
                return '<span class="badge badge-pill badge-primary">Andamento</span>';
            else if (this.local_chamado.status === 0)
                return '<span class="badge badge-pill badge-success">Concluído</span>';
            else if (this.local_chamado.status === 3)
                return '<span class="badge badge-pill badge-danger">Recusado</span>';
        },
        created() {
            return moment(this.local_chamado.created_at).format("DD/MM/YYYY");
        },
        updated() {
            return moment(this.local_chamado.updated_at).format("DD/MM/YYYY");
        },
        data_desejada() {
            return this.local_chamado.data_desejada != null
                ? moment(this.local_chamado.data_desejada).format("DD/MM/YYYY")
                : null;
        },
        data_prevista() {
            return this.local_chamado.data_prevista != null
                ? moment(this.local_chamado.data_prevista).format("DD/MM/YYYY")
                : null;
        },
        data_real() {
            return this.local_chamado.data_real != null
                ? moment(this.local_chamado.data_real).format("DD/MM/YYYY")
                : null;
        },
        mao_de_obra() {
            return this.local_chamado.mao_de_obra == 1
                ? "Própria"
                : "Terceirizada";
        },
    },
    methods: {
        editar() {
            this.show = !this.show;
            window.events.$emit("editar", this.show);
        },
    },
    created() {
        window.events.$on("send_status", (chamado) => {
            this.local_chamado = chamado;
        });

        window.events.$on("send_mao_de_obra", (chamado) => {
            this.local_chamado.mao_de_obra = chamado.mao_de_obra;
        });

        window.events.$on("send_descricao", (chamado) => {
            this.local_chamado.descricao = chamado.descricao;
        });

        window.events.$on("setor_servico", (chamado) => {
            this.local_chamado.setor = chamado.setor;
            this.local_chamado.servico = chamado.servico;
            this.local_chamado.setor_id = chamado.setor_id;
            this.local_chamado.servico_id = chamado.servico_id;
        });

        window.events.$on("editado", (value) => {
            this.show = value;
        });
    },
};
</script>
