<template>
    <div>
        <div class="card h-100">
            <div class="card-header">{{ itemTitle }}</div>
            <div class="card-body">{{ itemContent }}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'itemTitle': String,
            'itemContent': String,
            'price': Number
        },
        mounted() {
        }
    }
</script>
