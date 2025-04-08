<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <button type="button" class="btn btn-primary">Selected</button> -->
                <vue-good-table ref="my-table" :select-options="{ enabled: true }" :search-options="{ enabled: true }" :columns="columns" :pagination-options="{enabled: true,perPage: 5}" :rows="rows" :paginate="true" :globalSearch="true">
                    <template slot="table-row">
                    </template>
                </vue-good-table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            columns: [{
                    label: 'Payment ID',
                    field: 'payment_id',
                },
                {
                    label: 'Amount',
                    field: 'amount',
                },
                {
                    label: 'Currency',
                    field: 'currency',
                },
                {
                    label: 'Created at',
                    field: 'created_at',
                    // sortable: false,
                },
                {
                    label: 'Status',
                    field: 'payment_status',
                }
            ],
            rows: [],
            rowSelection: []
        }
    },

    methods: {
        get_data() {
            axios.get('api/transactions').then((res) => {
                this.rows = res.data
            })
        },

        selectionChanged(params) {
            this.rowSelection = params.selectedRows;
        },

        get_selected() {
            console.log(this.$refs['my-table'].selectedRows)
        }
    },

    created() {
        this.get_data()
    }
};
</script>
