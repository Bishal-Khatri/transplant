<template>
    <div>
        <div class="modal fade" id="preview-item" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Details of {{ item_data.name }}</h4>
                        <div class="small"><i class="fa fa-clock-o"></i> Created {{ item_data.created_at }}</div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="panel m-b-none">
                                    <div class="panel-body">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <td>Item Name</td>
                                                <th class="text-right">{{ item_data.name }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>SKU</td>
                                                <td class="text-right"><code>{{ item_data.sku }}</code></td>
                                            </tr>
                                            <tr>
                                                <td>Brand</td>
                                                <td class="text-right"><span v-if="item_data.brand"><code>{{ item_data.brand.name }}</code></span></td>
                                            </tr>
                                            <tr>
                                                <td>Category</td>
                                                <td class="text-right"><span v-if="item_data.category"><code>{{ item_data.category.name }}</code></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <div class="panel m-b-none">
                                    <div class="panel-body">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>Inventory Details</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Available Quantity</td>
                                                <td class="text-right"><code>{{ inventory_details.available_quantity }}</code></td>
                                            </tr>
                                            <tr>
                                                <td>Max Selling Price</td>
                                                <td class="text-right"><code>Rs.{{ inventory_details.max_price }}</code></td>
                                            </tr>
                                            <tr>
                                                <td>Stock Level</td>
                                                <td class="text-right"><code>{{ inventory_details.stock_level }} % available</code></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="panel m-b-none">
                                    <div class="panel-body">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>Purchase Date</th>
                                                <th>Initial Qty</th>
                                                <th>Available Qty</th>
                                                <th>Purchase Price</th>
                                                <th>Selling Price</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="value in item_data.quantity_list" :key="value.id">
                                                <td class=""><code>{{ value.purchase_date || 'n/a' }}</code></td>
                                                <td class=""><code>{{ value.initial_quantity || 'n/a' }}</code></td>
                                                <td class=""><code>{{ value.quantity || 'n/a' }}</code></td>
                                                <td class=""><code>Rs.{{ value.purchase_price || 'n/a' }}</code></td>
                                                <td class=""><code>Rs.{{ value.selling_price || 'n/a' }}</code></td>
                                                <td class=""><button class="btn btn-default btn-xs" @click.prevent="showDelete(value.id)">Delete</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-accent" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Confirm Delete</h4>
                        <small>Click <code>Delete</code> button to confirm.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click.prevent="hideDelete">Cancel</button>
                        <form action="" id="deleteForm">
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteQuantity">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InventoryService from '../../../services/InventoryService'
    import {EventBus} from "../../app";

    export default {
        name: "PreviewItem",
        data: () => ({
            deleteDialog: false,
            item_id:'',
            item_data:'',
            inventory_details:'',
            delete_quantity_id:'',
        }),
        methods: {
            openDialog(item_id) {
                this.item_id = item_id;
                this.getItemDetails();
                $("#preview-item").modal("show");
            },
            async getItemDetails() {
                const response = await InventoryService.getItemDetails(this.item_id);
                this.item_data = response.data.data.item_data;
                this.inventory_details = response.data.data.inventory_details;
            },
            async showDelete(delete_id){
                this.delete_quantity_id = delete_id;
                $("#deleteModal").modal("show");
            },
            async hideDelete(){
                this.delete_quantity_id = '';
                $("#deleteModal").modal("hide");
            },
            async deleteQuantity(){
                this.deleteBtnLoading = true;
                const response = await InventoryService.deleteQuantity(this.delete_quantity_id);
                if (response.data.error === false) {
                    // Errors.Notification(response);
                    this.getItemDetails();
                    this.hideDelete();
                    EventBus.$emit('quantityDeleted');
                }
            },
        }
    }
</script>

<style scoped>

</style>
