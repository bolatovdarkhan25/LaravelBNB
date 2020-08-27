<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="alreadyReviewed">
                <h3>You've already reviewed this booking!</h3>
            </div>
            <div v-else>
                <div class="form-group">
                    <label class="text-muted">Select the star rating (1 is the worst - 5 is the best)</label>
                    <star-rating class="fa-3x" v-model="review.rating">
                    </star-rating>
                </div>
                <div class="form-group">
                    <label for="content" class="text-muted">Describe your expirience with</label>
                    <textarea name="content"
                              cols="30"
                              rows="10"
                              class="form-control"
                              v-model="review.content">
                    </textarea>
                </div>

                <button class="btn btn-lg btn-outline-primary btn-block">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Review",
        methods: {
            onRatingChanged(rating) {
                this.review.rating = rating;
            }
        },
        data() {
            return {
                review: {
                    rating: 0,
                    content: null
                },
                existingReview: null,
                loading: false,
                booking: null
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/reviews/${this.$route.params.id}`)
                .then(response => (this.existingReview = response.data.data))
                .catch(error => {
                    if (error.response &&
                        error.response.status &&
                        error.response.status === 404) {
                        return axios.get(`/api/booking-by-review/${this.$route.params.id}`)
                                    .then(response => {
                                        this.booking = response.data.data;
                                    });
                    }
                })
                .then(() => {
                    this.loading = false
                });
        },
        computed: {
           alreadyReviewed() {
               return this.existingReview !== null;
           }
        }
    }
</script>

<style scoped>

</style>
