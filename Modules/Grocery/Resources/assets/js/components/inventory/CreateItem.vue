<template>
    <div>
        <div class="modal fade" id="create-item-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                                        Create New Item.
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-2 col-form-label">Main Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="main-image" class="form-control-file mb-1" @change.prevent="handelImage" name="image" accept="image/png, image/jpeg">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-2 col-form-label">Item name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" v-model="item_name" class="form-control" id="item_name" placeholder="Item name *" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="sku" class="col-sm-2 col-form-label">
                                                    SKU
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" v-model="sku" class="form-control" id="sku" placeholder="SKU *" >
                                                </div>
                                            </div>
                                            <!--<div class="form-group row">-->
                                            <!--<label for="brand" class="col-sm-2 col-form-label">-->
                                            <!--Brand-->
                                            <!--<small class="text-muted">Optional</small>-->
                                            <!--</label>-->
                                            <!--<div class="col-sm-10">-->
                                            <!--<input type="text" v-model="brand" class="form-control" id="brand" placeholder="Brand Name" >-->
                                            <!--</div>-->
                                            <!--</div>-->
                                            <!--<v-col cols="10" sm="8">-->
                                            <!--<v-autocomplete v-model="category" :items="categories" item-text="name" item-value="id" label="Category" required></v-autocomplete>-->
                                            <!--</v-col>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveItem" >Save</button>
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
        name: "CreateItem",
        props: {
        },
        components: {
        },
        data: () => ({
            item_name: "",
            id: "",
            sku: "",
            category: "",
            brand: "",
            item_image: "",
        }),
        computed:{
        },
        methods: {
            openDialog(value="") {
                console.log(value)
                if (value !== ""){
                    this.id = value.id;
                    this.item_name = value.name;
                    this.sku = value.sku;
                    this.category = value.category_id;
                    this.brand = value.brand;
                }
                $("#create-item-dialog").modal("show");
            },
            async saveItem() {
                try {
                    let formData = new FormData();

                    formData.append("id", this.id);
                    formData.append("item_name", this.item_name);
                    formData.append("sku", this.sku);
                    if(this.item_image){
                        formData.append("main_image", this.item_image, this.item_image.name);
                    }

                    const response = await InventoryService.createItem(formData);
                    if (response.data.error === false) {
                        $("#create-item-dialog").modal("hide");
                        this.clearForm();
                        // Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    // this.errors.record(error.response.data);
                    // Errors.Notification(error.response);
                }
                EventBus.$emit('itemAdded');
            },

            handelImage(event){
                this.item_image= event.target.files[0];
            },
            clearForm() {
                this.id = this.item_name = this.sku = this.category = this.brand = '';
            },
        },
    };
</script>

<style >
</style>
