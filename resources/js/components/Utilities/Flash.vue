<template>
    <div
        class="alert alert-flash"
        :class="'alert-' + level"
        role="alert"
        v-show="show"
        v-text="body"
    ></div>
</template>

<script>
export default {
    data() {
        return {
            body: "",
            level: "success",
            show: false
        };
    },
    props: ["message"],
    methods: {
        flash(data) {
            this.body = data.message;
            this.level = data.level;
            this.show = true;
            this.hide();
        },
        hide() {
            setTimeout(() => {
                this.show = false;
            }, 3500);
        }
    },
    created() {
        if (this.message) {
            this.flash(this.message);
        }
        window.events.$on("flash", data => this.flash(data));
    }
};
</script>

<style scoped>
.alert-flash {
    position: fixed;
    right: 25px;
    bottom: 25px;
}
</style>
