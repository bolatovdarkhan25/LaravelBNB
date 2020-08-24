<template>
    <div style="padding: 1rem">
        <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">
            Review List
        </h6>

        <div class="border-bottom d-none d-md-block" v-for="i in 3">
            <div class="row pt-4">
                <div class="col-md-6">Bolatov Darkhan</div>
                <div class="col-md-6 d-flex justify-content-end">STAR RATING</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    Added 5 minutes ago
                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    Content of the review
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReviewList"
    }
</script>

<style scoped>

</style>
