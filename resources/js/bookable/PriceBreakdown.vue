<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">price breakdown</h6>

        <div v-for="(days, pr) in price.breakdown"
             class="py-2 border-bottom border-top d-flex justify-content-sm-between">
            <span>${{pr}} x {{days}}</span>
            <span>${{days * pr}}</span>
        </div>

        <div class="font-weight-bolder d-flex justify-content-sm-between">
            <span>Total</span>
            <span>${{price.total}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PriceBreakdown",
        props: {
            price: Object
        }
    }
</script>

<style scoped>

</style>
