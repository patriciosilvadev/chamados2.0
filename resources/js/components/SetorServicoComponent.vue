<template>
    <div class="row mt-1">
        <div class="col-md-4">
            <div class="form-group">
                <label for="area-suporte">Área para Suporte</label>
                <select
                    name="area-suporte"
                    id="area-suporte"
                    class="form-control"
                    v-model="values.departamentoSelected"
                    @change="
                        getSetores();
                        sendValues();
                    "
                >
                    <option
                        :value="areaSuporte.cod_grupo"
                        :key="areaSuporte.cod_grupo"
                        v-for="areaSuporte in localAreasSuporte"
                        v-text="areaSuporte.nome"
                    ></option>
                </select>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('departamento')"
                    v-text="errors.departamento[0]"
                ></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label
                    for="setor"
                    v-text="values.departamentoSelected == 2 ? 'Tipo' : 'Setor'"
                ></label>
                <select
                    name="setor"
                    id="setor"
                    class="form-control"
                    @change="
                        fetch();
                        sendValues();
                    "
                    v-model="values.setorSelected"
                >
                    <option value="">Selecione</option>
                    <option
                        :value="setor.id"
                        v-for="setor in setores"
                        v-text="setor.nome"
                    ></option>
                </select>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('setor')"
                    v-text="errors.setor[0]"
                ></small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="servico">Serviço</label>
                <select
                    name="servico"
                    id="servico"
                    class="form-control"
                    :disabled="!servicos.length ? true : false"
                    v-model="values.servicoSelected"
                    @change="sendValues"
                >
                    <option value="">Selecione</option>
                    <option
                        :value="servico.id"
                        v-for="servico in servicos"
                        v-text="servico.nome"
                    ></option>
                </select>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('servico')"
                    v-text="errors.servico[0]"
                ></small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["errors", "areas_suporte"],
    data() {
        return {
            localAreasSuporte: this.areas_suporte,
            values: {
                departamentoSelected: this.areas_suporte[0].cod_grupo,
                setorSelected: "",
                servicoSelected: "",
            },
            setores: [],
            servicos: [],
        };
    },
    methods: {
        fetch() {
            this.servicos = [];
            this.values.servicoSelected = 0;
            axios
                .get(`/api/servico/${this.values.setorSelected}`)
                .then(({ data }) => {
                    this.servicos = data;
                })
                .catch((error) => console.error(error));
        },
        getSetores() {
            this.setores = [];
            this.servicos = [];
            axios
                .get("/api/setor/" + this.values.departamentoSelected)
                .then(({ data }) => {
                    this.setores = data;
                });
        },
        sendValues() {
            this.$emit("values", this.values);
        },
    },
    created() {
        this.getSetores();
        window.events.$on("recorrencia", (recorrencia) => {
            this.localAreasSuporte = [];
            this.values.departamentoSelected = null;
            this.values.setorSelected = null;
            this.values.servicoSelected = null;
            this.sendValues();

            if (recorrencia.recorrencia) {
                this.areas_suporte.forEach((localDepartamento, index) => {
                    recorrencia.departamentos.forEach((departamento) => {
                        if (
                            localDepartamento.cod_grupo ==
                            departamento.cod_grupo
                        ) {
                            this.localAreasSuporte.push(localDepartamento);
                        }
                    });
                });
                this.values.departamentoSelected = this.localAreasSuporte[0].cod_grupo;
                this.getSetores();
                this.sendValues();
            } else {
                this.localAreasSuporte = this.areas_suporte;
                this.values.departamentoSelected = this.localAreasSuporte[0].cod_grupo;
                this.getSetores();
                this.sendValues();
            }
        });
    },
};
</script>
