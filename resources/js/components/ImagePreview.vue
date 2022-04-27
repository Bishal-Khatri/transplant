<template>
    <div>
        <!--// image-preview-->
        <div class="modal fade" id="view-image" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-0">
                    <div class="modal-body p-0">
                        <img src="" alt="" id="view-image-url" style="width: 100%; border-radius: 5px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ImagePreview",
        methods:{
            openDialog(url) {
                $("#view-image-url").attr('src',url);
                $("#view-image").modal('show')
            },
        }
    }
</script>

<style scoped>

</style>
