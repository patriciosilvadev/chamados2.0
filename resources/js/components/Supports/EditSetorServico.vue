<template>
    <div class="status" v-if="local_chamado.status == 1 && suporte">
        <div class="row mb-2">
            <div class="col-md-12">
                <h5 class="text-center">Setor/Serviço</h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Setor</label>
                    <select
                        name="setor"
                        id="setor"
                        class="form-control"
                        v-model="form.setor"
                        @change="fetch"
                    >
                        <option
                            :value="setor.id"
                            v-for="setor in setores"
                            :key="setor.id"
                            v-text="setor.nome"
                        ></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Serviço</label>
                    <select
                        name="servico"
                        id="servico"
                        class="form-control"
                        :disabled="!servicos.length ? true : false"
                        v-model="form.servico"
                    >
                        <option
                            :value="servico.id"
                            v-for="servico in servicos"
                            :key="servico.id"
                            v-text="servico.nome"
                        ></option>
                    </select>
                </div>
            </div>
        </div>
        <div
            class="d-flex justify-content-end"
            v-if="
                local_chamado.setor_id != form.setor ||
                    local_chamado.servico_id != form.servico
            "
        >
            <button class="btn btn-primary" @click.prevent="save">
                <div
                    class="spinner-border spinner-border-sm"
                    role="status"
                    v-if="loading"
                >
                    <span class="sr-only">Loading...</span>
                </div>
                <span>Enviar</span>
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: ["chamado", "user", "setores"],
    data() {
        return {
            form: {
                setor: this.chamado.setor_id,
                servico: this.chamado.servico_id,
            },
            local_chamado: this.chamado,
            servicos: [],
            loading: false,
        };
    },
    computed: {
        gestorSuporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                this.user.departamentos.forEach((departamento) => {
                    if (
                        funcao.cod_papel === 2 &&
                        departamento.cod_grupo ===
                            this.local_chamado.departamento_id
                    )
                        boolean = true;
                });
            });
            return boolean;
        },
        suporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                this.user.departamentos.forEach((departamento) => {
                    if (
                        (funcao.cod_papel === 8 &&
                            departamento.cod_grupo ===
                                this.local_chamado.departamento_id) ||
                        this.gestorSuporte
                    )
                        boolean = true;
                });
            });
            return boolean;
        },
    },
    methods: {
        fetch() {
            this.servicos = [];
            axios
                .get(`/api/servico/${this.form.setor}`)
                .then(({ data }) => {
                    this.servicos = data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        save() {
            this.loading = true;
            axios
                .patch(`/chamados/${this.chamado.id}/edit`, this.form)
                .then(({ data }) => {
                    this.loading = !this.loading;
                    this.local_chamado.setor_id = this.form.setor;
                    this.local_chamado.servico_id = this.form.servico;
                    this.local_chamado.setor = data.setor;
                    this.local_chamado.servico = data.servico;
                    window.events.$emit("setor_servico", this.local_chamado);
                })
                .catch((error) => {
                    this.loading = !this.loading;
                    this.errors = error.response.data.errors;
                });
        },
    },
    created() {
        this.fetch();
        window.events.$on("send_status", (chamado) => {
            this.local_chamado.status = chamado.status;
        });
    },
};
</script>
