<template>
    <div class="d-flex justify-content-center">
        <div
            class="spinner-border spinner-border-sm"
            :class="color ? color : 'text-light'"
            role="status"
        >
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>
<script>
export default {
    props: ["color"]
};
</script>
