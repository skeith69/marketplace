<template>
    <div>
        <div class="card">
            <div class="card-header">
                Stores / Edit Store
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="editStore">
                        <div class="form-group">
                            <label for="image">Image <span class="text-info">*optional</span></label>
                            <input type="file" class="form-control-file" @change="onFileSelected" id="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" v-model="address" required rows="3" maxlength="500"></textarea>
                        </div>

                        <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewStore">Back</button>
                        <button type="button" class="btn btn-success btn-sm" @click.prevent.default="updateStore">Update Store</button>
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
                id: '',
                image: null,
                name: '',
                address: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/stores/' + this.$route.params.id).then(res => {
                    this.id      = res.data.store.id;
                    this.name    = res.data.store.name;
                    this.address = res.data.store.address;

                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            onFileSelected(event) {
                this.image = event.target.files[0];
            },
            viewStore() {
                this.$router.push({
                    name: 'stores.view',
                    params: { id: this.$route.params.id }
                });
            },
            updateStore() {
                this.ifReady = false;

                let formData = new FormData();
                
                if (this.image != null) {
                    formData.append('image', this.image);
                }

                formData.append('_method', 'PATCH');
                formData.append('name', this.name);
                formData.append('address', this.address);

                axios.post('/api/stores/' + this.$route.params.id, formData).then(res => {
                    this.$router.push({
                        name: 'stores.view',
                        params: { id: this.$route.params.id }
                    });
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
