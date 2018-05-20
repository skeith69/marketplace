<template>
    <div>
        <div class="card">
            <div class="card-header">
                Products / Create New Product
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form ref="createNewProductForm" role="form" method="POST" accept-charset="utf-8" v-on:submit.prevent="createNewProduct">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="store">Store</label>
                                <vue-select-component v-model="store" @input="selectStore()" label="name" :options="stores"></vue-select-component>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="category">Category</label>
                                <vue-select-component v-model="category" @input="selectCategory()" label="name" :options="categories"></vue-select-component>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="price">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">PHP</div>
                                    </div>
                                    <input type="number" class="form-control" v-model="price" autocomplete="off" min="1" max="99999999" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Desciption</label>
                            <textarea class="form-control" v-model="description" rows="3" maxlength="500" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-sm">Create New Product</button>
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
            ifReady: false,
            stores: [],
            categories: [],
            store: '',
            category: '',
            store_id: '',
            category_id: '',
            name: '',
            description: '',
            price: ''
        };
    },

    mounted() {
        let storesPromise = new Promise((resolve, reject) => {
            axios.get('/api/stores/retrieve-all-stores', {}).then(res => {
                this.stores = res.data.stores;
                resolve();
            }).catch(err => {
                console.log(err);
            });
        });

        let categoriesPromise = new Promise((resolve, reject) => {
            axios.get('/api/categories/retrieve-all-categories', {}).then(res => {
                this.categories = res.data.categories;
                resolve();
            }).catch(err => {
                console.log(err);
            });
        });

        Promise.all([storesPromise, categoriesPromise]).then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        createNewProduct() {
            this.ifReady = false;

            let data = {
                store_id: this.store_id,
                category_id: this.category_id,
                name: this.name,
                description: this.description,
                price: this.price
            };

            axios.post('/api/products', data).then(res => {
                this.$router.push({ name: 'products.index' });
            }).catch(err => {
                console.log(err);
            });
        },
        selectStore() {
            this.store_id = this.store.id;
        },
        selectCategory() {
            this.category_id = this.category.id;
        }
    },

    computed: {
        // Add ES6 methods here that needs caching
    }
}
</script>
