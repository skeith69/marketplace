<template>
    <div>
        <div class="container mt-3">
            <div class="card-columns">
                <div class="card" v-for="product in products">
                    <div v-if="product.image">
                        <img class="card-img-top" :src="'/storage/images/' + product.image" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ product.name }}</h5>
                        <p class="card-text">{{ product.description }}</p>
                        <footer class="blockquote-footer"><cite title="Source Title">{{ product.store.name }}</cite></footer>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="text-success">PHP {{ product.price }}</span>
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
                products: []
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/stores/' + this.$route.params.id + '/products').then(res => {
                    this.products = res.data.products.data;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewStores() {
                this.$router.push({
                    name: 'home'
                });
            },
        }
    }
</script>
