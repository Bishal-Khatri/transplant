<template>
    <v-dialog v-model="dialog" persistent max-width="800px" scrollable>
        <template v-slot:activator="{ on, attrs }">
            <v-tooltip top color="black">
                <template v-slot:activator="{ on }">
                    <v-btn v-on="on" @click="dialog = true" v-bind="attrs" small class="secondary mr-4">Add New Item</v-btn>
                </template>
                <span>Create New Item</span>
            </v-tooltip>
        </template>
        <v-card>
            <v-card-title>
                <span class="headline">Create New Item</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <v-text-field
                                :error-messages="errors.get('item_name')"
                                v-model="item_name" label="Item name *" required dense></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                :error-messages="errors.get('sku')"
                                v-model="sku" label="SKU *"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="min_quantity_threshold" label="Minimum quantity threshold" type="number"></v-text-field>
                        </v-col>
                        <v-col cols="10" sm="8">
                            <v-autocomplete v-model="category" :items="categories" item-text="name" item-value="id" label="Category" required></v-autocomplete>
                        </v-col>
                        <v-col cols="2" sm="4">
                            <create-category ref="createCat"/>
                        </v-col>
                        <v-col cols="10" sm="8">
                            <v-autocomplete v-model="brand" :items="brands" item-text="name" item-value="id" label="Brand" required></v-autocomplete>
                        </v-col>
                        <v-col cols="2" sm="4">
                            <create-brand ref="createBrand"/>
                        </v-col>
                        <!--<v-col cols="12" sm="6" md="6">-->
                        <!--<v-text-field type="number" label="Quantity"></v-text-field>-->
                        <!--</v-col>-->
                        <!--<v-col cols="12" sm="6" md="6">-->
                        <!--<v-text-field label="Purchase date"></v-text-field>-->
                        <!--</v-col>-->
                        <!--<v-col cols="12" sm="6" md="6">-->
                        <!--<v-text-field type="number" prefix="Rs." label="Purchase price"></v-text-field>-->
                        <!--</v-col>-->
                        <!--<v-col cols="12" sm="6" md="6">-->
                        <!--<v-text-field type="number" prefix="Rs." label="Selling price"></v-text-field>-->
                        <!--</v-col>-->
                    </v-row>
                </v-container>
                <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" small text @click="dialog = false; clearForm()">Discard</v-btn>
                <v-btn color="success darken-1" small text @click="saveItem" :loading="saveBtnLoading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import {Errors} from "../../../utils/error";
    import {mapActions, mapGetters} from "vuex";
    import InventoryService from "../../../services/InventoryService";
    import CreateCategory from "./CreateCategory";
    import CreateBrand from "./CreateBrand";
    export default {
        name: "CreateItem",
        props: {
        },
        components: {
            CreateBrand,
            CreateCategory
        },
        data: () => ({
            errors: new Errors(),
            dialog: false,
            item_name: "",
            sku: "",
            category: "",
            brand: "",
            min_quantity_threshold: "",
            saveBtnLoading: false,
        }),
        computed:{
            ...mapGetters("inventory", ['categories','brands'])
        },
        methods: {
            ...mapActions('inventory', ['setItems']),
            openDialog(value){
                this.dialog = true;
                this.id = value.id;
                this.item_name = value.name;
                this.sku = value.sku;
                this.category = value.category_id;
                this.brand = value.brand_id;
                this.min_quantity_threshold = value.min_quantity_threshold;
            },
            async saveItem() {
                try {
                    this.saveBtnLoading = true;
                    const formData = {
                        id: this.id,
                        item_name: this.item_name,
                        sku: this.sku,
                        category: this.category,
                        brand: this.brand,
                        min_quantity_threshold: this.min_quantity_threshold
                    };
                    const response = await InventoryService.createItem(formData);
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
                this.id = this.item_name = this.sku = this.category = this.brand = this.min_quantity_threshold = '';
            },
        },
    };
</script>

<style >
</style>
