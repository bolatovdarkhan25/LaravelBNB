<template>
    <div>
        <nav class="navbar bg-dark border-bottom navbar-dark">
            <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">LaravelBNB</router-link>
            <router-link class="btn btn-dark nav-button" :to="{name: 'bookable', params: {'id': 1}}">Bookable</router-link>
        </nav>
        <div class="container my-4 px-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>

</style>
