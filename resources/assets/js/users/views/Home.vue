<template>
    <div>
        <div class="container mt-3">
            <div class="card-columns">
                <div class="card" v-for="store in stores">
                    <div v-if="store.image">
                        <img class="card-img-top" :src="'/storage/images/' + store.image" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ store.name }}</h5>
                        <p class="card-text">{{ store.address }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-sm btn-info" @click="viewProducts(store.id)">View Products</button>
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
                stores: []
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/stores').then(res => {
                    this.stores = res.data.data;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewProducts(storeId) {
                this.$router.push({
                    name: 'stores.products',
                    params: { id: storeId }
                });
            }
        }
    }
</script>
