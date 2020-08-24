<template>

    <div class="d-flex ">
        <i class="fas fa-star" v-for="star in fullStars"></i>
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="stars in emptyStars"></i>
    </div>

</template>

<script>
    export default {
        name: "StarRating",
        props: {
            rating: Number
        },
        computed: {
            halfStar() {
                return 5 - ((5 - Math.ceil(this.rating)) + Math.floor(this.rating)) !== 0;
            },
            fullStars() {
                return Math.floor(this.rating);
            },
            emptyStars() {
                return 5 - Math.ceil(this.rating);
            }
        }
    }
</script>

<style scoped>

</style>
