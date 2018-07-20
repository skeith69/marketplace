<template>
    <div>
        <div class="card">
            <div class="card-header">
                Sales / Add New Sales
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="addNewSale">
                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">PHP</div>
                                </div>
                                <input type="number" class="form-control" v-model="amount" autocomplete="off" min="1" max="99999999" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm">Add New Sale</button>
                    </form>
                </div>

                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
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
                ifReady: true,
                amount: ''
            };
        },

        methods: {
            addNewSale() {
                this.ifReady = false;

                let formData = new FormData();

                formData.append('amount', this.amount);

                axios.post('/api/sales', formData).then(res => {
                    this.$router.push({ name: 'sales.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
