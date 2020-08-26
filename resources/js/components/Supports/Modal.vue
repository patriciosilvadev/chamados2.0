<template>
    <div
        class="modal fade"
        id="supportModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="supportModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title text-capitalize"
                        id="supportModalLabel"
                        v-html="
                            `support <b>#${support.id}</b> - Solicitante: <b>${support.user.name}</b>`
                        "
                        v-if="support.hasOwnProperty('id')"
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
                            <div
                                class="col-md-12 d-flex justify-content-center align-items-center flex-wrap"
                                v-if="support.hasOwnProperty('id')"
                            >
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Setor: ${support.sector.name}`"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Serviço: ${support.service.name}`"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-html="`Status: ${status}`"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="
                                        `Departamento: ${support.area.name}`
                                    "
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Mão de Obra: ${done_by}`"
                                    v-if="support.done_by != null"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Data Desejada: ${desired_date}`"
                                    v-if="support.desired_date != null"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Data Prevista: ${expected_date}`"
                                    v-if="support.expected_date != null"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Data Real: ${real_date}`"
                                    v-if="support.real_date != null"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Data Criação: ${created_at}`"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Data Modificado: ${updated_at}`"
                                ></span>
                                <span
                                    class="text-capitalize mx-4"
                                    v-text="`Descrição: ${support.description}`"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div
                                class="col-md-12 d-flex justify-content-end align-items-center"
                            >
                                <a
                                    class="btn btn-success"
                                    :href="`/supports/${support.id}/interacoes`"
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
    data() {
        return {
            support: {},
        };
    },
    computed: {
        created_at() {
            return moment(this.support.created_at).format("DD/MM/YYYY");
        },
        updated_at() {
            return moment(this.support.updated_at).format("DD/MM/YYYY");
        },
        desired_date() {
            return this.support.desired_date != null
                ? moment(this.support.desired_date).format("DD/MM/YYYY")
                : null;
        },
        expected_date() {
            return this.support.expected_date != null
                ? moment(this.support.expected_date).format("DD/MM/YYYY")
                : null;
        },
        real_date() {
            return this.support.real_date != null
                ? moment(this.support.real_date).format("DD/MM/YYYY")
                : null;
        },
        done_by() {
            return this.support.done_by == 1 ? "Própria" : "Terceirizada";
        },
        status() {
            if (this.support.status === 1)
                return '<span class="badge badge-pill badge-warning">Aberto</span>';
            else if (this.support.status === 2)
                return '<span class="badge badge-pill badge-primary">Andamento</span>';
            else if (this.support.status === 0)
                return '<span class="badge badge-pill badge-success">Concluído</span>';
            else if (this.support.status === 3)
                return '<span class="badge badge-pill badge-danger">Recusado</span>';
        },
    },
    created() {
        window.events.$on("sendsupport", (support) => {
            this.support = support;
        });
    },
};
</script>
