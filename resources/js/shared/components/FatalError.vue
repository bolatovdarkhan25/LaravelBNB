<template>
    <div class="text-center error">
        <i class="fas fa-bomb"></i>
        <h1 class="mt-4">We have encountered problem</h1>
        <h2>Unfortunately we can not proceed</h2>
    </div>
</template>

<script>
    export default {
        name: "FatalError"
    }
</script>

<style scoped>
    .error {
        color: #999999;
        font-size: 10rem;
    }
</style>
