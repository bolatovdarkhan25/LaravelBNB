<script>
    import Availability from "../Availability";
    import ReviewList from "../ReviewList";
    import BookableTemplate from './Bookable.html';
    import PriceBreakdown from "../PriceBreakdown";
    import { mapState } from 'vuex';

    export default {
        template: BookableTemplate,
        components: {
            Availability,
            ReviewList,
            PriceBreakdown
        },
        data () {
            return {
                bookable: null,
                loading: true,
                price: null
            }
        },
        created () {
            axios
                .get(`/api/bookables/${this.$route.params.id}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false;
                })
        },
        computed: mapState({
            lastSearch: 'lastSearch',
        }),
        methods: {
            async checkPrice(hasAvailability) {
                if (hasAvailability) {
                    try {
                        this.price = (await axios.get(
                            `/api/bookables/${this.bookable.id}/price?
                            from=${this.lastSearch.from}&to=${this.lastSearch.to}`
                        )).data;

                    } catch (error) {

                    }
                } else {
                    this.price = null;
                    return;
                }
            }
        }
    }
</script>

<style scoped></style>
