<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-10">
                                <button class="btn btn-lg btn-primary mt-2 mr-2 active" @click.prevent="getOrders(0)">ALL</button>
                                <button class="btn btn-lg btn-success mt-2 mr-2" @click.prevent="getOrders(status.COMPLETED)">COMPLETED</button>
                                <button class="btn btn-lg btn-warning mt-2 mr-2" @click.prevent="getOrders(status.CANCELED)">CANCELED</button>
                                <button class="btn btn-lg btn-secondary mt-2 mr-2" @click.prevent="getOrders(status.FAILED)">FAILED</button>
                            </div>
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
                    <!--<div class="panel-heading">-->
                    <!--Item list for grocery-->
                    <!--</div>-->
                    <div class="panel-body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>UniqueId</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Price</th>
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
                                    <a href="">#{{ order.unique_id  }}</a>
                                </td>
                                <td>
                                    <template v-if="order.user">
                                        <div class="float-left mr-2">
                                            <img v-if="order.user.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.user.avatar">
                                            <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                        </div>
                                        <a href="#" >{{ order.user.name }}</a>
                                        <div class="small"><i class="fa fa-map-pin"></i> Email: {{ order.user.email || '-' }}</div>
                                    </template>
                                </td>
                                <td>
                                    <a v-if="order.cart && order.cart.length > 0" href="#">{{ order.cart.length }} Items</a>
                                </td>
                                <td>
                                    <span v-if="order.status === 1" class="label label-primary">NEW</span>
                                    <span v-if="order.status === 2" class="label label-primary">PROCESSING</span>
                                    <span v-if="order.status === 3" class="label label-primary">SHIPPED</span>
                                    <span v-if="order.status === 4" class="label label-success">COMPLETED</span>
                                    <span v-if="order.status === 5" class="label label-warning">CANCELED</span>
                                    <span v-if="order.status === 6" class="label label-danger">FAILED</span>
                                </td>
                                <td>
                                    <span v-if="order.payment_status === 1" class="label label-primary">UNPAID</span>
                                    <span v-if="order.payment_status === 2" class="label label-accent">PAID</span>
                                    <span v-if="order.payment_status === 3" class="label label-danger">FAILED</span>
                                </td>
                                <td>
                                    Rs. {{ order.total_price }}
                                </td>
                                <td>
                                    {{ order.created_at }}
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
            <pagination :data="orders_pg" @pagination-change-page="getOrders"></pagination>
        </div>
    </div>
</template>

<script>
    import CartService from "../../../services/CartService";

    export default {
        name: "GroceryOrderList",
        data(){
            return{
                timer: null,
                page: 1,
                meta: {
                    filter: '',
                    status_filter: 0
                },

                status:{},
                orders:{},
                orders_pg:'',
            }
        },
        mounted(){
            this.getOrders();
            if (meta.status_filter === 0 || meta.status_filter === '') {
                this.timer = setInterval(() => {
                    this.getOrders();
                }, 6000);
            }
        },
        beforeDestroy() {
            clearInterval(this.timer)
        },
        methods:{
            async getOrders(status_filter = ''){
                status_filter ? this.meta.status_filter = status_filter : '';

                const response = await CartService.getOrders(this.page, this.meta);
                this.orders_pg = response.data.data.orders;
                this.orders = response.data.data.orders.data;
                this.status = response.data.data.status;
            }
        }
    }
</script>

<style scoped>

</style>
