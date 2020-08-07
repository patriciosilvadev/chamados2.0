<template>
    <div class="container-fluid mb-3">
        <div class="row" v-if="edit">
            <div class="col-md-4">
                <div class="form-group">
                    <label v-text="label_1 ? label_1 : 'Nota'"></label>
                    <input
                        :type="type"
                        :name="`name-${form.id}`"
                        :id="`name-${form.id}`"
                        class="form-control"
                        v-model="form.name"
                    />
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="form-group">
                        <label v-text="label_2 ? label_2 : 'Conteúdo'"></label>
                        <input
                            class="form-control"
                            :name="`content-${form.id}`"
                            :id="`content-${form.id}`"
                            v-model="form.content"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
            <div class="col-md-12">
                <span class="text-capitalize" v-text="`${form.name}:`"></span>
                <span
                    :class="
                        type == 'email' || type == 'url'
                            ? 'text-lowercase'
                            : 'text-uppercase'
                    "
                    v-text="form.content"
                ></span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button
                    type="button"
                    class="btn"
                    :class="`${edit ? 'btn-success' : 'btn-warning'}`"
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
    props: ["data", "label_1", "label_2", "type", "event"],
    data() {
        return {
            form: this.data,
            edit: true,
        };
    },
    methods: {
        add() {
            if (this.form.name != "" && this.form.content != "") {
                if (this.edit) {
                    this.form.name = this.form.name.toLowerCase();
                    this.form.content = this.form.content.toLowerCase();
                }
                this.edit = !this.edit;
                return;
            }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit(this.event, this.form);
        },
    },
    created() {
        this.edit =
            this.form.name != "" && this.form.content != "" ? false : true;
    },
};
</script>
