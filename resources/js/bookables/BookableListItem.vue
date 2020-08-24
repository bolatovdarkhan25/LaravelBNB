<template>
    <div>
        <router-link :to="{name: 'bookable', params: {id}}" style="color: black; outline:none; text-decoration:none">
            <div class="card h-100">
                <div class="card-header">{{ title }}</div>
                <div class="card-body">{{ description }}</div>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        props: {
            'title': String,
            'description': String,
            'id': Number
        },
        mounted() {
        }
    }
</script>
