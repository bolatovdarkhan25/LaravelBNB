<template>
    <div>
        <success v-if="success">
            The operation was successful!
        </success>
        <fatal-error v-if="error"></fatal-error>
        <div class="row" v-if="!success && !error">
            <div :class="[{'col-md-4': twoColumns}, {'d-none': oneColumn}]">
                <div class="card">
                    <div class="card-body">
                        <div v-if="loading">Loading...</div>
                        <div v-if="hasBooking">
                            <p>
                                Stayed at
                                <router-link :to="{name: 'bookable', params: {id: booking.bookable.bookable_id}}">
                                    {{booking.bookable.title}}
                                </router-link>
                            </p>
                            <p>
                                From {{booking.from}} to {{booking.to}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="[{'col-md-8': twoColumns}, {'col-md-12': oneColumn}]">
                <div v-if="loading">Loading...</div>
                <div v-else>
                    <div v-if="alreadyReviewed">
                        <h3>You've already reviewed this booking!</h3>
                    </div>
                    <div v-else>
                        <div class="form-group">
                            <label class="text-muted">Select the star rating (1 is the worst - 5 is the best)</label>
                            <star-rating :class="[{'is-invalid': errorFor('rating')}]"
                                         class="fa-3x"
                                         v-model="review.rating">
                            </star-rating>
                            <validation-errors :errors="errorFor('rating')"></validation-errors>
                        </div>
                        <div class="form-group">
                            <label class="text-muted" for="content">Describe your expirience with</label>
                            <textarea :class="[{'is-invalid': errorFor('content')}]"
                                      class="form-control"
                                      cols="30"
                                      id="content"
                                      rows="10"
                                      v-model="review.content">
                            </textarea>
                            <validation-errors :errors="errorFor('rating')"></validation-errors>
                        </div>

                        <button :disabled="sending"
                                @click="submit" class="btn btn-lg btn-outline-primary btn-block">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {is404, is422} from '../shared/utils/response';
    import validationErrors from "../shared/mixins/validationErrors";

    export default {
        mixins: [validationErrors],
        name: "Review",
        data() {
            return {
                review: {
                    id: null,
                    rating: 0,
                    content: null
                },
                existingReview: null,
                loading: false,
                booking: null,
                error: false,
                sending: false,
                success: false
            }
        },
        async created() {
            this.review.id = this.$route.params.id;
            this.loading = true;

            try {
                this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
            } catch (error) {
                if (is404(error)) {
                    try {
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                    } catch (error) {
                        this.error = is404(error);
                    }
                } else {
                    this.error = true;
                }
            }

            this.loading = false;

            // axios
            //     .get(`/api/reviews/${this.review.id}`)
            //     .then(response => (this.existingReview = response.data.data))
            //     .catch(error => {
            //         if (is404(error)) {
            //             return axios.get(`/api/booking-by-review/${this.review.id}`)
            //                 .then(response => {
            //                     this.booking = response.data.data;
            //                 })
            //                 .catch(error => {
            //                     this.error = is404(error);
            //                 });
            //         }
            //
            //         this.error = true;
            //     })
            //     .then(() => {
            //         this.loading = false
            //     });
        },
        computed: {
            alreadyReviewed() {
                return this.hasReview || !this.booking;
            },
            hasReview() {
                return this.existingReview !== null;
            },
            hasBooking() {
                return this.booking !== null;
            },
            oneColumn() {
                return !this.loading && this.alreadyReviewed;
            },
            twoColumns() {
                return this.loading || !this.alreadyReviewed;
            }
        },
        methods: {
            submit() {
                this.sending = true;
                this.errors = null;

                axios.post('/api/reviews', this.review)
                    .then(response => this.success = response.status === 201)
                    .catch(error => {
                        if (is422(error)) {
                            this.errors = error.response.data.errors;
                            return;
                        }
                        this.error = true;
                    })
                    .then(() => this.sending = false);
            },
        }
    }
</script>

<style scoped>

</style>
