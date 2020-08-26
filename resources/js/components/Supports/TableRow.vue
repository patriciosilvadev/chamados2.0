<template>
    <tr :class="{ 'table-danger': delayed }">
        <td><b v-text="`# ${support.id}`"></b></td>
        <td v-text="support.user.name"></td>
        <td v-html="status"></td>
        <td v-text="support.service.name"></td>
        <td>
            <div
                class="col-md-12 d-flex justify-content-center align-itens-center flex-wrap"
            >
                <button
                    class="btn btn-warning mx-1"
                    @click.prevent="send"
                    data-toggle="modal"
                    data-target="#supportModal"
                >
                    <i class="fas fa-glasses"></i>
                </button>
                <a
                    :href="`/supports/${support.id}`"
                    class="btn btn-success mx-1"
                    ><i class="fas fa-binoculars"></i
                ></a>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["support"],
    data() {
        return {
            authUser: {},
        };
    },
    computed: {
        delayed() {
            if (this.support.expected_date && this.support.status == 2) {
                return moment(this.support.expected_date).format("YYYY-MM-DD") <
                    moment(new Date()).format("YYYY-MM-DD")
                    ? true
                    : false;
            }
        },
        status() {
            if (this.support.status === 1)
                return '<span class="badge badge-pill badge-warning">Aberto</span>';
            else if (this.support.status === 2)
                return '<span class="badge badge-pill badge-primary">Andamento</span>';
            else if (this.support.status === 0)
                return '<span class="badge badge-pill badge-success">Concluído</span>';
            else if (this.support.status === 3)
                return '<span class="badge badge-pill badge-danger">Recusado</span>';
        },
    },
    methods: {
        send() {
            window.events.$emit("sendsupport", this.support);
        },
    },
    created() {
        this.authUser = user;
    },
};
</script>
