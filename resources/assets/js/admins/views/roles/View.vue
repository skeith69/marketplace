<template>
    <div>
        <div class="card">
            <div class="card-header">
                Roles / View Role
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="role.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Display Name</label>
                            <input type="text" class="form-control" v-model="role.display_name">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="role.description"></textarea>
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewRoles">Back</button>
                    <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="editRole">Edit Role</button>
                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteRoleModal">Delete Role</button>
                </div>
                <div v-else>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Role?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Role?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteRole">Confirm Delete</button>
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
            role: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/roles/' + this.$route.params.id).then(res => {
                this.role = res.data.role;
                resolve();
            });
        });

        promise.then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        viewRoles() {
            this.$router.push({
                name: 'roles.index'
            });
        },
        editRole() {
            this.$router.push({
                name: 'roles.edit',
                params: { id: this.role.id }
            });
        },
        openDeleteRoleModal() {
            $('#deleteRoleModal').modal('show');
        },
        deleteRole() {
            $('#deleteRoleModal').modal('hide');
            axios.delete('/api/roles/' + this.$route.params.id).then(res => {
                this.$router.push({ name: 'roles.index' });
            }).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>
