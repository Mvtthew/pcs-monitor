<template>
    <div class="register">
        <div class="card">
            <div class="card-header">
                <h1 class="m-0">
                    Add this machine
                </h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name of this machine</label>
                    <input type="text" id="name" class="form-control" placeholder="eg. Server_01a" v-model="name"/>
                </div>
                <div class="form-group">
                    <label for="desc">Short description</label>
                    <textarea id="desc" class="form-control" placeholder="eg. Server_01a" v-model="desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="password">User machine password</label>
                    <input type="password" id="password" class="form-control" placeholder="********" v-model="key"/>
                </div>
                <button class="btn btn-success mt-3" @click="register">
                    Register machine
                </button>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    textarea {
        resize: none;
        height: 8rem;
    }
</style>

<script>
    export default {
        data() {
            return {
                name: '',
                desc: '',
                key: '',
            }
        },
        created() {
            this.checkRegistered();
        },
        methods: {
            checkRegistered() {

                const token = localStorage.getItem('token');
                if (token !== undefined) {
                    this.$router.push('/dashboard');
                }

            },
            register() {

                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('desc', this.desc);
                formData.append('key', this.key);

                fetch('http://localhost:8000/api/machine/new', {

                    method: 'POST',
                    body: formData,
                    mode: "cors"

                }).then(res => res.json()).then(data => {
                    localStorage.setItem('token', data.machine_token);
                    this.checkRegistered();
                });

            }
        }
    }
</script>