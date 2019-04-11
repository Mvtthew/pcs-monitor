<template>
    <div class="user-dashboard">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="m-0">
                            My machines
                        </h1>
                    </div>
                    <div class="card-body">
                        <div class="card p-2 mb-2" v-for="machine in machines">
                            <h4>
                                <i class="bx bx-laptop"></i>
                                {{machine.name}}
                            </h4>
                            <p class="m-0" v-if="machine.online">
                                ONLINE
                            </p>
                            <p class="m-0" v-if="!machine.online">
                                OFFLINE
                            </p>
                        </div>
                        <div class="card p-2 mt-5">
                            <div>
                                <h3>
                                    <i class="bx bx-plus"></i>
                                    Add new machine
                                </h3>
                                <h5>
                                    Your machine password:
                                    <span class="machine-password" v-bind:class="{'show': passwordShown}">
                                        {{user.machine_password}}
                                    </span>
                                    <button class="bx bx-show toggle-machine-password" title="Show machine password" @click="togglePassword"></button>
                                </h5>
                                <button class="btn btn-primary btn-sm" @click="renewMachinePass">
                                    Renew machine pass
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .machine-password {
        filter: blur(5px);
        &.show {
            filter: blur(0);
        }
    }
    .toggle-machine-password {
        cursor: pointer;
        border: unset;
        background: unset;
    }
</style>

<script>
    export default {
        data() {
            return {
                token: localStorage.getItem('token'),
                passwordShown: false,
                user: {
                    machine_password: '',
                },
                machines: [{}],
            }
        },
        created() {
            this.getUser();
            this.getMachines();

            setInterval(() => {
                this.getUser();
                this.getMachines();
            }, 5000);
        },
        methods: {
            getUser() {
                fetch('/api/user', {
                    headers: {
                        'Authorization': this.token
                    }
                }).then(res => res.json()).then(data => this.user = data);
            },
            getMachines() {
                fetch('/api/user/machines', {
                    headers: {
                        'Authorization': this.token
                    }
                }).then(res => res.json()).then(data => this.machines = data);
            },
            togglePassword() {
                this.passwordShown = !this.passwordShown;
            },
            renewMachinePass() {
                fetch('/api/user/renewPassword', {
                    method: 'post',
                    headers: {
                        'Authorization': this.token
                    }
                }).then(res => res.json()).then(() => {
                    this.getUser();
                });
            }
        }
    }
</script>