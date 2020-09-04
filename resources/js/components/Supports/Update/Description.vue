<template>
    <form
        class="status mb-3"
        v-if="support.user_id == authUser.id && support.status == 1"
        v-show="show"
        enctype="multipart/form-data"
        @submit.prevent="send"
        @keydown="form.errors.clear($event.target.name)"
    >
        <div class="row mb-2">
            <div class="col-md-12">
                <h5 class="text-center">Descrição</h5>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea
                    name="description"
                    id="description"
                    cols="30"
                    rows="3"
                    class="form-control"
                    v-model="form.description"
                ></textarea>
                <small
                    class="text-danger"
                    v-text="form.errors.get('description')"
                    v-if="form.errors.has('description')"
                ></small>
            </div>
        </div>
        <submit-button />
    </form>
</template>
<script>
import Form from "../../../form-validation/Form";

export default {
    props: ["support_data", "user"],
    data() {
        return {
            support: this.support_data,
            authUser: {},
            form: new Form({
                description: this.support_data.description,
            }),
            show: false,
        };
    },
    methods: {
        send: _.throttle(
            function() {
                window.events.$emit("loading", true);
                this.form
                    .patch(`/supports/${this.support.id}`)
                    .then(({ data }) => {
                        window.events.$emit("loading", false);
                        this.support.description = this.form.description;
                        this.show = false;
                        window.events.$emit(
                            "send_description",
                            this.form.description
                        );
                        window.events.$emit("editado", this.show);
                    })
                    .catch((error) => {
                        window.events.$emit("loading", false);
                        this.form.description =
                            this.form.description == ""
                                ? this.support_data.description
                                : this.from.description;
                        this.errors = error.response.data.errors;
                    });
            },
            1000,
            { trailing: false }
        ),
    },
    created() {
        this.authUser = user;
        window.events.$on("send_status", (support) => {
            this.support.status = support.status;
        });
        window.events.$on("editar", (value) => {
            this.show = value;
        });
    },
};
</script>
