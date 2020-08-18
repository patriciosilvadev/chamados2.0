<template>
    <div class="container">
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
    </div>
</template>
<script>
export default {
    data() {
        return {
            filter: {
                status: "",
                owner: "",
                paginate: "",
                search: "",
                data: [null, null],
                solicitante: "",
                department: "",
            },
        };
    },
};
</script>
