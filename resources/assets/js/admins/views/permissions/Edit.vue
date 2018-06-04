<template>
    <div>
        <div class="card">
            <div class="card-header">
                Permissions / Edit Permission
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form method="POST" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Display Name</label>
                                <input type="text" class="form-control" v-model="display_name" autocomplete="off" minlength="2" maxlength="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Desciption</label>
                            <textarea class="form-control" v-model="description" rows="3" maxlength="500" required></textarea>
                        </div>

                        <button type="button" class="btn btn-info btn-sm" @click.prevent.default="viewPermission">Back</button>
                        <button type="button" class="btn btn-success btn-sm" @click.prevent.default="updatePermission">Update Permission</button>
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
            display_name: '',
            description: ''
        };
    },

    mounted() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/permissions/' + this.$route.params.id).then(res => {
                this.id           = res.data.permission.id;
                this.name         = res.data.permission.name;
                this.display_name = res.data.permission.display_name;
                this.description  = res.data.permission.description;

                resolve();
            });
        });

        promise.then(() => {
            this.ifReady = true;
        });
    },

    methods: {
        viewPermission() {
            this.$router.push({
                name: 'permissions.view',
                params: { id: this.$route.params.id }
            });
        },
        updatePermission() {
            this.ifReady = false;

            axios.patch('/api/permissions/' + this.$route.params.id, this.$data).then(res => {
                this.$router.push({
                    name: 'permissions.view',
                    params: { id: this.$route.params.id }
                });
            }).catch(err => {
                console.log(err);
            });
        }
    }
}
</script>
