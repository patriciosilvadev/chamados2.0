<template>
    <div>
        <div class="row">
            <div
                :class="{
                    'col-md-4': suporte || diretoria || gestor,
                    'col-md-6': !suporte && !diretoria && !gestor,
                }"
            >
                <div class="form-group">
                    <label for="departamento">Itens por página</label>
                    <select
                        name="pagination"
                        id="pagination"
                        class="form-control"
                        v-model="filter.paginate"
                        @change="fetch()"
                    >
                        <option value="">Selecione</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
            <div
                :class="{
                    'col-md-4': suporte || diretoria || gestor,
                    'col-md-6': !suporte && !diretoria && !gestor,
                }"
            >
                <div class="form-group">
                    <label for="status">Status</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control"
                        v-model="filter.status"
                        @change="fetch()"
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
                :class="{
                    'col-md-4': suporte || diretoria || gestor,
                    'col-md-6': !suporte && !diretoria && !gestor,
                }"
                v-if="suporte || diretoria || gestor"
            >
                <div class="form-group">
                    <label for="owner">Tipo de Chamado</label>
                    <select
                        name="owner"
                        id="owner"
                        class="form-control"
                        v-model="filter.owner"
                        @change="fetch()"
                    >
                        <option value="">Selecione</option>
                        <option value="1">Meus Chamados</option>
                        <option
                            value="2"
                            v-if="diretoria || gestorSuporte || gestor"
                            >Chamados dos meus Colaboradores</option
                        >
                        <option value="0" v-if="suporte">Suporte</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-end">
            <div
                :class="{
                    'col-md-4': diretoria || gestor || gestorSuporte,
                    'col-md-6': !diretoria && !gestor && !gestorSuporte,
                }"
            >
                <div class="form-group">
                    <label for="data_inicio">Data</label><br />
                    <date-picker
                        v-model="filter.data"
                        :range="true"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        width="100%"
                        @change="fetch()"
                    ></date-picker>
                </div>
            </div>
            <div
                :class="{
                    'col-md-4': diretoria || gestor || gestorSuporte,
                    'col-md-6': !diretoria && !gestor && !gestorSuporte,
                }"
                v-if="diretoria || suporte || gestor"
            >
                <div class="form-group">
                    <label for="user">Solicitante</label>
                    <select
                        name="solicitante"
                        id="solicitante"
                        class="form-control"
                        v-model="filter.solicitante"
                        @change="fetch()"
                    >
                        <option value="">Selecione</option>
                        <option
                            :value="user.nome"
                            v-for="(user, index) in users"
                            v-text="user.nome"
                            :key="index"
                        ></option>
                    </select>
                </div>
            </div>
            <div
                class="col-md-4"
                v-if="
                    (diretoria || gestor || gestorSuporte) && filter.owner == 2
                "
            >
                <div class="form-group">
                    <label for="user">Área de Suporte</label>
                    <select
                        name="solicitante"
                        id="solicitante"
                        class="form-control"
                        v-model="filter.departamento"
                        @change="fetch()"
                    >
                        <option value="">Selecione</option>
                        <option
                            :value="`[${departamento.cod_grupo}]`"
                            v-for="(departamento, index) in departamentos"
                            v-text="departamento.nome"
                            :key="index"
                        ></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Busca</label>
                    <input
                        class="form-control"
                        type="text"
                        @keyup="fetch()"
                        v-model="filter.search"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div v-if="!loading">
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
                                v-for="chamado in chamados"
                                :chamado="chamado"
                                :user="user"
                                :key="chamado.id"
                                @sendchamado="sendChamado($event)"
                            ></table-row-component>
                        </tbody>
                    </table>
                    <paginator
                        :paginate="paginate"
                        @page="fetch($event)"
                        v-show="paginate.last_page > 1"
                    ></paginator>
                </div>
                <div
                    v-else="loading"
                    class="d-flex justify-content-center mt-3"
                >
                    <img src="/img/loading.gif" alt="loading_img" /><span
                        >Carregando...</span
                    >
                </div>
            </div>
        </div>
        <div class="row" v-if="!chamados.length && !loading">
            <div class="col-md-12 d-flex justify-content-center mt-3">
                <span>Nenhum chamado encontrado.</span>
            </div>
        </div>
    </div>
</template>
<script>
import _ from "lodash";
import DatePicker from "vue2-datepicker";
import Paginator from "../Paginator";
export default {
    props: ["user", "users", "departamentos"],
    components: { Paginator, DatePicker },
    data() {
        return {
            chamados: [],
            filter: {
                status: "",
                owner: "",
                paginate: "",
                search: "",
                data: [null, null],
                solicitante: "",
                departamento: "",
            },
            paginate: {},
            loading: false,
            timeout: null,
        };
    },
    computed: {
        diretoria() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 3) boolean = true;
            });
            return boolean;
        },
        gestorSuporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                this.user.departamentos.forEach((departamento) => {
                    if (
                        funcao.cod_papel === 2 &&
                        (departamento.cod_grupo === 2 ||
                            departamento.cod_grupo === 13)
                    )
                        boolean = true;
                });
            });
            return boolean;
        },
        gestor() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 2 && !this.gestorSuporte)
                    boolean = true;
            });
            return boolean;
        },
        suporte() {
            let boolean = false;
            this.user.funcoes.forEach((funcao) => {
                if (funcao.cod_papel === 8 || this.gestorSuporte)
                    boolean = true;
            });
            return boolean;
        },
    },
    methods: {
        fetch: _.debounce(function(url = null) {
            this.loading = !this.loading;
            axios
                .get(
                    url !== null
                        ? url
                        : `/chamados/${JSON.stringify(this.filter)}`
                )
                .then(({ data }) => {
                    this.chamados = [];
                    this.chamados = data.data;
                    delete data.data;
                    this.paginate = data;
                    this.loading = !this.loading;
                })
                .catch((error) => console.error(error));
        }, 300),
        sendChamado(chamado) {
            this.$emit("sendchamado", chamado);
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
