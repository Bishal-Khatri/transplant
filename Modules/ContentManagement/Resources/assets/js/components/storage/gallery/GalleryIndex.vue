<template>
    <div class="row">
        <div class="col-md-12 col-sm-12  ">

            <!--// new gallery-->
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content" style="border: none;">
                                <div class="file-manager">
                                    <button class="btn btn-accent btn-block btn-sm" @click.prevent="$refs.createGallery.openDialog()">Create New Gallery</button>
                                    <div class="hr-line-dashed"></div>
                                    <h5>Galleries</h5>
                                    <ul class="folder-list" style="padding: 0">
                                        <li v-for="(gallery, index) in galleries" :key="index" :class="selected_gallery.id === gallery.id ? 'active' : 'apple'">
                                            <div class="d-flex">
                                                <a href="" @click.prevent="selectGallery(gallery)">
                                                    <i class="fa fa-folder"></i>
                                                    {{ gallery.title || 'Not-Available'}}
                                                </a>
                                                <a href="#" class="ml-3" @click.prevent="$refs.createGallery.openDialog(gallery)"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="ml-1" @click.prevent="showImageDeleteModal(gallery.id)"><i class="fa fa-trash text-danger"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 animated fadeInRight">
                        <div class="row mt-3">
                            <div class="col-md-6 col-lg-6">
                                <h5>Showing images in <a href="#">{{ selected_gallery.title }}</a></h5>
                            </div>
                            <div class="col-md-4 col-lg-4 text-right" style="padding-right:0">
                                <div class="btn-group" role="group">
                                    <button id="filter-verification-status" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <hr>

                        <div v-if="uploading_image" style="height: 150px;" class="mt-4 pt-4">
                            <p class="text-center mt-4 text-muted"> <i class="fa fa-spinner fa-spin mr-2"></i>Uploading Images...</p>
                        </div>
                        <div class="row" v-else>
                            <div class="col-lg-12">
                                <div v-if="loading" class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-2x"></i>
                                </div>
                                <div v-else-if="!images.length">No images found in {{ selected_gallery.title }}.</div>
                                <div class="file-box" v-else v-for="(image, index) in images" :key="index">
                                    <div class="file">
                                        <a href="#" >
                                            <span class="corner"></span>

                                            <div class="image">
                                                <a href="" @click.prevent="$refs.imagePreview.openDialog('/storage/'+image.image_original)">
                                                    <img alt="image" class="img-responsive" :src="'/storage/'+image.image_original">
                                                </a>
                                            </div>
                                            <div class="file-name" style="overflow: hidden;" :title="image.image_original || 'Not-Available'">
                                                {{ image.image_original }}
                                                <br>
                                                <small>Added: {{ image.created_at }} <a class="float-right" href="" @click.prevent="showImageDeleteModal(image.id)"><i class="fa fa-trash text-danger"></i></a></small>
                                            </div>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-gallery-dialog" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteGallery">Confirm</button>
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

        <create-gallery ref="createGallery"/>
        <image-preview ref="imagePreview"/>
        <select-file ref="selectFile" name="add-image-gallery" @filesSelected="uploadSelectedFiles" config="3"/>
    </div>
</template>

