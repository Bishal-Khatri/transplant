<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Name.." aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control m-b-xs m-t-xs" name="account" style="width: 100%">
                                    <option selected="">Select status</option>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control m-t-xs" name="account" style="width: 100%">
                                    <option selected="">Sort by:</option>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
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
                                <th>#OrderId</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th style="width: 180px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="value in 15">
                                <td>
                                    {{ value  }}
                                </td>
                                <td>
                                    {{ value  }}
                                </td>
                                <td>
                                    <template v-if="value.user">
                                        <div class="float-left mr-2">
                                            <img v-if="value.user.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+value.user.avatar">
                                            <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                        </div>
                                        <a href="#" >{{ value.user.name }}</a>
                                        <div class="small"><i class="fa fa-map-pin"></i> Email: {{ value.user.email || '-' }}</div>
                                    </template>
                                </td>
                                <td>
                                    <a href="#">4 Items</a>
                                </td>
                                <td>
                                    Rs. 2076
                                </td>
                                <td>
                                   27 Mar 2022
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-default btn-xs"><i class="fa fa-folder"></i> View</button>
                                        <button class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Edit</button>
                                        <button class="btn btn-default btn-xs text-danger"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!--//pagination-->

                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <ul class="pagination pagination-sm">
                <li class="disabled page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="active page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import InventoryService from "../../../services/InventoryService";

    export default {
        name: "GroceryOrderList",
        data(){
            return{
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
            }
        },
        methods:{
            async getGroceryItems(){
                const response = await InventoryService.getItems();
                this.items = response.data.data.items;
            }
        }
    }
</script>

<style scoped>

</style>
