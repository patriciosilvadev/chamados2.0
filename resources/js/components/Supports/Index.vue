<template>
    <div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-responsive-xl mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Solicitante</th>
                            <th scope="col">Status</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Local</th>
                            <th scope="col">Serviço</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <table-row-component
                            v-for="support in supports"
                            :support="support"
                            :key="support.id"
                        ></table-row-component>
                    </tbody>
                </table>
                <paginator
                    :paginate="paginate"
                    @page="fetch($event)"
                    v-show="paginate.last_page > 1"
                ></paginator>
            </div>
        </div>
    </div>
</template>
<script>
import Paginator from "../Paginator";
export default {
    props: ["users", "departments"],
    components: { Paginator, DatePicker },
    data() {
        return {
            supports: [],
            paginate: {},
            loading: false,
            timeout: null,
        };
    },
    methods: {
        fetch(url = null) {
            axios
                .get(
                    url !== null
                        ? url
                        : `/supports?${JSON.stringify(this.filter)}`
                )
                .then(({ data }) => {
                    this.supports = [];
                    this.supports = data.data;
                    delete data.data;
                    this.paginate = data;
                })
                .catch((error) => console.error(error));
        },
    },
    created() {
        this.fetch();
    },
};
</script>
<style>
img {
    height: 1.5rem;
    margin-right: 0.25rem;
}
</style>