<script>
    import {EventBus} from "../../../app";
    import StorageService from "../../../../services/StorageService";
    import CreateGallery from "./CreateGallery";
    import {Errors} from "../../../../../../../../resources/js/error";
    import ImagePreview from "../../../../../../../../resources/js/components/ImagePreview";
    import SelectFile from "../SelectFile";

    export default {
        name: "GalleryIndex",
        components: {
            CreateGallery,
            ImagePreview,
            SelectFile
        },
        data(){
            return{
                errors: new Errors(),
                loading: true,
                delete_submitting: false,
                delete_id: '',
                galleries: '',

                // gallery images
                delete_image_id: '',
                uploading_image: false,

                selected_gallery: '',
                images: '',
            }
        },
        async mounted(){
            await this.getGalleries();
            this.selected_gallery = this.galleries[0];
            await this.getImages();
            EventBus.$on('galleryCreated', () => {
                this.getGalleries();
            });
        },
        methods: {
            selectGallery(gallery){
                this.selected_gallery = gallery;
                this.getImages();
            },
            async getGalleries() {
                const response = await StorageService.getGalleries();
                this.galleries = response.data.data.galleries;
            },

            showDeleteModal(image_id) {
                this.delete_id = image_id;
                $("#delete-gallery-dialog").modal('show');
            },

            async deleteGallery() {
                this.delete_submitting = true;
                const response = await StorageService.removeGallery(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getGalleries();
                    $("#delete-gallery-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },


            // gallery images
            async getImages() {
                this.loading = true;
                const response = await StorageService.getGalleryImages(this.selected_gallery.id);
                this.selected_gallery = response.data.data.gallery;
                this.images = response.data.data.gallery.images;
                this.loading = false;
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
                fd.append("gallery_id", this.selected_gallery.id);
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

            showImageDeleteModal(image_id) {
                this.delete_image_id = image_id;
                $("#delete-image-dialog").modal('show');
            },

            async deleteImage() {
                this.delete_submitting = true;
                const response = await StorageService.removeImageFromGallery(this.delete_image_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getImages();
                    $("#delete-image-dialog").modal('hide');
                }
                this.delete_image_id = '';
                this.delete_submitting = false;
            },
        },
    }
</script>

<style scoped>
    body{margin-top:20px;
        background:#eee;
    }

    .file-box {
        float: left;
        width: 220px;
    }
    .file-manager h5 {
        text-transform: uppercase;
    }
    .file-manager {
        list-style: none outside none;
        margin: 0;
        padding: 0;
    }
    .folder-list li a {
        color: #666666;
        display: block;
        padding: 5px 0;
    }
    .folder-list li {
        border-bottom: 1px solid #e7eaec;
        display: block;
    }
    .folder-list li i {
        margin-right: 8px;
        color: #3d4d5d;
    }
    .category-list li a {
        color: #666666;
        display: block;
        padding: 5px 0;
    }
    .category-list li {
        display: block;
    }
    .category-list li i {
        margin-right: 8px;
        color: #3d4d5d;
    }
    .category-list li a .text-navy {
        color: #1ab394;
    }
    .category-list li a .text-primary {
        color: #1c84c6;
    }
    .category-list li a .text-info {
        color: #23c6c8;
    }
    .category-list li a .text-danger {
        color: #EF5352;
    }
    .category-list li a .text-warning {
        color: #F8AC59;
    }
    .file-manager h5.tag-title {
        margin-top: 20px;
    }
    .tag-list li {
        float: left;
    }
    .tag-list li a {
        font-size: 10px;
        background-color: #f3f3f4;
        padding: 5px 12px;
        color: inherit;
        border-radius: 2px;
        border: 1px solid #e7eaec;
        margin-right: 5px;
        margin-top: 5px;
        display: block;
    }
    .file {
        border: 1px solid #e7eaec;
        padding: 0;
        background-color: #ffffff;
        position: relative;
        margin-bottom: 20px;
        margin-right: 20px;
    }
    .file-manager .hr-line-dashed {
        margin: 15px 0;
    }
    .file .icon,
    .file .image {
        height: 100px;
        overflow: hidden;
    }
    .file .icon {
        padding: 15px 10px;
        text-align: center;
    }
    .file-control {
        color: inherit;
        font-size: 11px;
        margin-right: 10px;
    }
    .file-control.active {
        text-decoration: underline;
    }
    .file .icon i {
        font-size: 70px;
        color: #dadada;
    }
    .file .file-name {
        padding: 10px;
        background-color: #f8f8f8;
        border-top: 1px solid #e7eaec;
    }
    .file-name small {
        color: #676a6c;
    }
    ul.tag-list li {
        list-style: none;
    }
    .corner {
        position: absolute;
        display: inline-block;
        width: 0;
        height: 0;
        line-height: 0;
        border: 0.6em solid transparent;
        border-right: 0.6em solid #f1f1f1;
        border-bottom: 0.6em solid #f1f1f1;
        right: 0em;
        bottom: 0em;
    }
    a.compose-mail {
        padding: 8px 10px;
    }
    .mail-search {
        max-width: 300px;
    }
    .ibox {
        clear: both;
        margin-bottom: 25px;
        margin-top: 0;
        padding: 0;
    }
    .ibox.collapsed .ibox-content {
        display: none;
    }
    .ibox.collapsed .fa.fa-chevron-up:before {
        content: "\f078";
    }
    .ibox.collapsed .fa.fa-chevron-down:before {
        content: "\f077";
    }
    .ibox:after,
    .ibox:before {
        display: table;
    }
    .ibox-title {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        background-color: #ffffff;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 3px 0 0;
        color: inherit;
        margin-bottom: 0;
        padding: 14px 15px 7px;
        min-height: 48px;
    }
    .ibox-content {
        background-color: #ffffff;
        color: inherit;
        padding: 15px 20px 20px 20px;
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0;
    }
    .ibox-footer {
        color: inherit;
        border-top: 1px solid #e7eaec;
        font-size: 90%;
        background: #ffffff;
        padding: 10px 15px;
    }
    a:hover{
        text-decoration:none;
    }

    .active{
        border-right: 5px solid #1ABB9C;
        background: rgba(255,255,255,0.05);
    }
</style>
