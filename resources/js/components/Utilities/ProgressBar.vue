<template>
    <div class="col-md-12">
        <div class="progress">
            <div
                class="progress-bar"
                :class="color ? color : 'bg-primary'"
                role="progressbar"
                :style="`width: ${progress}%;`"
                :aria-valuenow="progress"
                aria-valuemin="0"
                aria-valuemax="100"
                v-text="`Status ${progress}%`"
            ></div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["progress", "color"],
};
</script>
