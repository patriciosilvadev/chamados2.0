<template>
    <div class="row">
        <div class="col-md-12">
            <filter-component />
        </div>
        <div class="col-md-12 mt-3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Solicitante</th>
                            <th scope="col">Status</th>
                            <th scope="col">Serviço</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <table-row
                            v-for="support in supports"
                            :support="support"
                            :key="support.id"
                        ></table-row>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <paginator v-if="paginate.last_page > 1" :paginate="paginate" />
        </div>
    </div>
</template>
<script>
import Paginator from "../Utilities/Paginator";
import TableRow from "./TableRow";
import FilterComponent from "./Filters";
export default {
    props: ["users", "departments"],
    components: { TableRow, Paginator, FilterComponent },
    data() {
        return {
            supports: [],
            paginate: {},
            filters: {
                status: "",
                owner: 1,
                paginate: 10,
                search: "",
                date: [null, null],
                user: "",
                area: "",
            },
            authUser: {},
        };
    },
    methods: {
        fetch(url = null) {
            axios
                .get(
                    url !== null
                        ? url
                        : `/supports?paginate=${this.filters.paginate}&search=${
                              this.filters.search
                          }&status=${this.filters.status}&start_date=${
                              this.filters.date[0]
                                  ? moment(this.filters.date[0]).format(
                                        "YYYY-MM-DD"
                                    )
                                  : ""
                          }&end_date=${
                              this.filters.date[1]
                                  ? moment(this.filters.date[1]).format(
                                        "YYYY-MM-DD"
                                    )
                                  : ""
                          }&owner=${this.filters.owner}&user${
                              this.authUser.role != "regular"
                                  ? this.filters.user
                                  : this.authUser.id
                          }&area=${this.filters.area}
                          &search=${this.filters.search}`
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
        this.authUser = user;
        this.fetch();
        window.events.$on("search", (filters) => {
            this.filters = filters;
            this.fetch();
        });

        window.events.$on("page", (url) => {
            this.fetch(
                `${url}?paginate=${this.filters.paginate}&search=${
                    this.filters.search
                }&status=${this.filters.status}&start_date=${
                    this.filters.date[0]
                        ? moment(this.filters.date[0]).format("YYYY-MM-DD")
                        : ""
                }&end_date=${
                    this.filters.date[1]
                        ? moment(this.filters.date[1]).format("YYYY-MM-DD")
                        : ""
                }&owner=${this.filters.owner}&user${
                    this.authUser.role != "regular"
                        ? this.filters.user
                        : this.authUser.id
                }&area=${this.filters.area}
                          &search=${this.filters.search}`
            );
        });
    },
};
</script>
<style>
img {
    height: 1.5rem;
    margin-right: 0.25rem;
}
</style>
