<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button
                    class="btn btn-success"
                    type="button"
                    @click.prevent="add"
                    v-text="text"
                ></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["data", "text", "event"],
    data() {
        return {
            properties: this.data,
        };
    },
    methods: {
        add() {
            window.events.$emit(this.event, this.properties);
        },
    },
};
</script>
