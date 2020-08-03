<template>
    <div
        class="status mb-3"
        v-if="
            local_chamado.usuario_id == user.cod_usuario &&
                local_chamado.status == 1
        "
        v-show="show"
    >
        <div class="row mb-2">
            <div class="col-md-12">
                <h5 class="text-center">Descrição</h5>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea
                    name="descricao"
                    id="descricao"
                    cols="30"
                    rows="3"
                    class="form-control"
                    v-model="form.descricao"
                ></textarea>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('descricao')"
                    v-text="errors.descricao[0]"
                ></small>
            </div>
        </div>
        <div
            class="col-md-12 d-flex justify-content-end"
            v-if="local_chamado.status != form.status"
        >
            <button
                class="btn btn-primary"
                :class="{ disabled: loading }"
                @click.prevent="send()"
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
</template>
<script>
export default {
    props: ["chamado", "user"],
    data() {
        return {
            local_chamado: this.chamado,
            form: {
                descricao: this.chamado.descricao,
            },
            errors: {},
            loading: false,
            show: false,
        };
    },
    methods: {
        send: _.throttle(
            function() {
                this.loading = !this.loading;
                axios
                    .patch(`/chamados/${this.chamado.id}/edit`, this.form)
                    .then(({ data }) => {
                        this.loading = !this.loading;
                        this.local_chamado.descricao = this.form.descricao;
                        this.show = false;
                        window.events.$emit(
                            "send_descricao",
                            this.local_chamado
                        );
                        window.events.$emit("editado", this.show);
                    })
                    .catch((error) => {
                        this.loading = !this.loading;
                        this.form.descricao =
                            this.form.descricao == ""
                                ? this.chamado.descricao
                                : this.from.descricao;
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
        window.events.$on("editar", (value) => {
            this.show = value;
        });
    },
};
</script>
