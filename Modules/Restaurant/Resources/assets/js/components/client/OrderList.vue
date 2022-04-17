<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                        </div>
                        Orders
                    </div>
                    <div class="panel-body">
                        <div class="row mb-3">
                            <div class="col-lg-10">
                                <button class="btn btn-sm btn-default btn-squared mt-1 mr-2"
                                        :class="status_filter === 0 ? 'btn-primary':''"
                                        @click.prevent="status_filter = 0; getOrders();">ALL</button>
                                <button class="btn btn-sm btn-default btn-squared mt-1 mr-2"
                                        :class="status_filter === 1 ? 'btn-primary':''"
                                        @click.prevent="status_filter = 1; getOrders();">PROCESSING</button>
                                <button class="btn btn-sm btn-default btn-squared mt-1 mr-2"
                                        :class="status_filter === 2 ? 'btn-primary':''"
                                        @click.prevent="status_filter = 2; getOrders();">COMPLETED</button>
                                <button class="btn btn-sm btn-default btn-squared mt-1 mr-2"
                                        :class="status_filter === 3 ? 'btn-danger':''"
                                        @click.prevent="status_filter = 3; getOrders();">FAILED</button>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control form-control-sm" placeholder="Search by Unique ID" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Customer</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Payment</th>
                                        <th style="" class="">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="!orders.length">
                                        <td colspan="7">No orders available.</td>
                                    </tr>
                                    <tr v-else v-for="order in orders" :key="order.id">
                                        <td>
                                            <a href="">#{{ order.order.unique_id || 'Not-Available' }}</a><br>
                                            <small>Date: {{ order.order.created_at || 'Not-Available' }}</small>
                                        </td>
                                        <td>
                                            <template v-if="order.subscriber">
                                                <div class="float-left mr-2">
                                                    <img v-if="order.subscriber.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.subscriber.avatar">
                                                    <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                                </div>
                                                <a href="#" >{{ order.subscriber.name || 'No Name' }} </a>
                                                <div class="small">
                                                    <i class="fa fa-phone"></i> {{ order.subscriber.phone_number || 'Not-Available' }} ({{ order.order.device_id || 'Not-Available' }})<br>
                                                </div>
                                            </template>
                                        </td>
                                        <td><code>{{ order.cartable.name || 'Not-Available' }}</code></td>
                                        <td>Rs.{{ order.cartable.price || 'Not-Available' }}</td>
                                        <td>
                                            <span v-if="order.order.payment_status === 1" class="label label-primary">Un-Paid</span>
                                            <span v-if="order.order.payment_status === 2" class="label label-primary">Paid</span>
                                            <br>
                                            <span v-if="order.order.payment_method === 'cod'" class="label label-primary">Cash-On-Delivery</span>
                                            <span v-if="order.order.payment_method === 'esewa'" class="label label-primary">eSewa</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-default btn-primary btn-squared mt-1 mr-2"
                                                    v-if="order.status === 0">NEW</button>
                                            <button class="btn btn-sm btn-default btn-primary btn-squared mt-1 mr-2"
                                                    v-if="order.status === 1">PROCESSING</button>
                                            <button class="btn btn-sm btn-default btn-primary btn-squared mt-1 mr-2"
                                                    v-if="order.status === 2">COMPLETED</button>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">Change </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" @click.prevent="changeStatus(order.id, 1)">PROCESSING</a></li>
                                                    <li><a class="dropdown-item" href="#" @click.prevent="changeStatus(order.id, 2)">COMPLETED</a></li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" @click.prevent="changeStatus(order.id, 3)">FAILED</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <pagination :data="orders_pg" @pagination-change-page="getOrders"></pagination>
        </div>

        <!--<div class="modal fade" id="change-status-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">-->
            <!--<div class="modal-dialog modal-sm modal-dialog-centered">-->
                <!--<div class="modal-content">-->
                    <!--<div class="modal-header text-center">-->
                        <!--<h4 class="modal-title">Change Order Status</h4>-->
                        <!--<small>Click <code>Change</code> button to confirm.</small>-->
                    <!--</div>-->
                    <!--<div class="modal-body">-->
                        <!--<p><strong>Attention !</strong> Are you sure you want to change order status of this order?</p>-->
                    <!--</div>-->
                    <!--<div class="modal-footer">-->
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>-->
                        <!--<button type="button" @click.prevent="updateOrderStatus" class="btn btn-accent">Change</button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>

<script>

    import ClientService from "../../services/ClientService";
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "GroceryOrderList",
        data(){
            return{
                timer: null,
                page: 1,
                filter: '',
                status_filter: 0,

                status:{},
                orders:{},
                orders_pg:{},
            }
        },
        mounted(){
            this.getOrders();
        },
        methods:{
            async getOrders(page = 1){
                const response = await ClientService.getOrders(page, this.status_filter);
                this.orders_pg = response.data.data.cart_items;
                this.orders = response.data.data.cart_items.data;
            },

            async changeStatus(cart_item_id, status){
                try {
                    const formData = {
                        cart_item_id: cart_item_id,
                        status: status,
                    };
                    const response = await ClientService.updateItemStatus(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.saveBtnLoading = false;
                    Errors.Notification(error.response);
                }
                this.getOrders();
            }
        }
    }
</script>

<style scoped>

</style>
