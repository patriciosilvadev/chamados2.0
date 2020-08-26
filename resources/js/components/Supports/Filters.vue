<template>
    <div class="container-fluid">
        <div class="row d-flex align-items-end">
            <div :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'">
                <div class="form-group">
                    <label for="">Busca</label>
                    <input
                        class="form-control"
                        type="text"
                        @keyup="search"
                        v-model="filters.search"
                    />
                </div>
            </div>
            <div :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'">
                <div class="form-group">
                    <label for="departamento">Itens por página</label>
                    <select
                        name="pagination"
                        id="pagination"
                        class="form-control"
                        v-model="filters.paginate"
                        @change="search"
                    >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="all">Todos</option>
                    </select>
                </div>
            </div>
            <div :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control"
                        v-model="filters.status"
                        @change="search"
                    >
                        <option value="">Selecione</option>
                        <option value="[1]">Aberto</option>
                        <option value="[2]">Andamento</option>
                        <option value="[0]">Concluído</option>
                        <option value="[3]">Recusado</option>
                        <option value="[1, 2]">Aberto + Andamento</option>
                        <option value="[0, 1, 2, 3]"
                            >Aberto + Andamento + Concluído + Recusado</option
                        >
                    </select>
                </div>
            </div>
            <div
                :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'"
                v-if="authUser.role != 'regular'"
            >
                <div class="form-group">
                    <label for="owner">Tipo de Chamado</label>
                    <select
                        name="owner"
                        id="owner"
                        class="form-control"
                        v-model="filters.owner"
                        @change="search"
                    >
                        <option value="1">Meus Chamados</option>
                        <option
                            value="2"
                            v-if="
                                authUser.role == 'manager' ||
                                    authUser.role == 'ceo'
                            "
                            >Chamados dos meus Colaboradores</option
                        >
                        <option value="0" v-if="authUser.role == 'support'"
                            >Suporte</option
                        >
                    </select>
                </div>
            </div>
            <div
                :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'"
                v-if="authUser.role != 'regular'"
            >
                <div class="form-group">
                    <label for="user">Solicitante</label>
                    <select
                        name="user"
                        id="user"
                        class="form-control"
                        v-model="filters.user"
                        @change="search"
                    >
                        <option value="">Selecione</option>
                        <option
                            :value="user.name"
                            v-for="(user, index) in users"
                            v-text="user.name"
                            :key="index"
                        ></option>
                    </select>
                </div>
            </div>
            <div
                class="col-md-4"
                v-if="authUser.role != 'regular' && filters.owner == 2"
            >
                <div class="form-group">
                    <label for="area">Área de Suporte</label>
                    <select
                        name="area"
                        id="area"
                        class="form-control"
                        v-model="filters.area"
                        @change="search"
                    >
                        <option value="">Selecione</option>
                        <option
                            :value="`[${department.cod_grupo}]`"
                            v-for="(department, index) in departments"
                            v-text="department.name"
                            :key="index"
                        ></option>
                    </select>
                </div>
            </div>
            <div :class="authUser.role != 'regular' ? 'col-md-4' : 'col-md-6'">
                <div class="form-group">
                    <label for="data_inicio">Data</label><br />
                    <date-picker
                        v-model="filters.date"
                        :range="true"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        width="100%"
                        @change="search"
                    ></date-picker>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            authUser: {},
            filters: {
                status: "",
                owner: 1,
                paginate: 10,
                search: "",
                date: [null, null],
                user: "",
                area: "",
            },
            departments: [],
            users: [],
        };
    },
    methods: {
        search: _.debounce(function() {
            window.events.$emit("search", this.filters);
        }, 350),
        fetch(entity, queryParams = "") {
            this[entity] = [];
            window.axios
                .get(`/${entity}${queryParams}`)
                .then(({ data }) => {
                    this[entity] = data;
                })
                .catch((errors) => {
                    window.flash("Algo deu errado.", "danger");
                });
        },
    },
    created() {
        this.authUser = user;
        this.fetch("departments");
        this.fetch("users");
    },
};
</script>
