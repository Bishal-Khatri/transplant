<template>
    <div>
        <div class="modal fade" id="create-gallery-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create/Update Gallery</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="form-group row">
                            <label>Gallery Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" v-model="title">
                            <span class="form-text text-danger" v-html="errors.get('title')"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="createGallery">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../../../app';
    import {Errors} from "../../../../../../../../resources/js/error";
    import StorageService from "../../../../services/StorageService";

    export default {
        name: "CreateGallery",
        props: {
        },
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,
            gallery_id: "",

            // form data
            title: "",
        }),
        computed:{
        },
        methods: {
            openDialog(gallery) {
                if (gallery){
                    this.title = gallery.title;
                    this.gallery_id = gallery.id;
                }
                $("#create-gallery-dialog").modal("show");
            },
            async createGallery() {
                this.submitting = true;
                try {
                    const formData = {
                        gallery_id: this.gallery_id,
                        title: this.title,
                    };

                    const response = await StorageService.createGallery(formData);
                    if (response.data.error === false) {
                        $("#create-gallery-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('galleryCreated');
                this.submitting = false;
            },

            clearForm() {
                this.title = this.gallery_id = '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
