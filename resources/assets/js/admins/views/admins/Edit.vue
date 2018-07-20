<template>
    <div>
        <div class="card">
            <div class="card-header">
                Admins / Edit Admin
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="editAdmin">
                        <div class="form-group">
                            <label for="store">Store <span class="text-info">*optional if tenant</span></label>
                            <vue-select-component v-model="store" @input="selectStore()" label="name" :options="stores" required></vue-select-component>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" v-model="email" disabled>
                        </div>

                        <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewAdmin">Back</button>
                        <button type="button" class="btn btn-success btn-sm" @click.prevent.default="updateAdmin">Update Admin</button>
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
                store: null,
                id: '',
                store_id: null,
                name: '',
                email: ''
            };
        },

        mounted() {
            let retrieveStoresPromise = new Promise((resolve, reject) => {
                axios.get('/api/stores/retrieve-all-stores', {}).then(res => {
                    this.stores = res.data.stores;
                    resolve();
                }).catch(err => {
                    console.log(err);
                });
            });

            let retrieveAdminPromise = new Promise((resolve, reject) => {
                axios.get('/api/admins/' + this.$route.params.id).then(res => {
                    this.id    = res.data.admin.id;
                    this.name  = res.data.admin.name;
                    this.email = res.data.admin.email;

                    resolve();
                });
            });

            Promise.all([retrieveStoresPromise, retrieveAdminPromise]).then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            selectStore() {
                this.store_id = this.store.id;
            },
            viewAdmin() {
                this.$router.push({
                    name: 'admins.view',
                    params: { id: this.$route.params.id }
                });
            },
            updateAdmin() {
                this.ifReady = false;

                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('store_id', this.store_id);
                formData.append('name', this.name);
                formData.append('email', this.email);

                axios.post('/api/admins/' + this.$route.params.id, formData).then(res => {
                    this.$router.push({
                        name: 'admins.view',
                        params: { id: this.$route.params.id }
                    });
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
