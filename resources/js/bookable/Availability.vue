<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Check availability
            <transition name="fade">
                <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
                <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
            </transition>
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
                <validation-errors :errors="errorFor('from')"></validation-errors>
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
                <validation-errors :errors="errorFor('to')"></validation-errors>
            </div>
            <button class="btn btn-primary btn-block" @click="check">
                <span v-if="!loading">Check!</span>
                <span v-else class="fas fa-cog fa-spin">Checking...</span>
            </button>
        </div>
    </div>
</template>

<script>
    import { is422 } from "../shared/utils/response";
    import validationErrors from "../shared/mixins/validationErrors";

    export default {
        mixins: [validationErrors],
        name: "Availability",
        props: {
            bookableId: [String, Number],
        },
        data () {
            return {
                from: this.$store.state.lastSearch.from,
                to: this.$store.state.lastSearch.to,
                loading: null,
                status: null,
                errors: null,

            }
        },
        methods: {
            async check () {
                let $ctrl = this;
                $ctrl.errors = null;
                this.loading = true;

                await this.$store.dispatch('setLastSearch', {
                    from: this.from,
                    to: this.to
                });

                try {
                    this.status = (await axios.get(
                        `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
                    )).status;
                    this.$emit('availability', this.hasAvailability);
                } catch (error) {
                    if (is422(error)) {
                        $ctrl.errors = error.response.data.errors;
                    }
                    $ctrl.status = error.response.status;

                    this.$emit('availability', this.hasAvailability);
                }

                this.loading = false;
            },
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
