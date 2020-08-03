<template>
    <div class="row mt-1">
        <div class="col-md-12 col-xl-6">
            <div class="form-group">
                <label for="local">Local</label>
                <select
                    name="local"
                    id="local"
                    class="form-control"
                    @change="
                        fetch();
                        sendValues();
                    "
                    v-model="values.localSelected"
                >
                    <option value="">Selecione</option>
                    <option
                        :value="local.id"
                        v-for="local in locais"
                        v-text="local.nome"
                    ></option>
                </select>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('local')"
                    v-text="errors.local[0]"
                ></small>
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="form-group">
                <label for="ambiente">Ambiente</label>
                <select
                    name="ambiente"
                    id="ambiente"
                    class="form-control"
                    :disabled="!ambientes.length ? true : false"
                    v-model="values.ambienteSelected"
                    @change="sendValues"
                >
                    <option value="">Selecione</option>
                    <option
                        :value="ambiente.id"
                        v-for="ambiente in ambientes"
                        v-text="ambiente.nome"
                    ></option>
                </select>
                <small
                    class="text-danger"
                    v-if="errors.hasOwnProperty('ambiente')"
                    v-text="errors.ambiente[0]"
                ></small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["locais", "errors"],
    data() {
        return {
            values: {
                localSelected: "",
                ambienteSelected: ""
            },
            ambientes: []
        };
    },
    methods: {
        fetch() {
            this.ambientes = [];
            this.ambienteSelected = 0;
            axios
                .get(`/api/ambiente/${this.values.localSelected}`)
                .then(({ data }) => {
                    this.ambientes = data;
                })
                .catch(error => console.error(error));
        },
        sendValues() {
            this.$emit("values", this.values);
        }
    }
};
</script>
