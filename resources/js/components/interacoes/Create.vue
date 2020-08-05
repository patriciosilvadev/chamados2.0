<template>
    <div class="col-md-12 col-sm-12 interacoes">
        <div class="row d-flex justify-content-end">
            <div class="col-md-12">
                <h5
                    class="text-center"
                    v-text="`Observações #${chamadoLocal.id}`"
                ></h5>
            </div>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-md-12">
                <div class="chat">
                    <div class="row" id="chat">
                        <div
                            class="col-md-12 mb-2"
                            v-for="interacao in chamadoLocal.interacoes"
                        >
                            <div class="tooltip bs-tooltip-right">
                                <div
                                    class="tooltip-inner"
                                    :class="{
                                        'interacao-usuario':
                                            interacao.user_id ==
                                            chamadoLocal.user_id,
                                    }"
                                    v-text="`${interacao.descricao}`"
                                ></div>
                                <span
                                    class="text-muted usuario"
                                    v-text="interacao.usuario.nome"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="row mt-2 d-flex justify-content-end"
            v-if="status && (suporte || chamadoLocal.user_id == user.id)"
        >
            <div class="col-md-12">
                <textarea
                    name="descricao"
                    id="descricao"
                    cols="30"
                    rows="3"
                    placeholder="Sua mensagem..."
                    class="form-control"
                    v-model="descricao"
                    @keyup.enter.exact.prevent="send"
                ></textarea>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('descricao')"
                    v-text="errors.descricao[0]"
                ></small>
            </div>
        </div>
        <div
            class="row mt-2 d-flex justify-content-end"
            v-if="status && (suporte || chamadoLocal.user_id == user.id)"
        >
            <div class="col-md-12 d-flex justify-content-end">
                <button
                    class="btn btn-primary"
                    :class="{ disabled: loading }"
                    @click="send()"
                >
                    <div
                        class="spinner-border spinner-border-sm"
                        role="status"
                        v-if="loading"
                    >
                        <span class="sr-only">Loading...</span>
                    </div>
                    Enviar
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
            chamadoLocal: this.chamado,
            descricao: "",
            loading: false,
            errors: {},
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
                            this.chamadoLocal.departamento_id
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
                                this.chamadoLocal.departamento_id) ||
                        this.gestorSuporte
                    )
                        boolean = true;
                });
            });
            return boolean;
        },
        status() {
            return this.chamadoLocal.status != 0 &&
                this.chamadoLocal.status != 3
                ? true
                : false;
        },
    },
    methods: {
        send: _.throttle(
            function() {
                this.loading = !this.loading;
                const formData = new FormData();
                formData.set("descricao", this.descricao);
                axios
                    .post(`/chamados/${this.chamado.id}/interacoes`, formData)
                    .then((result) => {
                        this.errors = {};
                        this.loading = !this.loading;
                        this.descricao = "";
                        this.chamado.interacoes.push(result.data);
                    })
                    .catch((error) => {
                        this.loading = !this.loading;
                        this.descricao = "";
                        this.errors = error.response.data.errors;
                    });
            },
            300,
            { trailing: false }
        ),
        scroll() {
            document.querySelector("#chat").scrollTop = document.querySelector(
                "#chat"
            ).scrollHeight;
        },
    },
    created() {
        window.Echo.private(`message.${this.chamado.id}`).listen(
            "InteracaoCreate",
            (event) => {
                this.chamadoLocal.interacoes.push(event.interacao);
            }
        );

        window.events.$on("send_status", (chamado) => {
            this.chamadoLocal.status = chamado.status;
        });
    },
    updated() {
        this.scroll();
    },
    mounted() {
        this.scroll();
    },
};
</script>
<style scoped>
.interacoes {
    padding: 0.5rem 0.5rem;
    border-radius: 5px;
    border: 1px solid #e9ecef;
}

.chat {
    background-color: #e9ecef;
    min-height: 40vh;
    max-height: 40vh;
    border-radius: 5px;
    overflow: auto;
    padding: 1rem 1rem;
}

.tooltip {
    opacity: 1;
    position: relative;
}

.tooltip-inner {
    text-align: unset;
    max-width: 100%;
}

.interacao-usuario {
    background-color: #199;
}

.usuario {
    font-size: 0.75rem;
    display: flex;
    justify-content: flex-end;
}
</style>
