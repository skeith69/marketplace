<template>
    <div>
        <div class="card">
            <div class="card-header">
                Admins / Create New Admin
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form ref="createNewAdminForm" role="form" method="POST" accept-charset="utf-8" v-on:submit.prevent="createNewAdmin">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" v-model="email" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" v-model="password" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" v-model="password_confirmation" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-sm">Create New Admin</button>
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
            ifReady: true,
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },

    mounted() {

    },

    methods: {
        createNewAdmin() {
            this.ifReady = false;
            
            axios.post('/api/admins', this.$data).then(res => {
                this.$router.push({ name: 'admins.index' });
            }).catch(err => {
                console.log(err);
            });
        }
    },

    computed: {
        // Add ES6 methods here that needs caching
    }
}
</script>
