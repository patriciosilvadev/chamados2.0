<template>
    <div class="status">
        <div class="row">
            <div
                :class="{
                    'col-md-4': filter.owner != 0,
                    'col-md-6': filter.owner == 0,
                }"
            >
                <div class="form-group">
                    <label for="status">Status</label>
                    <select
                        name="status"
                        id="status"
                        class="form-control"
                        v-model="filter.status"
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
                    'col-md-4': filter.owner != 0,
                    'col-md-6': filter.owner == 0,
                }"
            >
                <div class="form-group">
                    <label for="owner">Tipo de Chamado</label>
                    <select
                        name="owner"
                        id="owner"
                        class="form-control"
                        v-model="filter.owner"
                    >
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
                class="col-md-4"
                v-if="
                    (diretoria || gestor || gestorSuporte) && filter.owner != 0
                "
            >
                <div class="form-group">
                    <label for="user">Área de Suporte</label>
                    <select
                        name="solicitante"
                        id="solicitante"
                        class="form-control"
                        v-model="filter.departamento"
                    >
                        <option value="">Todas as áreas</option>
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
        <div class="row d-flex align-items-end">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_inicio">Data</label><br />
                    <date-picker
                        v-model="filter.data"
                        :range="true"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        width="100%"
                    ></date-picker>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user">Solicitante</label>
                    <select
                        name="solicitante"
                        id="solicitante"
                        class="form-control"
                        v-model="filter.solicitante"
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

            <div class="col-md-12 d-flex justify-content-end">
                <a
                    :href="
                        `/chamados/relatorio/export/${JSON.stringify(
                            this.filter
                        )}`
                    "
                    class="btn btn-primary"
                    >Enviar</a
                >
            </div>
        </div>
    </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
export default {
    props: ["user", "users", "departamentos"],
    components: { DatePicker },
    data() {
        return {
            chamados: [],
            filter: {
                status: "",
                owner: "",
                paginate: "",
                data: [null, null],
                solicitante: "",
                departamento: "",
                search: "",
            },
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
};
</script>
<style>
img {
    height: 1.5rem;
    margin-right: 0.25rem;
}
</style>
