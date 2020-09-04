<template>
    <div class="container-fluid status mb-3">
        <div
            class="row d-flex flex-wrap justify-content-center align-items-center"
        >
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Solicitante: ${support.user.name}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-html="`Status: ${status}`"
            ></span>

            <span
                class="text-capitalize mx-3 my-1"
                v-if="support.status == 3"
                v-html="`Justificativa: ${support.justificativa.justificativa}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Data criação: ${created}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Última Atualização: ${updated}`"
            ></span>
            <span
                v-if="support.environment"
                class="text-capitalize mx-3 my-1"
                v-text="`Local: ${support.environment.name}`"
            ></span>
            <span
                v-if="support.spot"
                class="text-capitalize mx-3 my-1"
                v-text="`Ambiente: ${support.spot.name}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Setor: ${support.sector.name}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Serviço: ${support.service.name}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Departamento: ${support.area.name}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Mão de Obra: ${execution_by}`"
            ></span>
            <span
                v-if="support.expected_hours"
                class="text-capitalize mx-3 my-1"
                v-text="`Horas previstas: ${support.expected_hours} hora(s)`"
            ></span>
            <span
                v-if="support.real_hours"
                class="text-capitalize mx-3 my-1"
                v-text="`Horas real: ${support.real_hours} hora(s)`"
            ></span>
            <span
                v-if="desired_date"
                class="text-capitalize mx-3 my-1"
                v-text="`Data desejada: ${desired_date}`"
            ></span>
            <span
                v-if="expected_date"
                class="text-capitalize mx-3 my-1"
                v-text="`Data prevista: ${expected_date}`"
            ></span>
            <span
                v-if="real_date"
                class="text-capitalize mx-3 my-1"
                v-text="`Data real: ${real_date}`"
            ></span>
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Atendida por: ${atendente.name}; `"
                v-for="(atendente, index) in support.done_by"
                :key="index"
                >`</span
            >
            <span
                class="text-capitalize mx-3 my-1"
                v-text="`Descrição: ${support.description}`"
            ></span>
        </div>
        <div
            class="row mt-2 d-flex justify-content-end align-items-center flex-wrap"
        >
            <button
                v-if="support.status == 1 && support.user_id == authUser.id"
                class="btn mx-1"
                :class="{ 'btn-info': !show, 'btn-danger': show }"
                @click.prevent="editDescription()"
            >
                {{ !show ? "Editar Descrição" : "Cancelar" }}
            </button>
            <a
                v-if="support.attached_file_name"
                :href="`/supports/get/anexo/${support.attached_file_name}`"
                class="btn btn-dark mx-1"
                ><i class="fas fa-cloud-download-alt"></i
            ></a>
        </div>
    </div>
</template>
<script>
export default {
    props: ["support_data"],
    data() {
        return {
            support: this.support_data,
            authUser: {},
            show: false,
        };
    },
    computed: {
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
        created() {
            return moment(this.support.created_at).format("DD/MM/YYYY");
        },
        updated() {
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
        execution_by() {
            return this.support.execution_by == 1 ? "Própria" : "Terceirizada";
        },
    },
    methods: {
        editDescription() {
            this.show = !this.show;
            window.events.$emit("editar", this.show);
        },
    },
    created() {
        this.authUser = user;

        window.events.$on("send_status", (support) => {
            this.support = support;
        });

        window.events.$on("send_execution_by", (support) => {
            this.support.execution_by = support.execution_by;
        });

        window.events.$on("send_description", (description) => {
            this.support.description = description;
        });

        window.events.$on("setor_servico", (support) => {
            this.support.setor = support.setor;
            this.support.servico = support.servico;
            this.support.setor_id = support.setor_id;
            this.support.servico_id = support.servico_id;
        });

        window.events.$on("editado", (value) => {
            this.show = value;
        });
    },
};
</script>
