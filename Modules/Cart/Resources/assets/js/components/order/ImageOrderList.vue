<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Unique ID" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-filled">
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Order</th>
                                <th>Image</th>
                                <th>Order Date</th>
                                <th style="width: 180px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>
                                    {{ order.id  }}
                                </td>
                                <td>
                                    <template v-if="order.order_by">
                                        <div class="float-left mr-2">
                                            <img v-if="order.order_by.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.order_by.avatar">
                                            <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                        </div>
                                        <a href="#" >{{ order.order_by.name || 'No Name' }} <span v-if=" order.order_by.device_id"> via {{ order.order_by.device_id }}</span></a>
                                        <div class="small"><i class="fa fa-phone"></i> {{ order.order_by.phone_number || '-' }}</div>
                                    </template>
                                </td>
                                <td>
                                    <a v-if="order.order" :href="'/cart/order/edit/'+order.order.id">#{{ order.order.unique_id  }}</a>
                                    <span v-else>New</span>
                                </td>
                                <td>
                                    <img v-if="order.image" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.image">
                                </td>
                                <td>
                                    {{ order.created_at }}
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <a class="btn btn-default btn-xs" :href="'/cart/order/edit/'+order.id"><i class="fa fa-folder"></i> Trash</a>
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
    </div>
</template>

<script>
    import CartService from "../../../services/CartService";

    export default {
        name: "ImageOrderList",
        data(){
            return{
                orders:[],
            }
        },
        mounted(){
            this.getOrders();
        },
        methods:{
            async getOrders(){
                const response = await CartService.getImageOrders();
                this.orders = response.data.data.imageOrders;
            }
        }
    }
</script>

<style scoped>

</style>
