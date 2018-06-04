<template>
    <div>
        <div class="card">
            <div class="card-header">
                Roles / Assign Permissions
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" v-model="role.name">
                                </div>
                                <div class="form-group">
                                    <label for="display_name">Display Name</label>
                                    <input type="text" class="form-control" v-model="role.display_name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" v-model="role.description">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li v-for="(permission, index) in permissions" class="list-group-item" :key="index">
                                        <div class="row clearfix">
                                            <div class="col float-left">
                                                {{ permission.display_name }}
                                            </div>
                                            <div class="col float-right">
                                                <div v-show="permission.requesting">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                                <div v-show="! permission.requesting">
                                                    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                                        <label class="btn btn-outline-danger btn-sm" @click="togglePermission(index)" :class="{ active: ! permission.isAssigned }">
                                                            <input type="radio" autocomplete="off"> Unassigned
                                                        </label>
                                                        <label class="btn btn-outline-success btn-sm" @click="togglePermission(index)" :class="{ active: permission.isAssigned }">
                                                            <input type="radio" autocomplete="off"> Assigned
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </fieldset>

                    <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewRoles">Back</button>
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
                permissions: '',
                assignedPermissions: '',
                role: '',
                test: false
            };
        },

        mounted() {
            let retrievePermissionsPromise = new Promise((resolve, reject) => {
                axios.get('/api/permissions/retrieve-all-permissions').then(res => {
                    this.permissions = res.data.permissions;
                    resolve();
                }).catch(err => {
                    console.log(err);
                });
            });

            let retrieveAssignedPermissions = new Promise((resolve, reject) => {
                axios.get('/api/roles/' + this.$route.params.id + '/assigned-permissions').then(res => {
                    this.assignedPermissions = res.data.assignedPermissions;
                    resolve();
                }).catch(err => {
                    console.log(err);
                });
            });

            let retrieveRolePromise = new Promise((resolve, reject) => {
                axios.get('/api/roles/' + this.$route.params.id).then(res => {
                    this.role = res.data.role;
                    resolve();
                }).catch(err => {
                    console.log(err);
                });
            });

            Promise.all([retrievePermissionsPromise, retrieveAssignedPermissions, retrieveRolePromise]).then(() => {
                this.assignedPermissions.forEach(assignedPermission => {
                    this.permissions.find(permission => {
                        if (permission.id == assignedPermission.id) {
                            permission.isAssigned = true;
                        } else {
                            permission.isAssigned = false;
                        }

                        permission.requesting = false;
                    });
                });

                this.ifReady = true;
            });
        },

        methods: {
            viewRoles() {
                this.$router.push({
                    name: 'roles.index'
                });
            },
            isRequesting(index, value) {
                this.permissions[index].display_name = this.permissions[index].display_name + ' ';
                this.permissions[index].requesting = value;
                this.permissions[index].display_name.trim();
            },
            togglePermission(index) {
                this.isRequesting(index, true);

                let data = {
                    role_id: this.$route.params.id,
                    permission_id: this.permissions[index].id
                };

                axios.post('/api/roles/toggle-permission', data).then(res => {
                    console.log(res.data);
                    this.isRequesting(index, false);
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style>
.row .col-md-6:first-child {
    border-right: 1px solid rgba(0, 0, 0, 0.125);
}
</style>
