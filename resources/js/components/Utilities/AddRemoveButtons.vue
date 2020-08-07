<template>
    <div class="container-fluid">
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
    props: ["data", "editFromComponent", "event"],
    data() {
        return {
            form: this.data,
            edit: this.editFromComponent,
        };
    },
    methods: {
        add() {
            // if (this.form.name != "") {
            //     if (this.edit) {
            // this.form.name = this.form.name.toLowerCase();
            //     }
            //     this.edit = !this.edit;
            //     return;
            // }
            window.flash("Preencha os campos para adicionar.", "danger");
        },
        remove() {
            window.events.$emit(this.event, this.form);
        },
    },
};
</script>
