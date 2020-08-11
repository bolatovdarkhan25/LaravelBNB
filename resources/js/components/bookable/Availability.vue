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
                to: null
            }
        },
        methods: {
            check () {
                alert('Hey you\'ve just clicked this!');
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
