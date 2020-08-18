<template>
    <div
        class="status"
        v-if="local_chamado.status != 0 && local_chamado.status != 3 && suporte"
    >
        <div class="row mb-2">
            <div class="col-md-12">
                <h5 class="text-center">Mão de Obra</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                class="form-check-input"
                                name="propria"
                                id="propria"
                                :value="1"
                                type="radio"
                                v-model="form.mao_de_obra"
                            />
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                            <label for="propria">
                                Própria
                            </label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                class="form-check-input"
                                name="terceirizada"
                                id="terceirizada"
                                :value="0"
                                type="radio"
                                v-model="form.mao_de_obra"
                            />
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                            <label for="terceirizada">
                                Terceirizada
                            </label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end align-items-end">
                <button
                    class="btn btn-primary"
                    :class="{ disabled: loading }"
                    @click.prevent="send()"
                    v-if="local_chamado.mao_de_obra != form.mao_de_obra"
                >
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
    </div>
</template>
<script>
export default {
    props: ["chamado", "user"],
    data() {
        return {
            loading: false,
            local_chamado: this.chamado,
            form: {
                mao_de_obra: this.chamado.mao_de_obra,
            },
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
        send: _.throttle(
            function() {
                this.loading = !this.loading;
                axios
                    .patch(`/chamados/${this.chamado.id}/edit`, this.form)
                    .then(({ data }) => {
                        this.loading = !this.loading;
                        this.local_chamado.mao_de_obra = this.form.mao_de_obra;
                        window.events.$emit(
                            "send_mao_de_obra",
                            this.local_chamado
                        );
                    })
                    .catch((error) => {
                        this.loading = !this.loading;
                        this.errors = error.response.data.errors;
                    });
            },
            1000,
            { trailing: false }
        ),
    },
    created() {
        window.events.$on("send_status", (chamado) => {
            this.local_chamado.status = chamado.status;
        });
    },
};
</script>
