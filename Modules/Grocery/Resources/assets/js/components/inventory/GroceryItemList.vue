<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Item Name.." aria-describedby="button-addon2" v-model="meta.filter" @keydown.enter="getGroceryItems"
                                           @click:append="getGroceryItems" @keypress="getGroceryItems">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control m-b-xs m-t-xs" name="account" style="width: 100%" @change="getGroceryItems" v-model="meta.category">
                                    <option value="">Filter By Category</option>
                                    <option v-for="(category, cat_index) in categories" :value="category.id" :key="cat_index">{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control m-t-xs" name="account" style="width: 100%" @change="getGroceryItems" v-model="meta.brand">
                                    <option value="">Filter By Brand</option>
                                    <option v-for="(brand, b_index) in brands" :value="brand.id" :key="b_index">{{ brand.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-filled">
                    <!--<div class="panel-heading">-->
                        <!--Item list for grocery-->
                    <!--</div>-->
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox">
                                </th>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Item Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th style="width: 164px" class="text-right">
                                   <span class="float-left">Actions</span>
                                    <button @click.prevent="$refs.createItem.openDialog()" class="text-right btn btn-default btn-xs">Add item</button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="items.length" v-for="(value, index) in items" :key="index">
                                <td><input type="checkbox"></td>
                                <td>
                                    {{ value.id }}
                                </td>
                                <td>
                                    {{ value.sku }}
                                </td>
                                <td>
                                    <a href="#" @click.prevent="$refs.previewItem.openDialog(value.id)">{{ value.name }}</a>

                                    <div class="small"><i class="fa fa-clock-o"></i> Created {{ value.created_at }}</div>
                                </td>
                                <td>
                                    <a :href="'/grocery/inventory/item/edit/'+value.id" v-if="value.main_image_thumbnail">
                                        <img alt="image" class="rounded image-md" :src="'/storage/'+value.main_image_thumbnail">
                                    </a>
                                    <img v-else alt="image" class="rounded image-md" src="/images/placeholder-dark.jpg">
                                    <a :href="'/grocery/inventory/item/edit/'+value.id" style="position: relative;text-align: center; color: white;" v-if="value.images_count > 0">
                                        <img alt="image" class="rounded image-md" src="/images/blank.png">
                                        <div class="centered" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-size: 14px">
                                            +{{ value.images_count }}
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <span v-if="value.category">{{ value.category.name }}</span>
                                </td>
                                <td>
                                    <span v-if="value.brand">{{ value.brand.name }}</span>
                                </td>
                                <td>
                                    {{ value.quantity }}
                                </td>
                                <td>
                                    <div class="progress m-b-none full progress-small">
                                        <div :style="'width:' +value.stock+'%'" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <small>{{value.stock}} % remaining:</small>
                                </td>
                                <td>
                                    <div class="btn-group pull-left">
                                        <button class="btn btn-default btn-xs" @click.prevent="$refs.addQuantity.openDialog(value)">
                                            <i class="fa fa-plus"></i> Qty
                                        </button>
                                        <a class="btn btn-default btn-xs" :href="'/grocery/inventory/item/edit/'+value.id">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-default btn-xs" @click.prevent="showDeleteModal(value.id)">
                                            <i class="fa fa-trash text-danger"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <pagination :data="items_pg" @pagination-change-page="getGroceryItems"></pagination>
        </div>

        <add-quantity ref="addQuantity"></add-quantity>
        <preview-item ref="previewItem"></preview-item>
        <create-item ref="createItem"/>

        <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <form action="" id="deleteForm">
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteItem">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    import PreviewItem from "./PreviewItem";
    import CreateItem from "./CreateItem";
    import AddQuantity from "./AddQuantity";
    import {EventBus} from "../../app";
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "GroceryItemList",
        components: {
            CreateItem,
            AddQuantity,
            PreviewItem,
        },
        data(){
            return{
                meta:{
                    filter: '',
                    category: '',
                    brand: '',
                },
                delete_id: '',

                items: {},
                items_pg: {},
                categories: {},
                brands: {},

            }
        },
        mounted() {
            this.getGroceryItems();
            EventBus.$on('quantityAdded', () => {
                this.getGroceryItems();
            });
            EventBus.$on('itemAdded', () => {
                this.getGroceryItems();
            });
            EventBus.$on('quantityDeleted', () => {
                this.getGroceryItems();
            });
        },
        methods:{
            async getGroceryItems(page=1){
                const response = await InventoryService.getItems(page,this.meta);
                this.items_pg = response.data.data.items;
                this.items = response.data.data.items.data;
                this.categories = response.data.data.categories;
                this.brands = response.data.data.brands;
            },

            showDeleteModal(item_id){
                this.delete_id = item_id;
                $("#deleteItemModal").modal('show');
            },

            async deleteItem(){
                const response = await InventoryService.deleteItem(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getGroceryItems();
                    $("#deleteItemModal").modal('hide');
                }
                this.delete_id = '';
            },
        }
    }
</script>

<style scoped>

</style>
