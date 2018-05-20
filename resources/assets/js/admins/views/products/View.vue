<template>
    <div>
        <div class="card">
            <div class="card-header">
                Products / View Product
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="store">Store</label>
                                <input type="text" class="form-control" v-model="product.store.name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" v-model="product.category.name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" v-model="product.name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="price">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">PHP</div>
                                    </div>
                                    <input type="number" class="form-control" v-model="product.price">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Desciption</label>
                            <textarea class="form-control" v-model="product.description" rows="3" maxlength="500"></textarea>
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewProducts">Back</button>
                    <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="editProduct">Edit Product</button>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteProductModal">Delete Product</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Product?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteProduct">Confirm Delete</button>
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
            product: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/products/' + this.$route.params.id).then(res => {
                this.product = res.data.product;
                resolve();
            });
        });

        promise.then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        viewProducts() {
            this.$router.push({
                name: 'products.index'
            });
        },
        editProduct() {
            this.$router.push({
                name: 'products.edit',
                params: { id: this.product.id }
            });
        },
        openDeleteProductModal() {
            $('#deleteProductModal').modal('show');
        },
        deleteProduct() {
            $('#deleteProductModal').modal('hide');

            axios.delete('/api/products/' + this.$route.params.id).then(res => {
                this.$router.push({ name: 'products.index' });
            }).catch(err => {
                console.log(err);
            });
        }
    },

    computed: {
        // Add ES6 methods here that needs caching
    }
}
</script>
