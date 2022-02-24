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
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th style="width: 180px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="n in 15">
                                <td>
                                    {{ n  }}
                                </td>
                                <td>
                                    <a href="#">Comarch group contract</a>

                                    <div class="small"><i class="fa fa-clock-o"></i> Created 06.10.2017</div>
                                </td>
                                <td>
                                    <a href=""><img alt="image" class="rounded image-md" src="/asset/images/a1.jpg"></a>
                                    <a href=""><img alt="image" class="rounded image-md" src="/asset/images/a5.jpg"></a>
                                </td>
                                <td>
                                    Original Category
                                </td>
                                <td>
                                    Original Brand
                                </td>
                                <td>23</td>
                                <td>
                                    <div class="progress m-b-none full progress-small">
                                        <div style="width: 12%" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <small>12% compleated:</small>
                                </td>
                                <td>Rs. 233</td>
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
    import InventoryService from "../../services/InventoryService";

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
