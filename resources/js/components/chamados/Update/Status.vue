<template>
    <div class="status" v-if="suporte">
        <div class="row mb-2">
            <div class="col-md-12">
                <h5 class="text-center">Status</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control"
                        :disabled="
                            local_chamado.status == 0 ||
                            local_chamado.status == 3
                                ? true
                                : false
                        "
                        v-model="form.status"
                    >
                        <option
                            value="0"
                            v-if="
                                local_chamado.status == 0 ||
                                    local_chamado.status == 2 ||
                                    local_chamado.status == 1
                            "
                            >Concluído</option
                        >
                        <option value="1" v-if="local_chamado.status == 1"
                            >Aberto</option
                        >
                        <option
                            value="2"
                            v-if="
                                local_chamado.status == 2 ||
                                    local_chamado.status == 1
                            "
                            >Andamento</option
                        >
                        <option
                            value="3"
                            v-if="
                                local_chamado.status == 3 ||
                                    local_chamado.status == 1 ||
                                    local_chamado.status == 2
                            "
                            >Recusado</option
                        >
                    </select>
                </div>
            </div>
            <!-- Recusado -->
            <div class="col-md-12" v-if="form.status == 3">
                <div class="form-group" v-if="status_chamado">
                    <label for="justificativa">Justificativa</label>
                    <textarea
                        name="justificativa"
                        id="justificativa"
                        cols="30"
                        rows="3"
                        class="form-control"
                        v-model="form.justificativa"
                    ></textarea>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('justificativa')"
                        v-text="errors.justificativa[0]"
                    ></small>
                </div>
                <div class="form-group" v-else>
                    <label for="justificativa">Justificativa:</label>
                    <span
                        v-text="local_chamado.justificativa.justificativa"
                    ></span>
                </div>
            </div>
            <!-- Recusado -->

            <!-- Andamaneto -->
            <div
                class="col-md-12"
                v-if="form.status == 2 && local_chamado.status != 2"
            >
                <div class="form-group">
                    <label for="hora_completar">Horas previstas</label>
                    <div class="input-group">
                        <input
                            type="number"
                            class="form-control"
                            :class="{
                                disabled:
                                    this.local_chamado.horas_previstas != null,
                            }"
                            :disabled="
                                this.local_chamado.horas_previstas != null
                                    ? true
                                    : false
                            "
                            name="hora_completar"
                            id="hora_completar"
                            min="01"
                            step="1"
                            v-model="form.horas_previstas"
                            aria-label="Horas para realizar o serviço"
                            aria-describedby="horas"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text" id="horas"
                                >hora(s)</span
                            >
                        </div>
                    </div>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('horas_previstas')"
                        v-text="errors.horas_previstas[0]"
                    ></small>
                </div>
            </div>
            <div
                class="col-md-12"
                v-if="form.status == 2 && local_chamado.status != 2"
            >
                <div class="form-group">
                    <label for="data_prevista">Data prevista</label><br />
                    <date-picker
                        v-model="form.data_prevista"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :disabled="
                            this.local_chamado.data_prevista != null
                                ? true
                                : false
                        "
                        width="100%"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('data_prevista')"
                        v-text="errors.data_prevista[0]"
                    ></small>
                </div>
            </div>
            <div
                class="col-md-12 d-flex justify-content-end"
                v-if="local_chamado.status == 2 || local_chamado.status == 0"
            >
                <a
                    :href="`/chamados/${local_chamado.id}/print-os`"
                    target="_blank"
                    class="btn btn-dark"
                    ><i class="fas fa-download"></i
                ></a>
            </div>
            <!-- Andamento -->

            <!-- Concluído -->
            <div
                class="col-md-12"
                v-if="form.status == 0 && local_chamado.status != 0"
            >
                <div class="form-group">
                    <label for="hora_real">Horas real</label>
                    <div class="input-group">
                        <input
                            type="number"
                            class="form-control"
                            :class="{
                                disabled: this.local_chamado.horas_real != null,
                            }"
                            :disabled="
                                this.local_chamado.horas_real != null ||
                                this.local_chamado.horas_real == 0
                                    ? true
                                    : false
                            "
                            name="hora_completar"
                            id="hora_completar"
                            min="01"
                            step="1"
                            v-model="form.horas_real"
                            aria-label="Horas para realizar o serviço"
                            aria-describedby="horas"
                        />
                        <div class="input-group-append">
                            <span class="input-group-text" id="horas"
                                >hora(s)</span
                            >
                        </div>
                    </div>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('horas_real')"
                        v-text="errors.horas_real[0]"
                    ></small>
                </div>
            </div>
            <div
                class="col-md-12"
                v-if="form.status == 0 && local_chamado.status != 0"
            >
                <div class="form-group">
                    <label for="data_real">Data real</label><br />
                    <date-picker
                        v-model="form.data_real"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :disabled="
                            this.local_chamado.data_real != null ? true : false
                        "
                        width="100%"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('data_real')"
                        v-text="errors.data_real[0]"
                    ></small>
                </div>
            </div>
            <!-- Concluído -->

            <div class="col-md-12" v-if="form.status == 2 || form.status == 0">
                <div class="form-group">
                    <label for="hora_completar">Atendentes</label>
                    <div class="input-group">
                        <multiselect
                            v-model="form.atendentes"
                            :options="atendentes[0]"
                            :multiple="true"
                            track-by="nome"
                            :custom-label="customLabel"
                            :disabled="
                                this.local_chamado.atendida_por != null
                                    ? true
                                    : false
                            "
                            placeholder="Selecione o(s) colaboradore(s)"
                        ></multiselect>
                        <small
                            class="text-danger"
                            v-if="errors.hasOwnProperty('atendentes')"
                            v-text="errors.atendentes[0]"
                        ></small>
                    </div>
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
    </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import DatePicker from "vue2-datepicker";
