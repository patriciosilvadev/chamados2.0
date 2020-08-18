<template>
    <tr :class="{ 'table-danger': atrasado }">
        <td scope="row"><b v-text="`# ${chamado.id}`"></b></td>
        <td v-text="chamado.usuario.nome"></td>
        <td v-html="status"></td>
        <td v-text="chamado.departamento.nome"></td>
        <td v-text="chamado.local ? chamado.local.nome : 'Não informado'"></td>
        <td v-text="chamado.servico.nome"></td>
        <td v-text="created"></td>
        <td>
            <div class="row">
                <div
                    class="col-md-12 d-flex justify-content-center align-itens-center"
                >
                    <button
                        class="btn btn-warning mr-2"
                        @click="sendChamado"
                        data-toggle="modal"
                        data-target="#chamadoModal"
                    >
                        <i class="fas fa-glasses"></i>
                    </button>
                    <a
                        :href="`/chamados/${chamado.id}/interacoes`"
                        class="btn btn-success"
                        v-if="suporte || owner"
                        ><i class="fas fa-binoculars"></i
                    ></a>
                </div>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["chamado", "user"],
    computed: {
        created() {
            return moment(this.chamado.created_at).format("DD/MM/YYYY");
        },
        atrasado() {
            if (this.chamado.data_prevista && this.chamado.status == 2) {
                return moment(this.chamado.data_prevista).format("YYYY-MM-DD") <
                    moment(new Date()).format("YYYY-MM-DD")
                    ? true
                    : false;
            }
        },
        status() {
            if (this.chamado.status === 1)
                return '<span class="badge badge-warning">Aberto</span>';
            else if (this.chamado.status === 2)
                return '<span class="badge badge-primary">Andamento</span>';
            else if (this.chamado.status === 0)
                return '<span class="badge badge-success">Concluído</span>';
            else if (this.chamado.status === 3)
                return '<span class="badge badge-danger">Recusado</span>';
        },
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
        owner() {
            return this.chamado.user_id === this.user.id ? true : false;
        },
    },
    methods: {
        sendChamado() {
            window.events.$emit("sendchamado", this.chamado);
        },
    },
    created() {
        window.Echo.private(`message.${this.chamado.id}`).listen(
            "InteracaoCreate",
            (event) => {
                console.log(event.interacao);
            }
        );
    },
};
</script>
<style>
.badge {
    padding: 0.5rem;
}
</style>
