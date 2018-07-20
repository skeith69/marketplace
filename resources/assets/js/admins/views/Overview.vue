<template>
    <div>
        <div class="container">
            <div class="row" v-if="ifTenant">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Today Sales</h5>
                            <p class="card-text">PHP {{ todaySales }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current Week Sales</h5>
                            <p class="card-text">PHP {{ currentWeekSales }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Current Month Sales</h5>
                            <p class="card-text">PHP {{ currentMonthSales }}</p>
                        </div>
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
                ifTenant: false,
                todaySales: null,
                currentWeekSales: null,
                currentMonthSales: null
            }
        },

        mounted() {
            if (_.includes(this.$store.state.roles, 'tenant')) {
                this.ifTenant = true;
            }

            let todaySalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/today-sales').then(res => {
                    this.todaySales = res.data.todaySales;
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            let currentWeekSalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/current-week-sales').then(res => {
                    this.currentWeekSales = res.data.currentWeekSales;
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            let currentMonthSalesPromise = new Promise((resolve, reject) => {
                axios.get('/api/sales/current-month-sales').then(res => {
                    this.currentMonthSales = res.data.currentMonthSales;
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            });

            Promise.all([todaySalesPromise, currentMonthSalesPromise, currentMonthSalesPromise]).then(() => {
                this.ifReady = true;
            });
        }
    }
</script>
