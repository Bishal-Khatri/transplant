<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <h2>Images on {{ gallery.title }}</h2>
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <div class="btn-group" role="group">
                                <button id="filter-verification-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-upload mr-1"></i> Upload
                                </button>
                                <div class="dropdown-menu" aria-labelledby="filter-verification-status"
                                     x-placement="bottom-start"
                                     style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                    <a class="dropdown-item" @click.prevent="$refs.file.click()">Choose File</a>
                                    <a class="dropdown-item" @click.prevent="$refs.selectFile.openDialog()">From Storage</a>
                                </div>
                            </div>
                            <input type="file" ref="file" class="form-control-sm" id="additional-image" style="display: none; width:210px" @change.prevent="uploadMultipleImages" accept="image/png, image/jpeg" multiple>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div v-if="uploading_image" style="height: 150px;" class="mt-4 pt-4">
                        <p class="text-center mt-4 text-muted"> <i class="fa fa-spinner fa-spin mr-2"></i>Uploading Images...</p>
                    </div>
                    <div v-else>
                        <div class="col-md-12" v-if="!images.length">No images found</div>

                        <div class="col-md-55"  v-else v-for="(image, index) in images" :key="index">
                            <div class="thumbnail">
                                <div class="image view view-first">
                                    <img style="width: 100%; display: block;" :src="'/storage/'+image.image_original" alt="image">
                                    <div class="mask">
                                        <p></p>
                                        <div class="tools tools-bottom">
                                            <a href="#" @click.prevent="$refs.imagePreview.openDialog('/storage/'+image.image_original)"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="ml-2 text-danger" @click.prevent="showDeleteModal(image.id)"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="delete-image-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete Image</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteImage">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <image-preview ref="imagePreview"/>
        <select-file ref="selectFile" @filesSelected="uploadSelectedFiles" config="3"/>
    </div>
</template>

<script>
    import {EventBus} from "../../../app";
    import StorageService from "../../../../services/StorageService";
    import {Errors} from "../../../../../../../../resources/js/error";
    import ImagePreview from "../../../../../../../../resources/js/components/ImagePreview";
    import SelectFile from "../SelectFile";

    export default {
        name: "GalleryImages",
        props:['gallery_id'],
        components: {
            ImagePreview,
            SelectFile
        },
        computed:{
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                delete_id: '',
                uploading_image: false,

                images: '',
                gallery: '',
            }
        },
        async mounted(){
            await this.getImages();
            EventBus.$on('galleryCreated', () => {
                this.getImages();
            });
        },
        methods: {
            async getImages() {
                const response = await StorageService.getGalleryImages(this.gallery_id);
                this.gallery = response.data.data.gallery;
                this.images = response.data.data.gallery.images;
            },

            async uploadMultipleImages(event){
                this.uploading_image = true;
                const files = event.target.files;
                if (files.length){
                    for (let i=0; i < files.length; i++){
                        await this.uploadFile(files[i]);
                    }
                    this.getImages();
                }
                this.uploading_image = false;
            },

            async uploadSelectedFiles(files) {
                this.uploading_image = true;
                if (files.length){
                    for (let i=0; i < files.length; i++){
                        await this.uploadFile(files[i], 'link');
                    }
                    this.getImages();
                }
                this.uploading_image = false;
            },

            async uploadFile(file, fileType='formData'){
                const fd = new FormData();
                if (fileType === 'link'){
                    fd.append("image", file);
                } else{
                    fd.append("image", file, file.name);
                }
                fd.append("gallery_id", this.gallery_id);
                fd.append("file_type", fileType);
                try {
                    const response = await StorageService.addImageToGallery(fd);
                    if (response.data.error === false) {
                    }
                    Errors.Notification(response);
                }catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },

            showDeleteModal(image_id) {
                this.delete_id = image_id;
                $("#delete-image-dialog").modal('show');
            },

            async deleteImage() {
                this.delete_submitting = true;
                const response = await StorageService.removeImageFromGallery(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getImages();
                    $("#delete-image-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
        },
    }
</script>

<style scoped>

</style>
