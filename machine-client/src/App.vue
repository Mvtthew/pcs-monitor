<template>
    <div id="app">
        <router-view/>
        <div class="footer text-center text-muted">
            &copy; Mvtthew 2019
        </div>
    </div>
</template>

<style lang="scss">
    .card-header {
        background-color: #f1f1f1;
    }

    .card-body {
        height: calc(100vh - 40px - 73px);
    }
    .footer{
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: #f1f1f1;
        padding: 0.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
    :not(input):not(textarea),
    :not(input):not(textarea)::after,
    :not(input):not(textarea)::before {
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }
</style>
