<template>
    <div>
        <div class="row mb-4" v-for="row in rows" :key="'row #' + row">
            <div
                class="col d-flex align-items-stretch"
                v-for="(bookable, column) in bookablesInRow(row)"
            >
                <bookable-list-item
                    :item-title="bookable.title"
                    :item-content="bookable.description"
                >
                </bookable-list-item>
            </div>

            <div
                class="col"
                v-for="p in placeholdersInRow(row)"
            ></div>
        </div>
    </div>
</template>

<script>
    import BookableListItem from './BookableListItem';
    export default {
        components: {
            BookableListItem
        },
        computed: {
            rows () {
                return this.bookables === null ? 0 : Math.ceil(this.bookables.length / this.columns);
            }
        },
        data () {
            return {
                bookables: null,
                columns: 3,
            }
        },
        methods: {
            bookablesInRow (row) {
                return this.bookables.slice((row - 1) * this.columns, row * this.columns);
            },
            placeholdersInRow (row) {
                return this.columns - this.bookablesInRow(row).length;
            }
        },
        created() {
            let $ctrl = this;
            const request = axios
                .get('/api/bookables')
                .then(response => {
                    this.bookables = response.data;
                });


        },
        controller() {
            console.log(1);
        }
    }
</script>
