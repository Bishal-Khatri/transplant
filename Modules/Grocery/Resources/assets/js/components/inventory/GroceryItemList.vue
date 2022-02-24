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
                                <th>#</th>
                                <th>SKU</th>
                                <th>Item Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th style="width: 180px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="items.length" v-for="(value, index) in items" :key="index">
                                <td>
                                    {{ value.id }}
                                </td>
                                <td>
                                    {{ value.sku }}
                                </td>
                                <td>
                                    <a href="#">{{ value.name }}</a>

                                    <div class="small"><i class="fa fa-clock-o"></i> Created {{ value.created_at }}</div>
                                </td>
                                <td>
                                    <a href=""><img alt="image" class="rounded image-md" src="/asset/images/a1.jpg"></a>
                                    <a href=""><img alt="image" class="rounded image-md" src="/asset/images/a5.jpg"></a>
                                </td>
                                <td>
                                    {{ value.category.name }}
                                </td>
                                <td>
                                    {{ value.brand.name }}
                                </td>
                                <td>
                                    {{ value.quantity }}
                                    <!--<v-icon small color="primary" class="mr-2" @click.prevent="$refs.addQuantity.openDialog(item)">add</v-icon>-->
                                </td>
                                <td>
                                    <div class="progress m-b-none full progress-small">
                                        <div :style="'width:' +value.stock+'%'" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <small>{{value.stock}} % remaining:</small>
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-default btn-xs" @click.prevent="$refs.previewItem.openDialog(item.id)">
                                            <i class="fa fa-plus"></i> Qty
                                        </button>
                                        <button class="btn btn-default btn-xs" @click.prevent="$refs.createItem.openDialog(item)">
                                            <i class="fa fa-pencil"></i> Edit
                                        </button>
                                        <button class="btn btn-default btn-xs text-danger" @click.prevent="deleteDialog = true; id = item.id">
                                            <i class="fa fa-trash"></i> Delete
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

        <!--<add-quantity ref="addQuantity"></add-quantity>-->
        <!--<preview-item ref="previewItem"></preview-item>-->
    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";
    import PreviewItem from "./PreviewItem";
    // import CreateItem from "../CreateItem";
    // import AddQuantity from "../AddQuantity";

    export default {
        name: "GroceryItemList",
        components: {
            // CreateItem,
            // AddQuantity,
            PreviewItem,
        },
        data(){
            return{
                meta:{
                    filter: '',
                    category: '',
                    brand: '',
                },
                deleteBtnLoading: false,
                deleteDialog: false,

                items: {},
                items_pg: {},
                categories: {},
                brands: {},

            }
        },
        mounted() {
            this.getGroceryItems();
        },
        methods:{
            async getGroceryItems(page=1){
                const response = await InventoryService.getItems(page,this.meta);
                this.items_pg = response.data.data.items;
                this.items = response.data.data.items.data;
                this.categories = response.data.data.categories;
                this.brands = response.data.data.brands;
            }
        }
    }
</script>

<style scoped>

</style>
