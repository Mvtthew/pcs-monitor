<template>
    <div class="home">
        <p>
            Connected!
        </p>
        <p>
            Token: {{token}}
        </p>
        <button @click="report">
            Report
        </button>
    </div>
</template>

<script>

    export default {
        name: 'home',
        data() {
            return {
                token: localStorage.getItem('token')
            }
        },
        methods: {
            report() {

                formData = new FormData();
                formData.append('token', this.token);

                fetch('http://localhost:8000/api/machine/report', {
                    method: 'POST',
                    body:formData,
                }).then(res => res.json()).then(data => console.log(data));
            }
        }
    }
</script>
