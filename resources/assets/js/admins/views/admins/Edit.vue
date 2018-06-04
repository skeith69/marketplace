<template>
    <div>
        <div class="card">
            <div class="card-header">
                Admins / Edit Admin
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form ref="editAdminForm" role="form" method="POST" accept-charset="utf-8" v-on:submit.prevent="editAdmin">
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
            id: '',
            name: '',
            email: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/admins/' + this.$route.params.id).then(res => {
                this.id    = res.data.admin.id;
                this.name  = res.data.admin.name;
                this.email = res.data.admin.email;

                resolve();
            });
        });

        promise.then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        viewAdmin() {
            this.$router.push({
                name: 'admins.view',
                params: { id: this.$route.params.id }
            });
        },
        updateAdmin() {
            this.ifReady = false;

            axios.patch('/api/admins/' + this.$route.params.id, this.$data).then(res => {
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
