<template>
    <div>
        <div class="card">
            <div class="card-header">
                Products / Create New Product
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewProduct">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" @change="onFileSelected" id="image" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="category">Category</label>
                                <vue-select-component v-model="category" @input="selectCategory()" label="name" :options="categories" required></vue-select-component>
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
                image: null,
                categories: [],
                category: '',
                category_id: '',
                name: '',
                description: '',
                price: ''
            };
        },

        mounted() {
            let categoriesPromise = new Promise((resolve, reject) => {
                axios.get('/api/categories/retrieve-all-categories', {}).then(res => {
                    this.categories = res.data.categories;
                    resolve();
                }).catch(err => {
                    console.log(err);
                });
            });

            Promise.all([categoriesPromise]).then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            onFileSelected(event) {
                this.image = event.target.files[0];
            },
            createNewProduct() {
                this.ifReady = false;

                let formData = new FormData();

                if (this.image != null) {
                    formData.append('image', this.image);
                }

                formData.append('category_id', this.category_id);
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('price', this.price);

                axios.post('/api/products', formData, {
                    onUploadProgress: uploadEvent => {
                        if (this.image != null) {
                            console.log('Upload Progress: ' + Math.round((uploadEvent.loaded / uploadEvent.total) * 100) + '%');
                        }
                    }
                }).then(res => {
                    this.$router.push({ name: 'products.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            },
            selectCategory() {
                this.category_id = this.category.id;
            }
        }
    }
</script>
