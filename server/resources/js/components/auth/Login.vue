<template>
    <div class="row">
        <div class="col-lg-6 d-flex align-items-center justify-content-end">
            <i class="bx bx-bar-chart-alt"></i>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="m-0">
                        Login
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
    </div>

</template>

<style lang="scss" scoped>
    .bx-bar-chart-alt {
        font-size: 18rem;
    }

    .row {
        margin-top: 12rem;
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