<template>
    <v-dialog v-model="dialog" persistent max-width="600px" scrollable>
        <v-card>
            <v-card-title>
                <span class="headline">Add Quantity</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field v-model="item_name" label="Item" required dense readonly></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="8">
                            <v-autocomplete v-model="vendor" :items="vendors" item-text="name" item-value="id" label="Vendor"></v-autocomplete>
                        </v-col>
                        <v-col cols="2" sm="4">
                            <create-vendor ref="createVendor"/>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                :error-messages="errors.get('quantity')"
                                v-model="quantity" type="number" label="Quantity"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :return-value.sync="date"
                                    transition="scale-transition"
                                    min-width="auto">
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field v-model="purchase_date" clearable
                                                  label="Purchase date" readonly v-bind="attrs" v-on="on">
                                    </v-text-field>
                                </template>
                                <v-date-picker v-model="purchase_date" no-title scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                                    <v-btn text color="primary" @click="$refs.menu.save(purchase_date)">OK</v-btn>
                                </v-date-picker>
                            </v-menu>
                            <!--<v-text-field v-model="purchase_date" label="Purchase date"></v-text-field>-->
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="purchase_price" type="number" prefix="Rs." label="Purchase price"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="selling_price" type="number" prefix="Rs." label="Selling price"></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" small text @click="dialog = false; clearForm()">Discard</v-btn>
                <v-btn color="success darken-1" small text @click="saveQuantity" :loading="saveBtnLoading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import {Errors} from "../../../utils/error";
    import {mapActions, mapGetters} from "vuex";
    import InventoryService from "../../../services/InventoryService";
    import CreateVendor from "./CreateVendor";
    export default {
        name: "CreateItem",
        props: {
        },
        components: {
            CreateVendor
        },
        data: () => ({
            errors: new Errors(),
            dialog: false,
            item_id: "",
            item_name: "",
            quantity: "",
            purchase_date: "",
            purchase_price: "",
            selling_price: "",
            vendor: "",
            saveBtnLoading: false,
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu: false,
        }),
        computed:{
            ...mapGetters("inventory", ['categories','brands', 'vendors'])
        },
        methods: {
            ...mapActions('inventory', ['setItems']),
            openDialog(value){
                this.dialog = true;
                this.item_id = value.id;
                this.item_name = value.sku + ' - ' + value.name;
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
                        this.dialog = false;
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.setItems();
            },

            clearForm() {
                this.errors.clear();
                this.item_id = this.item_name = this.quantity = this.purchase_date = this.purchase_price = this.selling_price = this.vendor = '';
            },
        },
    };
</script>

<style >
</style>
