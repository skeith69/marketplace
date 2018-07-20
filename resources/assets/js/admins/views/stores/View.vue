<template>
    <div>
        <div class="card">
            <div class="card-header">
                Stores / View Store
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <div v-if="store.image">
                        <div class="row">
                            <div class="offset-md-3 col-md-6">
                                <img class="card-img-top" :src="'/storage/images/' + store.image" alt="">
                            </div>
                        </div>
                    </div>
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="store.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Address</label>
                            <textarea class="form-control" v-model="store.address" rows="3"></textarea>
                        </div>
                        <div class="form-group" v-if="todaySales">
                            <label>Today Sales</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">PHP</div>
                                </div>
                                <input type="number" class="form-control" v-model="todaySales" autocomplete="off" min="1" max="99999999" required>
                            </div>
                        </div>
                        <div class="form-group" v-if="todaySales">
                            <label>Current Week Sales</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">PHP</div>
                                </div>
                                <input type="number" class="form-control" v-model="currentWeekSales" autocomplete="off" min="1" max="99999999" required>
                            </div>
                        </div>
                        <div class="form-group" v-if="todaySales">
                            <label>Current Month Sales</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">PHP</div>
                                </div>
                                <input type="number" class="form-control" v-model="currentMonthSales" autocomplete="off" min="1" max="99999999" required>
                            </div>
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewStores">Back</button>
                    <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="editStore">Edit Store</button>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteStoreModal">Delete Store</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteStoreModal" tabindex="-1" role="dialog" aria-labelledby="deleteStoreTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Store?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Store?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteStore">Confirm Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ifReady: false,
                store: '',
                todaySales: null,
                currentWeekSales: null,
                currentMonthSales: null
            };
        },

        mounted() {
            let storePromise = new Promise((resolve, reject) => {
                axios.get('/api/stores/' + this.$route.params.id).then(res => {
                    this.store = res.data.store;
                    resolve();
                });
            });

            let todaySalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/today-sales', {
                    params: {
                        store_id: this.$route.params.id
                    }
                }).then(res => {
                    this.todaySales = res.data.todaySales;
                    resolve();
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            let currentWeekSalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/current-week-sales', {
                    params: {
                        store_id: this.$route.params.id
                    }
                }).then(res => {
                    this.currentWeekSales = res.data.currentWeekSales;
                    resolve();
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            let currentMonthSalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/current-month-sales', {
                    params: {
                        store_id: this.$route.params.id
                    }
                }).then(res => {
                    this.currentMonthSales = res.data.currentMonthSales;
                    resolve();
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            Promise.all([storePromise, todaySalesPromise, currentMonthSalesPromise, currentMonthSalesPromise]).then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewStores() {
                this.$router.push({
                    name: 'stores.index'
                });
            },
            editStore() {
                this.$router.push({
                    name: 'stores.edit',
                    params: { id: this.store.id }
                });
            },
            openDeleteStoreModal() {
                $('#deleteStoreModal').modal('show');
            },
            deleteStore() {
                $('#deleteStoreModal').modal('hide');

                axios.delete('/api/stores/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'stores.index' });
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
