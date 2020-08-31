<template>

    <div class="d-flex">
        <i class="fas fa-star" v-for="star in fullStars" @click="$emit('input', star)"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star"
           v-for="star in emptyStars"
           @click="$emit('input', fullStars + star)">
        </i>
    </div>

</template>

<script>
    export default {
        name: "StarRating",
        props: {
            value: Number
        },
        computed: {
            halfStar() {
                return 5 - ((5 - Math.ceil(this.value)) + Math.floor(this.value)) !== 0;
            },
            fullStars() {
                return Math.floor(this.value);
            },
            emptyStars() {
                return 5 - Math.ceil(this.value);
            }
        }
    }
</script>

<style scoped>

</style>
