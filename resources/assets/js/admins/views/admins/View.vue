<template>
    <div>
        <div class="card">
            <div class="card-header">
                Admins / View Admin
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="admin.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" v-model="admin.email">
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewAdmins">Back</button>
                    <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="editAdmin">Edit Admin</button>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteAdminModal">Delete Admin</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Admin?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Admin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteAdmin">Confirm Delete</button>
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
                admin: ''
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/admins/' + this.$route.params.id).then(res => {
                    this.admin = res.data.admin;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewAdmins() {
                this.$router.push({
                    name: 'admins.index'
                });
            },
            editAdmin() {
                this.$router.push({
                    name: 'admins.edit',
                    params: { id: this.admin.id }
                });
            },
            openDeleteAdminModal() {
                $('#deleteAdminModal').modal('show');
            },
            deleteAdmin() {
                $('#deleteAdminModal').modal('hide');
                axios.delete('/api/admins/' + this.$route.params.id).then(res => {
                    this.$router.push({ name: 'admins.index' });
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
