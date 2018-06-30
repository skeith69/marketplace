<template>
    <div>
        <div class="card">
            <div class="card-header">
                Permissions / View Permission
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="permission.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Display Name</label>
                            <input type="text" class="form-control" v-model="permission.display_name">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="permission.description"></textarea>
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewPermissions">Back</button>
                    <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="editPermission">Edit Permission</button>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeletePermissionModal">Delete Permission</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deletePermissionModal" tabindex="-1" role="dialog" aria-labelledby="deletePermissionTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Permission?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Permission?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deletePermission">Confirm Delete</button>
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
            permission: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/permissions/' + this.$route.params.id).then(res => {
                this.permission = res.data.permission;
                resolve();
            });
        });

        promise.then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        viewPermissions() {
            this.$router.push({
                name: 'permissions.index'
            });
        },
        editPermission() {
            this.$router.push({
                name: 'permissions.edit',
                params: { id: this.permission.id }
            });
        },
        openDeletePermissionModal() {
            $('#deletePermissionModal').modal('show');
        },
        deletePermission() {
            $('#deletePermissionModal').modal('hide');
            axios.delete('/api/permissions/' + this.$route.params.id).then(res => {
                this.$router.push({ name: 'permissions.index' });
            }).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>
