<template>
    <div class="col-md-12 mb-3 border">
        <div class="row d-flex align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label v-text="label_1 ? label_1 : 'Nota'"></label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="form.specification"
                        v-if="edit"
                    />
                    <span
                        class="text-capitalize"
                        v-else
                        v-text="form.specification"
                    ></span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="form-group">
                        <label v-text="label_2 ? label_2 : 'Conteúdo'"></label>
                        <textarea
                            class="form-control"
                            rows="3"
                            v-model="form.description"
                            v-if="edit"
                        ></textarea>
                        <span
                            class="text-uppercase"
                            v-else
                            v-text="form.description"
                        ></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button
                    class="btn"
                    :class="`${edit ? 'btn-dark' : 'btn-warning'}`"
                    @click.prevent="add"
                    v-text="`${edit ? 'Adicionar' : 'Editar'}`"
                >
                    Adicionar
                </button>
                <button class="btn btn-danger" @click.prevent="remove">
                    Remover
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["spec", "label_1", "content_1", "label_2", "content_2"],
    data() {
        return {
            form: {
                id: "",
                specification: "",
                description: "",
            },
            edit: true,
        };
    },
    methods: {
        add() {
            if (this.form.specification != "" && this.form.description != "") {
                if (this.edit) {
                    this.form.specification = this.form.specification.toLowerCase();
                    this.form.description = this.form.description.toLowerCase();
                    window.events.$emit("add_spec", this.form);
                }

                this.edit = !this.edit;
                return;
            }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit("remove_spec", this.form);
        },
    },
    created() {
        this.form = {
            id: this.spec.id,
            specification: this.spec.specification,
            description: this.spec.description,
        };

        this.edit =
            this.form.specification != "" && this.form.description != ""
                ? false
                : true;
    },
};
</script>
