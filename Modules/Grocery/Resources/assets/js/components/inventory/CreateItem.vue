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
                                                <label for="item_name" class="col-sm-3 col-form-label">Main Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="main-image" class="form-control-file mb-1" @change.prevent="handelImage" name="image" accept="image/png, image/jpeg">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group row">
                                                <label for="item_name" class="col-sm-3 col-form-label">Item name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="item_name" class="form-control" id="item_name" placeholder="Item name *" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('item_name')"></span>
                                                </div>
                                            </div>
                                            <!--<div class="form-group row">-->
                                                <!--<label for="sku" class="col-sm-3 col-form-label">-->
                                                    <!--SKU-->
                                                <!--</label>-->
                                                <!--<div class="col-sm-9">-->
                                                    <!--<input type="text" v-model="sku" class="form-control" id="sku" placeholder="SKU *" >-->
                                                    <!--<span class="form-text small text-danger" v-html="errors.get('sku')"></span>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                            <div class="form-group row">
                                                <label for="unit_size" class="col-sm-3 col-form-label">
                                                    Unit size
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="unit_size" class="form-control" id="unit_size" placeholder="Unit size of item *" >
                                                    <span class="form-text small text-danger" v-html="errors.get('unit_size')"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <label> <input type="checkbox" v-model="continue_editing"> Continue editing </label>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveItem" v-else>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    import {EventBus} from '../../app';
    import {Errors} from "../../../../../../../resources/js/error";
    export default {
        name: "CreateItem",
        props: {
        },
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,

            item_name: "",
            id: "",
            sku: "",
            category: "",
            item_image: "",
            unit_size: "",
            continue_editing: false,
        }),
        computed:{
        },
        methods: {
            openDialog(value="") {
                if (value !== ""){
                    this.id = value.id;
                    this.item_name = value.name;
                    this.sku = value.sku;
                    this.unit_size = value.unit_size;
                }
                $("#create-item-dialog").modal("show");
            },
            async saveItem() {
                this.submitting = true;
                try {
                    let formData = new FormData();

                    formData.append("id", this.id);
                    formData.append("item_name", this.item_name);
                    formData.append("sku", this.sku);
                    formData.append("unit_size", this.unit_size);
                    if(this.item_image){
                        formData.append("main_image", this.item_image, this.item_image.name);
                    }

                    const response = await InventoryService.createItem(formData);
                    if (response.data.error === false) {
                        if (this.continue_editing && response.data.data.item){
                            window.location.href = '/grocery/inventory/item/edit/'+response.data.data.item.id;
                        }
                        $("#create-item-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('itemAdded');
                this.submitting = false;
            },

            handelImage(event){
                this.item_image= event.target.files[0];
            },
            clearForm() {
                this.id = this.item_name = this.sku = this.unit_size = '';
            },
        },
    };
</script>

<style >
</style>
