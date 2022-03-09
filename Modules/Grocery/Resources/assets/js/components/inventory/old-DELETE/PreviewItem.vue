<template>
    <div>

        <v-dialog v-model="dialog" max-width="800px" scrollable :loading="loading">
            <v-card>
                <v-card-title>
                    <span class="headline">Item Preview</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>{{ item_data.name }}</v-list-item-title>
                                        <v-list-item-subtitle>SKU: <code>{{ item_data.sku }}</code></v-list-item-subtitle>
                                        <v-list-item-subtitle>Brand: <span v-if="item_data.brand"><code>{{ item_data.brand.name }}</code></span></v-list-item-subtitle>
                                        <v-list-item-subtitle>Category: <span v-if="item_data.category"><code>{{ item_data.category.name }}</code></span></v-list-item-subtitle>
                                        <v-list-item-subtitle>Min Qty: <code>{{ item_data.min_quantity_threshold }}</code></v-list-item-subtitle>
                                        <v-list-item-subtitle>Created: <code>{{ item_data.created_at }}</code></v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-col>
                            <v-col cols="12" sm="12">
                                <v-simple-table dense fixed-header>
                                    <template v-slot:default>
                                        <thead>
                                        <tr>
                                            <th class="text-left">Date</th>
                                            <th class="text-left">Init Qty</th>
                                            <th class="text-left">Qty</th>
                                            <th class="text-left">PP</th>
                                            <th class="text-left">SP</th>
                                            <th class="text-left">Vendor</th>
                                            <th class="text-center" style="width: 100px;"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="item_data.quantity_list && item_data.quantity_list.length === 0 && !loading">
                                            <td colspan="7">
                                                <v-alert tile class="mt-1" elevation="1">
                                                    No items to display.
                                                </v-alert>
                                            </td>
                                        </tr>
                                        <tr v-else v-for="value in item_data.quantity_list" :key="value.id">
                                            <td><code>{{ value.purchase_date || 'n/a' }}</code></td>
                                            <td><code>{{ value.initial_quantity }}</code></td>
                                            <td><code>{{ value.quantity }}</code></td>
                                            <td><code>Rs. {{ value.purchase_price || '-' }}</code></td>
                                            <td><code>Rs. {{ value.selling_price || '-' }}</code></td>
                                            <td>
                                                <span v-if="value.vendor"><code>{{ value.vendor.name || 'n/a' }}</code></span>
                                                <span v-else><code>n/a</code></span>
                                            </td>
                                            <td class="text-center">
                                                <v-icon small color="error" @click.prevent="deleteDialog = true; quantity_id = value.id">delete</v-icon>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" small text @click="dialog = false; clearForm()">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="deleteDialog" max-width="350">
            <v-card>
                <v-card-title class="title">Delete Record?</v-card-title>

                <v-card-text>Are you sure you want to delete this record? <code>Confirm</code> to delete permanently.</v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="green darken-1" text @click="deleteDialog = false">Cancel</v-btn>

                    <v-btn color="red darken-1" @click.prevent="deleteQuantity" :loading="deleteBtnLoading" text>Confirm</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>

</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    export default {
        name: "PreviewItem",
        props: {
        },
        components: {
        },
        data: () => ({
            loading: false,
            dialog: false,
            deleteBtnLoading: false,
            deleteDialog: false,
            quantity_id: "",
            item_id: "",
            item_data: "",
        }),
        computed:{
        },
        methods: {
            openDialog(item_id){
                // this.dialog = true;
                // this.item_id = item_id;
                // this.getItemDetails();
            },
            async getItemDetails() {
                // this.loading = true;
                // const response = await InventoryService.getItemDetails(this.item_id);
                // this.item_data = response.data.data.item_data;
                // this.loading = false;
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
                        selling_price: this.selling_price
                    };
                    const response = await InventoryService.saveQuantity(formData);
                    if (response.data.error === false) {
                        this.dialog = false;
                        this.clearForm();
                        // Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    // Errors.Notification(error.response);
                }
                // this.setItems();
            },
            async deleteQuantity(){
                this.deleteBtnLoading = true;
                const response = await InventoryService.deleteQuantity(this.quantity_id);
                if (response.data.error === false) {
                    // Errors.Notification(response);
                    this.getItemDetails();
                }
                this.clearForm();
                this.setItems();
            },
            clearForm() {
                this.errors.clear();
                this.deleteDialog = this.deleteBtnLoading = false;
                this.item_id = this.item_data = this.quantity_id = '';
            },
        },
    };
</script>

<style >
</style>
