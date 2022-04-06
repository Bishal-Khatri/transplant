<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled panel-c-warning">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                        </div>
                        Actions
                    </div>
                    <div class="panel-body" style="display: block;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <p class="c-white mb-1">Payment Status:</p>
                                        <button @click.prevent="showPaymentStatusModal(1)" class="btn btn-w-md btn-default btn-squared" :class="order.payment_status === 1 ? 'btn-success':''">UNPAID</button>
                                        <button @click.prevent="showPaymentStatusModal(2)" class="btn btn-w-md btn-default btn-squared" :class="order.payment_status === 2 ? 'btn-success':''">PAID</button>
                                        <button @click.prevent="showPaymentStatusModal(3)" class="btn btn-w-md btn-default btn-squared" :class="order.payment_status === 3 ? 'btn-danger':''">FAILED</button>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="c-white mb-1">Order Status:</p>
                                        <button @click.prevent="showOrderStatusModal(2)" class="btn btn-w-md btn-default btn-squared" :class="order.status === 2 ? 'btn-success':''">PROCESSING</button>
                                        <button @click.prevent="showOrderStatusModal(3)" class="btn btn-w-md btn-default btn-squared" :class="order.status === 3 ? 'btn-success':''">SHIPPED</button>
                                        <button @click.prevent="showOrderStatusModal(4)" class="btn btn-w-md btn-default btn-squared" :class="order.status === 4 ? 'btn-success':''">COMPLETED</button>
                                        <button @click.prevent="showOrderStatusModal(5)" class="btn btn-w-md btn-default btn-squared" :class="order.status === 5 ? 'btn-success':''">CANCELED</button>
                                        <button @click.prevent="showOrderStatusModal(6)" class="btn btn-w-md btn-default btn-squared" :class="order.status === 6 ? 'btn-danger':''">FAILED</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-4">
                                    <label for="delivery_person">Delivery Person</label>
                                    <select id="delivery_person" class="form-control m-b-xs delivery-select2" name="account" style="width: 100%">
                                        <option value="">Select Delivery Person</option>
                                    </select>
                                    <span class="form-text small text-danger" v-html="errors.get('description')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="panel-footer" style="display: block;">Panel footer</div>-->
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-filled panel-c-warning">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="panel-toggle"><i class="fa fa-chevron-up"></i></a>
                        </div>
                        Order Summary
                    </div>
                    <div class="panel-body" style="display: block;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <table class="table small m-t-sm" v-if="order">
                                    <tbody>
                                    <tr v-if="order.user.avatar">
                                        <td colspan="2">
                                            <img :src="'/storage/'+order.user.avatar" alt="" class="image-md rounded">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Client ID: <strong class="c-white">{{order.user.phone_number || 'Not Available' }} ({{order.user.name || 'Client Name Not Available' }})</strong>
                                        </td>
                                        <td>
                                            Order ID: <strong class="c-white">#{{ order.unique_id}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Address: <strong class="c-white">{{ order.address.district.name }}, {{ order.address.street.name }}, {{ order.address.local_address }}</strong>
                                        </td>
                                        <td>
                                            Order Date: <strong class="c-white">{{ order.created_at}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Payment Method: <strong class="c-white">{{ order.payment_method }}</strong>
                                        </td>
                                        <td>
                                            Payment Status
                                            <span v-if="order.payment_status === 1" class="label label-primary">UNPAID</span>
                                            <span v-if="order.payment_status === 2" class="label label-success">PAID</span>
                                            <span v-if="order.payment_status === 3" class="label label-danger">FAILED</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Order Status
                                            <span v-if="order.status === 1" class="label label-primary">NEW</span>
                                            <span v-if="order.status === 2" class="label label-primary">PROCESSING</span>
                                            <span v-if="order.status === 3" class="label label-primary">SHIPPED</span>
                                            <span v-if="order.status === 4" class="label label-success">COMPLETED</span>
                                            <span v-if="order.status === 5" class="label label-warning">CANCELED</span>
                                            <span v-if="order.status === 6" class="label label-danger">FAILED</span>
                                        </td>
                                        <td>
                                            Total Price: <strong class="c-white">Rs.{{ order.total_price}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Shipping Price: <strong class="c-white">Rs.{{ order.shipping_price}}</strong>
                                        </td>
                                        <td>
                                            Device: <strong class="c-white">{{ order.device_id}}</strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <table class="table table-responsive-lg" v-if="order">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Item</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="order.cart" v-for="(cart,index) in order.cart" :key="index">
                                        <td>
                                            <img v-if="cart.cartable.image" :src="'/storage/'+cart.cartable.image" alt="" class="image-md rounded">
                                            <img v-else src="/images/placeholder-dark.jpg" alt="" class="image-md rounded">
                                        </td>
                                        <td>
                                            <a href="#">{{ cart.cartable.name || 'Not Available' }}</a>
                                        </td>
                                        <td>
                                            <span class="text-uppercase" v-if="cart.cartable_type === 'Modules\\Restaurant\\Entities\\RestaurantMenu'">Restaurant_Menu</span>
                                            <span class="text-uppercase" v-if="cart.cartable_type === 'Modules\\Grocery\\Entities\\Item'">Grocery</span>
                                        </td>
                                        <td>{{ cart.quantity }}</td>
                                        <td>Rs.{{ cart.price }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Subtotal:</td>
                                        <td>Rs.{{ order.total_price }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Shipping Price:</td>
                                        <td>Rs.{{ order.shipping_price }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total Price:</td>
                                        <td>Rs.{{ order.total_price }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updatePaymentModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Change Payment Status</h4>
                        <small>Click <code>Change</code> button to confirm.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to change payment status of this order?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" @click.prevent="updatePaymentStatus" class="btn btn-accent">Change</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Change Order Status</h4>
                        <small>Click <code>Change</code> button to confirm.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to change order status of this order?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" @click.prevent="updateOrderStatus" class="btn btn-accent">Change</button>
                    </div>
                </div>
            </div>
        </div>
        <!--<pre>{{order}}</pre>-->
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import CartService from "../../../services/CartService";

    export default {
        name: "EditOrder",
        props: [
            'order_id'
        ],
        data: () => ({
            errors: new Errors(),
            order:'',
            payment_status: '',
            order_status: '',
        }),
        async mounted() {
            this.getOrderDetails();
            $('.delivery-select2').select2();
        },
        methods: {
            showPaymentStatusModal(status){
                this.payment_status = status;
                $("#updatePaymentModal").modal('show');
            },
            async updatePaymentStatus(){
                try {
                    const formData = {
                        order_id: this.order_id,
                        status: this.payment_status,
                    };
                    const response = await CartService.updatePaymentStatus(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.saveBtnLoading = false;
                    Errors.Notification(error.response);
                }
                $("#updatePaymentModal").modal('hide');
                this.payment_status = '';
                this.getOrderDetails();
            },

            showOrderStatusModal(status){
                this.order_status = status;
                $("#updateStatusModal").modal('show');
            },
            async updateOrderStatus(){
                try {
                    const formData = {
                        order_id: this.order_id,
                        status: this.order_status,
                    };
                    const response = await CartService.updateOrderStatus(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.saveBtnLoading = false;
                    Errors.Notification(error.response);
                }
                $("#updateStatusModal").modal('hide');
                this.order_status = '';
                this.getOrderDetails();
            },

            async getOrderDetails() {
                try {
                    const response = await CartService.getOrderDetails(this.order_id);
                    if (response.data.error === false) {
                        this.order = response.data.data.order;
                    }else{
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.saveBtnLoading = false;
                    Errors.Notification(error.response);
                }
            },
        }
    }
</script>

<style scoped>

</style>
