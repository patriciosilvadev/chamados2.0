<template>
    <form
        enctype="multipart/form-data"
        @submit.prevent="save"
        @keydown="form.errors.clear($event.target.name)"
    >
        <div class="row">
            <div class="col-md-12">
                <h2>Serviços</h2>
            </div>
        </div>
        <div
            class="row d-flex align-items-end"
            v-if="
                (authUser.role === 'manager' && authUser.department_id === 7) ||
                    authUser.role === 'support'
            "
        >
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input
                                class="form-check-input"
                                name="recurrent"
                                id="recurrent"
                                type="checkbox"
                                v-model="form.is_recurrent"
                            />
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                            <label for="recurrent">Recorrente</label>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4" v-if="form.is_recurrent">
                <div class="form-group">
                    <label for="expected_date">Data prevista</label><br />
                    <date-picker
                        v-model="form.expected_date"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :not-before="new Date()"
                        width="100%"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('expected_date')"
                        v-if="form.errors.has('expected_date')"
                    ></small>
                </div>
            </div>
            <div class="col-md-4" v-if="form.is_recurrent">
                <div class="form-group">
                    <label for="recurrent">Tipo de recorrência</label>
                    <select
                        name="recurrent"
                        id="recurrent"
                        class="form-control"
                        v-model="form.recurrent"
                    >
                        <option value="">Selecione</option>
                        <option value="daily">Diário</option>
                        <option value="weekly">Semanal</option>
                        <option value="biweekly">Quinzenal</option>
                        <option value="monthly">Mensal</option>
                        <option value="bimonthly">Bimestral</option>
                        <option value="quarterly">Trimestral</option>
                        <option value="semiannual">Semestral</option>
                        <option value="yearly">Anual</option>
                        <option value="biennial">Bienal</option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('recurrent')"
                        v-if="form.errors.has('recurrent')"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <select
                        name="department"
                        :disabled="departments.length > 1 ? false : true"
                        id="department"
                        class="form-control text-capitalize"
                        v-model="form.department"
                        @change="
                            fetch(
                                'subdepartments',
                                `?department=${this.departments[0].id}&method=supportAreas`
                            );
                            fetch(
                                'sectors',
                                `?department=${form.department}&subdepartment=${form.subdepartment}`
                            );
                        "
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="department.id"
                            :key="department.id"
                            v-for="department in departments"
                            v-text="department.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('department')"
                        v-if="form.errors.has('department')"
                    ></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="subdepartment">Sub Departamento</label>
                    <select
                        name="subdepartment"
                        id="subdepartment"
                        class="form-control text-capitalize"
                        v-model="form.subdepartment"
                        @change="
                            fetch(
                                'sectors',
                                `?department=${form.department}&subdepartment=${form.subdepartment}`
                            );
                            changeSupportArea();
                            if (form.subdepartment == 8 && !environments.length)
                                fetch('environments');
                        "
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="subdepartment.id"
                            :key="subdepartment.id"
                            v-for="subdepartment in subdepartments"
                            v-text="subdepartment.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('subdepartment')"
                        v-if="form.errors.has('subdepartment')"
                    ></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sector">Tipo</label>
                    <select
                        name="sector"
                        id="sector"
                        class="form-control text-capitalize"
                        v-model="form.sector"
                        @change="fetch('services', `?sector=${form.sector}`)"
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="sector.id"
                            :key="sector.id"
                            v-for="sector in sectors"
                            v-text="sector.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('sector')"
                        v-if="form.errors.has('sector')"
                    ></small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="service">Serviço</label>
                    <select
                        name="service"
                        id="service"
                        class="form-control text-capitalize"
                        v-model="form.service"
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="service.id"
                            :key="service.id"
                            v-for="service in services"
                            v-text="service.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('service')"
                        v-if="form.errors.has('service')"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row" v-if="form.subdepartment == 8">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="environment">Local</label>
                    <select
                        name="environment"
                        id="environment"
                        class="form-control text-capitalize"
                        v-model="form.environment"
                        @change="
                            fetch('spots', `?environment=${form.environment}`)
                        "
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="environment.id"
                            :key="environment.id"
                            v-for="environment in environments"
                            v-text="environment.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('environment')"
                        v-if="form.errors.has('environment')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="spot">Ambiente</label>
                    <select
                        name="spot"
                        id="spot"
                        class="form-control text-capitalize"
                        v-model="form.spot"
                    >
                        <option value="">Selecione</option>
                        <option
                            class="text-capitalize"
                            :value="spot.id"
                            :key="spot.id"
                            v-for="spot in spots"
                            v-text="spot.name"
                        ></option>
                    </select>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('spot')"
                        v-if="form.errors.has('spot')"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <h2>Detalhes</h2>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="desired_date">Data desejada</label><br />
                    <date-picker
                        v-model="form.desired_date"
                        lang="pt-br"
                        format="DD/MM/YYYY"
                        input-class="form-control"
                        :not-before="new Date()"
                        width="100%"
                    ></date-picker>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('desired_date')"
                        v-if="form.errors.has('desired_date')"
                    ></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="attach_file_name">Anexo</label>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            name="attach_file_name"
                            id="attach_file_name"
                            @change="getFile"
                        />
                        <label
                            class="custom-file-label form-control"
                            id="attach_file_name_nome"
                            for="attach_file_name"
                            >Escolha um arquivo</label
                        >
                    </div>
                    <small
                        class="text-danger"
                        v-text="form.errors.get('attached_file_name')"
                        v-if="form.errors.has('attached_file_name')"
                    ></small>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">Descrição do Problema</label>
                    <textarea
                        name="description"
                        id="description"
                        cols="30"
                        rows="7"
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
        </div>
        <submit-button />
    </form>
</template>
<script>
import DatePicker from "vue2-datepicker";
import Form from "../../form-validation/Form";
export default {
    props: ["departments", "http_verb"],
    data() {
        return {
            form: new Form({
                description: "",
                environment: "",
                spot: "",
                sector: "",
                service: "",
                department: "",
                subdepartment: "",
                attached_file_name: null,
                desired_date: null,
                expected_date: null,
                recurrent: "",
                is_recurrent: false,
            }),
            authUser: {},
            subdepartments: [],
            sectors: [],
            services: [],
            environments: [],
            spots: [],
        };
    },
    methods: {
        getFile(event) {
            this.form.attach_file_name = event.target.files[0];
            document.querySelector("#attach_file_name_nome").innerText =
                event.target.files[0].name;
        },
        save: _.throttle(
            function() {
                window.events.$emit("loading", true);
                this.form[this.http_verb]("/supports")
                    .then((result) => {
                        window.events.$emit("loading", false);
                        window.location = "/supports";
                    })
                    .catch((error) => {
                        window.events.$emit("loading", false);
                    });
            },
            1000,
            { trailing: false }
        ),
        fetch(entity, params = "") {
            this[entity] = [];
            window.axios
                .get("/" + entity + params)
                .then((result) => {
                    this[entity] = result.data;
                })
                .catch((errors) => {
                    window.flash("Algo deu errado.", "danger");
                });
        },
        changeSupportArea() {
            this.form.sector = "";
            this.form.service = "";
            this.form.environment = "";
            this.form.spot = "";
        },
    },
    created() {
        this.authUser = user;
        if (this.departments.length == 1) {
            this.form.department = this.departments[0].id;
            this.fetch(
                "subdepartments",
                `?department=${this.departments[0].id}&method=supportAreas`
            );
        }
    },
};
</script>
<style>
.btn-primary {
    min-width: 75px;
}
</style>