export default {
    props: ["chamado", "user", "atendentes"],
    components: { Multiselect, DatePicker },
    data() {
        return {
            local_chamado: this.chamado,
            form: {
                status: this.chamado.status,
                justificativa:
                    this.chamado.justificativa != null
                        ? this.chamado.justificativa
                        : "",
                horas_previstas:
                    this.chamado.horas_previstas != null
                        ? this.chamado.horas_previstas
                        : 0,
                horas_real:
                    this.chamado.horas_real != null
                        ? this.chamado.horas_real
                        : 0,
                data_prevista:
                    this.chamado.data_prevista != null
                        ? new Date(this.chamado.data_prevista)
                        : null,
                data_real:
                    this.chamado.data_real != null
                        ? new Date(this.chamado.data_real)
                        : null,
                atendentes:
                    this.chamado.atendida_por != null
                        ? this.chamado.atendida_por
                        : null,
            },
            errors: {},
            loading: false,
        };
    },
    computed: {
        status_chamado() {
            return this.local_chamado.status != 3 ? true : false;
        },
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
                this.form.horas_previstas = Number(this.form.horas_previstas);
                this.form.horas_real = Number(this.form.horas_real);
                this.form.data_prevista =
                    this.form.data_prevista != null
                        ? moment(this.form.data_prevista).format("YYYY-MM-DD")
                        : null;
                this.form.data_real =
                    this.form.data_real != null
                        ? moment(this.form.data_real).format("YYYY-MM-DD")
                        : null;
                axios
                    .patch(`/chamados/${this.chamado.id}/edit`, this.form)
                    .then(({ data }) => {
                        this.loading = !this.loading;
                        this.local_chamado.status = Number(this.form.status);
                        this.local_chamado.justificativa = data;
                        this.local_chamado.horas_previstas = Number(
                            this.form.horas_previstas
                        );
                        this.local_chamado.horas_real =
                            this.form.horas_real == 0
                                ? null
                                : Number(this.form.horas_real);
                        this.local_chamado.data_prevista = data.data_prevista;
                        this.local_chamado.data_real = data.data_real;
                        this.local_chamado.atendida_por = data.atendida_por;
                        this.errors = {};
                        window.events.$emit("send_status", this.local_chamado);
                    })
                    .catch((error) => {
                        this.loading = !this.loading;
                        this.errors = error.response.data.errors;
                    });
            },
            1000,
            { trailing: false }
        ),
        customLabel(atendente) {
            return `${atendente.nome}`;
        },
    },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.status {
    padding: 0.5rem 0.5rem;
    border-radius: 5px;
    border: 1px solid #e9ecef;
}
</style>
