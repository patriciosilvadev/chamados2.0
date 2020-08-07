<template>
    <!-- <form enctype="multipart/form-data" @submit.prevent="save">
        <div class="row">
            <div class="col-md-12">
                <h2>Serviços</h2>
            </div>
        </div>
        <div
            class="row d-flex align-items-end"
            v-if="suporte || gerenteSuporte"
        >
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                class="form-check-input"
                                name="recorrente"
                                id="recorrente"
                                type="checkbox"
                                v-model="recorrencia"
                                @change="setAreaSuporte"
                            />
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                            <label for="recorrente">Recorrente</label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-if="recorrencia">
                <div class="form-group">
                    <label for="data_prevista">Data prevista</label><br />
                    <date-picker
                        v-model="form.data_prevista"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :not-before="new Date()"
                        width="100%"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('data_prevista')"
                        v-text="errors.data_prevista[0]"
                    ></small>
                </div>
            </div>
            <div class="col-md-4" v-if="recorrencia">
                <div class="form-group">
                    <label for="tipo_recorrencia">Tipo de recorrência</label>
                    <select
                        name="tipo_recorrencia"
                        id="tipo_recorrencia"
                        class="form-control"
                        v-model="form.tipo_recorrencia"
                    >
                        <option value="">Selecione</option>
                        <option value="daily">Diário</option>
                        <option value="weekly">Semanal</option>
                        <option value="biweekly">Quinzenal</option>
                        <option value="monthly">Mensal</option>
                        <option value="bimonthly">Bimestral</option>
                        <option value="quarterly">Trimestral</option>
                        <option value="semiannual">Semestral</option>
                        <option value="yearly">Anual</option>
                        <option value="biennial">Bienal</option>
                    </select>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('tipo_recorrencia')"
                        v-text="errors.tipo_recorrencia[0]"
                    ></small>
                </div>
            </div>
        </div>
        <setor-servico-component
            :errors="errors"
            :areas_suporte="areas_suporte"
            @values="setFormVariables($event, 'setor')"
        ></setor-servico-component>
        <div class="row mt-3" v-if="form.departamento != 2">
            <div class="col-md-12">
                <h2>Locais</h2>
            </div>
        </div>
        <local-ambiente-component
            :locais="locais"
            :errors="errors"
            @values="setFormVariables($event, 'local')"
            v-if="form.departamento != 2"
        ></local-ambiente-component>
        <div class="row mt-3">
            <div class="col-md-12">
                <h2>Detalhes</h2>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_desejada">Data desejada</label><br />
                    <date-picker
                        v-model="form.data_desejada"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :not-before="new Date()"
                        width="100%"
                    ></date-picker>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="anexo">Anexo</label>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            name="anexo"
                            id="anexo"
                            @change="getFile"
                        />
                        <label
                            class="custom-file-label form-control"
                            id="anexo_nome"
                            for="anexo"
                            >Escolha um arquivo</label
                        >
                    </div>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('anexo')"
                        v-text="errors.anexo[0]"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Descrição do Problema</label>
                    <textarea
                        name="description"
                        id="description"
                        cols="30"
                        rows="7"
                        class="form-control"
                        v-model="form.description"
                    ></textarea>
                    <small
                        class="text-danger"
                        v-if="errors.hasOwnProperty('description')"
                        v-text="errors.description[0]"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row mt-2 d-flex justify-content-end">
            <div class="col-md-12">
                <button
                    class="btn btn-primary"
                    type="submit"
                    :class="{ disabled: loading }"
                >
                    <div
                        class="spinner-border spinner-border-sm"
                        role="status"
                        v-if="loading"
                    >
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span>Salvar</span>
                </button>
            </div>
        </div>
    </form> -->
