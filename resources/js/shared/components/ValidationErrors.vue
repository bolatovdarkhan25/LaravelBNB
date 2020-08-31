<template>
    <div>
        <div class="invalid-feedback" v-for="error in errors">
            {{error}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "ValidationErrors",
        props: ['errors'],
    }
</script>

<style scoped>
    .is-invalid ~ div > .invalid-feedback {
        display: block;
    }
</style>
