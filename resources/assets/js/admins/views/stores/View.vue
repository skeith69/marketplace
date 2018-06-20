<template>
    <div>
        <div class="card">
            <div class="card-header">
                Stores / View Store
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="store.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Address</label>
                            <textarea class="form-control" v-model="store.address" rows="3"></textarea>
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
            store: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/stores/' + this.$route.params.id).then(res => {
                this.store = res.data.store;
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
