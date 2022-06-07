<template>
    <div class="row">
        <div class="col-md-12 fm-wrapper">
            <file-manager v-bind:settings="settings"></file-manager>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StorageIndex",
        data(){
            return{
                settings: {
                    windowsConfig: 1
                },
            }
        },
    }
</script>

<style scoped>
.fm-wrapper{
    min-height: 70vh;
}
</style>
