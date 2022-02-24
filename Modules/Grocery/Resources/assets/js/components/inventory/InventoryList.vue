<template>
    <v-container id="itemList" fluid tag="section">
        <v-card class="mx-auto" min-height="71vh">
            <v-toolbar color="info" dark>
                <v-toolbar-title style="width: 150px;">Items</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-tooltip bottom color="black">
                    <template v-slot:activator="{ on }">
                        <v-text-field v-model="search"
                                      filled rounded dense single-line
                                      append-icon="mdi-magnify"
                                      label="Search"
                                      class="shrink ml-3"
                                      hide-details>
                        </v-text-field>
                    </template>
                    <span>Press ENTER key to search</span>
                </v-tooltip>
                <v-spacer></v-spacer>
                <create-item ref="createItem"/>
                <v-tooltip top color="black">
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.prevent="getItems">
                            <v-icon>refresh</v-icon>
                        </v-btn>
                    </template>
                    <span>Refresh</span>
                </v-tooltip>
            </v-toolbar>
            <template v-if="loading">
                <v-row class="fill-height text-muted" style="height:200px" align-content="center" justify="center">
                    <v-col class="overline text-center" cols="12">
                        Fetching data....
                    </v-col>
                    <v-col cols="6">
                        <v-progress-linear color="deep-purple accent-4" indeterminate rounded height="6"></v-progress-linear>
                    </v-col>
                </v-row>
            </template>
            <template v-else>
                <v-data-table show-expand
                              single-expand
                              :expanded.sync="expanded"
                              :headers="headers"
                              :items="items"
                              :options="options"
                              dense fixed-header
                              :search="search">
                    <template v-slot:item.category="{ item }">
                        <span v-if="item.category">{{ item.category.name }}</span>
                    </template>
                    <template v-slot:item.brand="{ item }">
                        <span v-if="item.brand">{{ item.brand.name }}</span>
                    </template>
                    <template v-slot:expanded-item="{ item }">
                        <td colspan="10" class="pa-2">
                            <v-simple-table elevation="0" dense>
                                <template v-slot:default>
                                    <thead>
                                    <tr>
                                        <th class="text-left pa-0">Item Name</th>
                                        <th class="text-left pa-0">Quantity</th>
                                        <th class="text-left pa-0">Stock</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="item.variations.length" v-for="(variant, vindex) in item.variations" :key="vindex">
                                        <td class="pa-0">{{ variant.name }}</td>
                                        <td class="pa-0">{{ variant.quantity }}</td>
                                        <td class="pa-0">
                                            <v-chip class="ma-2" x-small color="green" text-color="white" v-if="variant.stock === 'OK'">{{ variant.stock }}</v-chip>
                                            <v-chip class="ma-2" x-small color="red" text-color="white" v-else>{{ variant.stock }}</v-chip>
                                        </td>
                                        <td>
                                            <v-btn-toggle>
                                                <v-btn x-small @click.prevent="$refs.previewItem.openDialog(variant.id)">
                                                    View
                                                </v-btn>

                                                <v-btn x-small @click.prevent="$refs.createItem.openDialog(variant)">
                                                    Edit
                                                </v-btn>
                                                <v-btn x-small @click.prevent="deleteDialog = true; id = variant.id">
                                                    Delete
                                                </v-btn>
                                            </v-btn-toggle>
                                        </td>
                                    </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </td>
                    </template>
                    <template v-slot:item.has_variant="{ item }">
                        <v-chip  x-small color="green" text-color="white" v-if="item.has_variant === 1">Available</v-chip>

                    </template>
                    <template v-slot:item.quantity="{ item }">
                        {{ item.quantity }} <v-icon small color="primary" class="mr-2" @click.prevent="$refs.addQuantity.openDialog(item)">add</v-icon>
                    </template>
                    <template v-slot:item.stock="{ item }">
                        <template v-if="item.stock">
                            <v-chip class="ma-2" x-small color="green" text-color="white" v-if="item.stock === 'OK'">{{ item.stock }}</v-chip>
                            <v-chip class="ma-2" x-small color="red" text-color="white" v-else>{{ item.stock }}</v-chip>
                        </template>
                    </template>
                    <template v-slot:item.action="{ item }">
                        <v-btn-toggle>
                            <v-btn x-small @click.prevent="$refs.previewItem.openDialog(item.id)">
                                View
                            </v-btn>

                            <v-btn x-small @click.prevent="$refs.createItem.openDialog(item)">
                                Edit
                            </v-btn>
                            <v-btn x-small @click.prevent="deleteDialog = true; id = item.id">
                                Delete
                            </v-btn>
                        </v-btn-toggle>
                    </template>
                </v-data-table>
            </template>
        </v-card>

        <v-dialog v-model="deleteDialog" max-width="350">
            <v-card>
                <v-card-title class="title">Delete Record?</v-card-title>

                <v-card-text>Are you sure you want to delete this record? <code>Confirm</code> to delete permanently.</v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="green darken-1" text @click="deleteDialog = false">Cancel</v-btn>

                    <v-btn color="red darken-1" @click.prevent="deleteItem" :loading="deleteBtnLoading" text>Confirm</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <add-quantity ref="addQuantity"></add-quantity>
        <preview-item ref="previewItem"></preview-item>
    </v-container>
</template>

<script>

    import CreateItem from "../components/CreateItem";
    import {mapActions, mapGetters} from "vuex";
    import InventoryService from "../../../services/InventoryService";
    import {Errors} from "../../../utils/error";
    import AddQuantity from "../components/AddQuantity";
    import PreviewItem from "../components/PreviewItem";

    export default {
        name: "ItemList",
        components: {
            CreateItem,
            AddQuantity,
            PreviewItem
        },
        data() {
            return {
                expanded: [],
                deleteBtnLoading: false,
                deleteDialog: false,
                loading: false,
                moduleIsReady: true,
                search: '',
                options:{
                    itemsPerPage: 200,
                },
                headers: [
                    {text: '#', align: 'start', filterable: false, value: 'id'},
                    { text: 'SKU', value: 'sku' },
                    { text: 'Item Name', value: 'name' },
                    { text: 'Category', value: 'category' },
                    { text: 'Brand', value: 'brand' },
                    { text: 'Variation', value: 'has_variant' },
                    { text: '', value: 'data-table-expand' },
                    { text: 'Quantity', value: 'quantity' },
                    { text: 'Stock', value: 'stock' },
                    { text: '', value: 'action' },
                ],
            };
        },
        created() {},
        mounted() {
            this.getItems();
        },
        computed: {
            ...mapGetters('inventory', ['items'])
        },
        methods: {
            ...mapActions('inventory', ['setItems']),
            async getItems(){
                this.loading = true;
                await this.setItems();
                this.loading = false;
            },
            async deleteItem(){
                this.deleteBtnLoading = true;
                const response = await InventoryService.deleteItem(this.id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItems()
                }
                this.clear();
            },
            clear(){
                this.id = '';
                this.deleteDialog = this.deleteBtnLoading = false;
            },
        },
    }
</script>

<style scoped>

</style>
