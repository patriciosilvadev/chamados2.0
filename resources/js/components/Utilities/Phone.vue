<template>
    <div class="container-fluid mb-3">
        <div class="row d-flex align-items-end" v-if="edit">
            <div class="col-md-2">
                <div class="form-group bmd-form-group">
                    <label for="type">Tipo</label>
                    <input
                        type="text"
                        name="type"
                        id="type"
                        class="form-control"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="col-md-5">
                <multiselect
                    track-by="name"
                    label="name"
                    :options="countries"
                    placeholder="Selecione o país"
                    selectLabel=""
                    deselectLabel=""
                    selectedLabel="Selecionado"
                    v-model="form.country"
                    @select="setCountry"
                >
                    <template slot="singleLabel" slot-scope="props">
                        <img
                            class="flag"
                            :src="props.option.flag"
                            :alt="props.option.name"
                        />
                        <span v-text="`${props.option.name}`"></span>
                    </template>
                    <template slot="option" slot-scope="props">
                        <img class="flag" :src="props.option.flag" />
                        <span v-text="`${props.option.name}`"></span>
                    </template>
                </multiselect>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <the-mask
                        type="text"
                        name="phone"
                        :mask="
                            form.country.name == 'Brasil'
                                ? ['+## (##) ####-####', '+## (##) #####-####']
                                : ['+####################']
                        "
                        :id="`phone-${phone.id}`"
                        class="form-control"
                        required
                        v-model="form.phone"
                    />
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <span
                    class="text-capitalize"
                    v-text="`${form.name}: ${form.phone}`"
                ></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button
                    type="button"
                    class="btn btn-success"
                    :class="edit ? 'btn-success' : 'btn-warning'"
                    @click.prevent="add"
                >
                    <i class="fas fa-plus" v-if="edit"></i>
                    <i class="far fa-edit" v-else></i>
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    @click.prevent="remove"
                >
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["phone"],
    data() {
        return {
            countries: [],
            form: this.phone,
            edit: true,
        };
    },
    methods: {
        add() {
            if (this.form.phone != "" && this.form.name != "") {
                if (this.edit) {
                    this.form.name = this.form.name.toLowerCase();
                }
                this.edit = !this.edit;
                return;
            }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit("remove-phone", this.phone);
        },
        getCountries() {
            window.axios
                .get("https://restcountries.eu/rest/v2/all")
                .then((result) => {
                    result.data.forEach((country) => {
                        this.countries.push({
                            name: country.translations.br,
                            flag: country.flag,
                            callingCode: country.callingCodes[0],
                        });
                        if (this.phone.name == "") {
                            if (country.translations.br == "Brasil") {
                                this.form.country = {
                                    name: country.translations.br,
                                    flag: country.flag,
                                    callingCode: country.callingCodes[0],
                                };
                                this.form.phone = this.form.country.callingCode;
                            }
                        }
                    });
                })
                .catch((errors) => console.error(errors));
        },
        setCountry(selectedOption, id) {
            this.form.phone = selectedOption.callingCode;
            document.querySelector(`#phone-${this.phone.id}`).focus();
        },
    },
    created() {
        this.getCountries();
        this.edit =
            this.form.phone != "" && this.form.name != "" ? false : true;
    },
};
</script>
<style>
.flag {
    height: 1rem;
    border-radius: 0;
    border: 1px solid #cecece;
    padding: 0.05rem;
}
</style>