</template>
<script>
// import DatePicker from "vue2-datepicker";
export default {
    // props: ["locais", "areas_suporte", "user"],
    // data() {
    //     return {
    //         form: {
    //             description: "",
    //             local: "",
    //             ambiente: "",
    //             setor: "",
    //             servico: "",
    //             departamento: this.areas_suporte[0].cod_grupo,
    //             anexo: null,
    //             data_desejada: null,
    //             tipo_recorrencia: "",
    //             data_prevista: null,
    //         },
    //         recorrencia: false,
    //         loading: false,
    //         errors: {},
    //     };
    // },
    // computed: {
    //     diretoria() {
    //         let boolean = false;
    //         this.user.funcoes.forEach((funcao) => {
    //             if (funcao.cod_papel === 3) boolean = true;
    //         });
    //         return boolean;
    //     },
    //     gestorSuporte() {
    //         let boolean = false;
    //         this.user.funcoes.forEach((funcao) => {
    //             this.user.departamentos.forEach((departamento) => {
    //                 if (
    //                     funcao.cod_papel === 2 &&
    //                     (departamento.cod_grupo === 2 ||
    //                         departamento.cod_grupo === 13)
    //                 )
    //                     boolean = true;
    //             });
    //         });
    //         return boolean;
    //     },
    //     gestor() {
    //         let boolean = false;
    //         this.user.funcoes.forEach((funcao) => {
    //             if (funcao.cod_papel === 2 && !this.gestorSuporte)
    //                 boolean = true;
    //         });
    //         return boolean;
    //     },
    //     suporte() {
    //         console.log(user);
    //         let boolean = false;
    //         this.user.funcoes.forEach((funcao) => {
    //             if (funcao.cod_papel === 8 || this.gestorSuporte)
    //                 boolean = true;
    //         });
    //         return boolean;
    //     },
    // },
    // methods: {
    //     getFile(event) {
    //         this.form.anexo = event.target.files[0];
    //         document.querySelector("#anexo_nome").innerText =
    //             event.target.files[0].name;
    //     },
    //     setFormVariables($event, place) {
    //         if (place === "local") {
    //             this.form.local = $event.localSelected;
    //             this.form.ambiente = $event.ambienteSelected;
    //         } else if (place === "setor") {
    //             this.form.departamento = $event.departamentoSelected;
    //             this.form.setor = $event.setorSelected;
    //             this.form.servico = $event.servicoSelected;
    //         }
    //     },
    //     save: _.throttle(
    //         function() {
    //             this.loading = !this.loading;
    //             const formData = this.formatFormData();
    //             axios
    //                 .post("/chamados/create", formData)
    //                 .then((result) => {
    //                     this.loading = !this.loading;
    //                     window.location = "/";
    //                 })
    //                 .catch((error) => {
    //                     this.loading = !this.loading;
    //                     this.errors = error.response.data.errors;
    //                 });
    //         },
    //         1000,
    //         { trailing: false }
    //     ),
    //     setAreaSuporte() {
    //         window.events.$emit("recorrencia", {
    //             recorrencia: this.recorrencia,
    //             departamentos: this.user.departamentos,
    //         });
    //     },
    //     formatFormData() {
    //         const formData = new FormData();
    //         this.form.anexo != null
    //             ? formData.append("anexo", this.form.anexo)
    //             : "";
    //         formData.set("description", this.form.description);
    //         formData.set("local", this.form.local);
    //         formData.set("ambiente", this.form.ambiente);
    //         formData.set("setor", this.form.setor);
    //         formData.set("servico", this.form.servico);
    //         formData.set("departamento", this.form.departamento);
    //         formData.set(
    //             "data_desejada",
    //             this.form.data_desejada != null
    //                 ? moment(this.form.data_desejada).format("YYYY-MM-DD")
    //                 : ""
    //         );
    //         if (this.recorrencia) {
    //             formData.set("recorrencia", true);
    //             formData.set("tipo_recorrencia", this.form.tipo_recorrencia);
    //             formData.set(
    //                 "data_prevista",
    //                 this.form.data_prevista != null
    //                     ? moment(this.form.data_prevista).format("YYYY-MM-DD")
    //                     : ""
    //             );
    //         }
    //         return formData;
    //     },
    // },
    created() {
        console.log(user);
    },
};
</script>
<style>
.btn-primary {
    min-width: 75px;
}
</style>
