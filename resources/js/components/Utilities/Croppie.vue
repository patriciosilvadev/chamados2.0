<template>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <Cropper
                :src="
                    image
                        ? image
                        : 'https://images.pexels.com/photos/1254140/pexels-photo-1254140.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940'
                "
                :stencilComponent="$options.components.CircleStencil"
                ref="cropper"
                v-if="!cropped"
            />
            <img
                v-else
                :src="image"
                class="img img-thumbnail img-responsive avatar"
                alt=""
            />
            <small class="text-muted" v-if="!image"
                >*Imagem apenas para demonstração.&nbsp;</small
            >
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="anexo">Avatar*</label>
                <div class="custom-file">
                    <input
                        type="file"
                        class="custom-file-input"
                        name="anexo"
                        id="anexo"
                        @change="uploadImage"
                    />
                    <label
                        class="custom-file-label form-control"
                        id="anexo_nome"
                        for="anexo"
                        >Escolha um arquivo</label
                    >
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-around mt-2">
            <button type="button" class="btn btn-success" @click.prevent="crop">
                <i class="far fa-image"></i>
            </button>
            <button
                type="button"
                class="btn btn-danger"
                @click.prevent="remove"
            >
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
    </div>
</template>
<script>
import { Cropper, CircleStencil } from "vue-advanced-cropper";
export default {
    props: ["avatar"],
    data() {
        return {
            image: null,
            file: null,
            cropped: false,
        };
    },
    components: {
        Cropper,
        CircleStencil,
    },
    methods: {
        uploadImage(event) {
            this.cropped = false;
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.image = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                document.querySelector("#anexo_nome").innerText =
                    event.target.files[0].name;
                this.file = event.target.files[0];
            }
        },
        onChange({ coordinates, canvas }) {
            this.image = canvas.toDataURL();
        },
        crop() {
            if (this.image) {
                this.cropped = true;
                const { coordinates, canvas } = this.$refs.cropper.getResult();
                this.image = canvas.toDataURL();
                window.events.$emit("avatar", this.image);
                window.events.$emit("logo", this.file);
                return;
            }
            window.flash("Esolha uma imagem.", "danger");
        },
        remove() {
            if (this.image) {
                this.image = null;
                this.cropped = false;
                document.querySelector("#anexo_nome").innerText =
                    "Escolha um arquivo";
                window.events.$emit("remove-avatar");
                return;
            }
            window.flash("Esolha uma imagem.", "danger");
        },
    },
    created() {
        if (this.avatar) {
            this.image = this.avatar;
            this.cropped = true;
        }
    },
};
</script>
<style scoped>
.messages {
    margin-top: -0.75rem;
}
.avatar {
    border-radius: 50%;
    width: 80%;
}
</style>
