<template>
    <div>
        <div class="card">
            <div class="card-header">
                Stores / Create New Store
            </div>
            <div class="card-body">
                <div v-if="ifReady">
                    <form v-on:submit.prevent="createNewAdmin">
                        <div class="form-group">
                            <label for="image">Image <span class="text-info">*optional</span></label>
                            <input type="file" class="form-control-file" @change="onFileSelected" id="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" v-model="address" rows="3" maxlength="500" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-sm">Create New Store</button>
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
                image: null,
                name: '',
                address: ''
            };
        },

        methods: {
            onFileSelected(event) {
                this.image = event.target.files[0];
            },
            createNewAdmin() {
                this.ifReady = false;

                let formData = new FormData();
                
                if (this.image != null) {
                    formData.append('image', this.image);
                }

                formData.append('name', this.name);
                formData.append('address', this.address);
                
                axios.post('/api/stores', formData).then(res => {
                    this.$router.push({ name: 'stores.index' });
                }).catch(err => {
                    this.ifReady = true;
                    console.log(err);
                });
            }
        }
    }
</script>
