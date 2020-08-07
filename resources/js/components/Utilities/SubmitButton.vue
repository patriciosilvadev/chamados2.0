<template>
    <div
        class="col-md-12 d-flex"
        :class="align ? align : 'justify-content-end'"
    >
        <button type="submit" class="btn" :class="color ? color : 'btn-primary'">
            <span
                v-text="buttonText ? buttonText : 'Enviar'"
                v-if="!loading"
            ></span>
            <loading-component v-else />
        </button>
    </div>
</template>
<script>
import LoadingComponent from "./Loading";
export default {
    props: ["buttonText", "align", "color"],
    data() {
        return {
            loading: false
        };
    },
    components: {
        LoadingComponent
    },
    created() {
        window.events.$on("loading", loading => {
            this.loading = loading;
        });
    }
};
</script>
