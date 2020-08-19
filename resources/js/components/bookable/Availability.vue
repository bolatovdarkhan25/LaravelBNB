<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">Check availability</h6>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="from">From</label>
                <input
                    type="text"
                    id="from"
                    class="form-control from-control-sm"
                    name="from"
                    placeholder="Start date"
                    v-model="from"
                    @keyup.enter="check"
                >
            </div>

            <div class="form-group col-md-6">
                <label for="to">To</label>
                <input
                    type="text"
                    id="to"
                    class="form-control from-control-sm"
                    name="to"
                    placeholder="End date"
                    v-model="to"
                    @keyup.enter="check"
                >
            </div>
            <button class="btn btn-primary btn-block" @click="check">Check!</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Availability",
        data () {
            return {
                from: null,
                to: null,
                loading: null,
                status: null,
                errors: null,

            }
        },
        methods: {
            check () {
                this.errors = null;
                this.loading = true;
                axios.get(
                    `/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`
                )
                .then(function (response) {
                    this.status = response.status;
                })
                .catch(function (error) {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                })
                .then(function () {
                    this.loading = false;
                })
            }
        }
    }
</script>

<style scoped>
    label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: gray;
        font-weight: bolder
    }
</style>
