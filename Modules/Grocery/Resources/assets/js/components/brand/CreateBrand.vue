<template>
    <div>
        <div class="modal fade" id="create-brand-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Create New Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-filled">
                                    <div class="panel-heading">
                                        Create New Brand.
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-2 col-form-label">Main Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="main-image" class="form-control-file mb-1" @change.prevent="handelImage" name="image" accept="image/png, image/jpeg" ref="file">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-2 col-form-label">Brand Name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" v-model="brand_name" class="form-control" id="item_name" placeholder="Brand name *" required>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveBrand" >Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    import {EventBus} from '../../app';

    export default {
        name: "CreateBrand",
        data: () => ({
            id: "",
            main_image: "",
            brand_name: "",
        }),
        methods: {
            openDialog(value){
                this.clearForm();
               if (value){
                   this.id = value.id;
                   this.brand_name = value.name;
               }
                $("#create-brand-dialog").modal("show");
            },
            handelImage(event){
                this.main_image= event.target.files[0];
            },
            async saveBrand() {
                try {
                    let formData = new FormData();

                    if (this.id){
                        formData.append("id", this.id);
                    }
                    formData.append("brand_name", this.brand_name);
                    if(this.main_image){
                        formData.append("main_image", this.main_image, this.main_image.name);
                    }
                    const response = await InventoryService.createBrand(formData);
                    if (response.data.error === false) {
                        this.dialog = false;
                        this.clearForm();
                        // Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    // this.errors.record(error.response.data);
                    // Errors.Notification(error.response);
                }
                EventBus.$emit('brandAdded');
                $("#create-brand-dialog").modal("hide");
            },

            clearForm() {
                // this.errors.clear();
                this.$refs.file.type='text';
                this.$refs.file.type='file';
                this.brand_name = this.id = this.main_image = '';
            },

        },
    }
</script>

<style scoped>

</style>
