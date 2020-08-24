<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Check availability
            <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
            <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
        </h6>
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
                    :class="[{'is-invalid': this.errorFor('from')}]"
                >
                <div class="invalid-feedback" v-for="error in this.errorFor('from')">
                    {{error}}
                </div>
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
                    :class="[{'is-invalid': this.errorFor('to')}]"
                >
                <div class="invalid-feedback" v-for="error in this.errorFor('to')">
                    {{error}}
                </div>
            </div>
            <button class="btn btn-primary btn-block" @click="check">Check!</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Availability",
        props: {
            bookableId: String,
        },
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
                let $ctrl = this;
                $ctrl.errors = null;
                this.loading = true;
                axios.get(
                    `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
                )
                .then(response => {
                    this.status = response.status;
                })
                .catch( function(error) {
                    if (error.response.status === 422) {
                        $ctrl.errors = error.response.data.errors;
                    }
                    $ctrl.status = error.response.status;
                })
                .then(() => {
                    this.loading = false;
                })
            },
            errorFor(field) {
                return this.hasErrors && this.errors[field] ? this.errors[field] : null
            }
        },
        computed: {
            hasErrors() {
                return 422 === this.status && this.errors !== null;
            },
            hasAvailability() {
                return 200 === this.status;
            },
            noAvailability() {
                return 404 === this.status;
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
