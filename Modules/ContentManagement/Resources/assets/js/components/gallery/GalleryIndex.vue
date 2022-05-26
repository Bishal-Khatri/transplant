<template>
    <div class="row">
        <div class="col-md-12 col-sm-12  ">
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a href="" @click.prevent="$refs.createGallery.openDialog()">Create New</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-55" v-for="(gallery, index) in galleries" :key="index">
                            <div class="thumbnail">
                                <div class="image view view-first">
                                    <i class="fa fa-folder" style="font-size: 7rem"></i>
                                    <div class="mask">
                                        <p></p>
                                        <div class="tools tools-bottom">
                                            <a :href="'/admin/cms/storage/gallery/'+gallery.id"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="ml-2" @click.prevent="$refs.createGallery.openDialog(gallery)"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="ml-2 text-danger" @click.prevent="showDeleteModal(gallery.id)"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="caption">
                                    <p>{{ gallery.title || 'Not-Available'}}</p>
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

        <create-gallery ref="createGallery"/>
    </div>
</template>

<script>
    import {EventBus} from "../../app";
    import StorageService from "../../../services/StorageService";
    import CreateGallery from "./CreateGallery";
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "GalleryIndex",
        components: {
            CreateGallery,
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                delete_id: '',
                galleries: '',
            }
        },
        async mounted(){
            await this.getGalleries();
            EventBus.$on('galleryCreated', () => {
                this.getGalleries();
            });
        },
        methods: {
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
        },
    }
</script>

<style scoped>

</style>
