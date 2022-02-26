<template>
    <div>
        <div class="modal fade" id="main-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Add Quantity on {{ item.name }}</h4>
                        <div class="small"><i class="fa fa-clock-o"></i> Created {{ item.created_at }}</div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-filled">
                                    <div class="panel-heading">
                                        Add new quantity.
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="quantity" class="col-sm-2 col-form-label">Quantity <span style="font-size: 18px" class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="number" v-model="quantity" class="form-control" id="quantity" placeholder="Quantity" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="purchase_date" class="col-sm-2 col-form-label">Purchase Date</label>
                                                <div class="col-sm-10">
                                                    <input type="date" v-model="purchase_date" class="form-control" id="purchase_date" placeholder="Purchase Date" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="purchase_price" class="col-sm-2 col-form-label">Purchase Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" v-model="purchase_price" class="form-control" id="purchase_price" placeholder="Purchase Price" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="selling_price" class="col-sm-2 col-form-label">Selling Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" v-model="selling_price" class="form-control" id="selling_price" placeholder="Selling Price" >
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
                        <button type="button" class="btn btn-accent" @click.prevent="saveQuantity" >Save</button>
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
        name: "AddQuantity",
        props: {
        },
        components: {
        },
        data: () => ({
            item: "",
            item_id: "",
            quantity: "",
            purchase_date: "",
            purchase_price: "",
            selling_price: "",
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
        }),
        computed:{
        },
        methods: {
            openDialog(item) {
                this.item = item;
                this.item_id = item.id;
                $("#main-dialog").modal("show");
            },
            async saveQuantity() {
                try {
                    this.saveBtnLoading = true;
                    const formData = {
                        item_id: this.item_id,
                        item_name: this.item_name,
                        quantity: this.quantity,
                        purchase_date: this.purchase_date,
                        purchase_price: this.purchase_price,
                        selling_price: this.selling_price,
                        vendor: this.vendor
                    };
                    const response = await InventoryService.saveQuantity(formData);
                    if (response.data.error === false) {
                        $("#main-dialog").modal("hide");
                        this.clearForm();
                        // Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    alert("Error!! Check required fields")
                    // this.errors.record(error.response.data);
                    // Errors.Notification(error.response);
                }
                EventBus.$emit('quantityAdded');
            },

            clearForm() {
                this.item_id = this.item = this.quantity = this.purchase_date = this.purchase_price = this.selling_price = '';
            },
        },
    };
</script>

<style >
</style>
