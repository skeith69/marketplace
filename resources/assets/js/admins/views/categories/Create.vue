<template>
    <div>
        <div class="card">
            <div class="card-header">
                Categories / Create New Category
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form ref="createNewAdminForm" role="form" method="POST" accept-charset="utf-8" v-on:submit.prevent="createNewAdmin">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="description" rows="3" maxlength="500" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-sm">Create New Category</button>
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
            description: ''
        };
    },

    mounted() {

    },

    methods: {
        createNewAdmin() {
            this.ifReady = false;
            
            axios.post('/api/categories', this.$data).then(res => {
                this.$router.push({ name: 'categories.index' });
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
