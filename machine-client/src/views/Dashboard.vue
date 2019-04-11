<template>
    <div class="home">
        <div class="card">
            <div class="card-header">
                <h1 class="m-0" v-show="online">
                    Connected!
                </h1>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'home',
        data() {
            return {
                token: localStorage.getItem('token'),
                online: false,
            }
        },
        created() {
            this.report();
            setInterval(() => {
                this.report();
            }, 1000);
        },
        methods: {
            report() {

                const formData = new FormData();
                formData.append('token', this.token);

                fetch('http://localhost:8000/api/machine/report', {
                    method: 'POST',
                    body: formData,
                }).then(res => res.json()).then(() => {
                    this.online = true;
                });
            }
        }
    }
</script>
