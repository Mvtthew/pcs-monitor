<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">

            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-0">
                            Login form
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="login">Email</label>
                            <input type="text" class="form-control" id="login" v-model="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="password"/>
                        </div>
                        <button class="btn btn-primary" @click="userLogin">
                            Login
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    .container-fluid{
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        .row{
            width: 100%;
        }
    }
</style>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            userLogin() {

                const formData = new FormData();
                formData.append('username', this.email);
                formData.append('password', this.password);

                fetch('/api/login', {

                    method: 'POST',
                    body: formData,
                    credentials: 'include',
                    headers: {
                        'Accept': 'application/json',
                    },

                }).then(res => res.json()).then(data => {

                    if (data.token_type !== undefined) {

                        const token = data.token_type + " " + data.access_token;
                        localStorage.setItem('token', token);

                        document.location.pathname = '/user/dashboard';


                    } else {
                        console.log('bad');
                    }

                });

            }
        }
    }
</script>