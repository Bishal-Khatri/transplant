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
                                <th class="text-right">Order Status</th>
                                <!--<th style="width: 180px" class="text-right">Actions</th>-->
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
                                            <a v-if="order.order_by.avatar" href="#" @click.prevent="$refs.imagePreview.openDialog('/storage/'+order.order_by.avatar)">
                                                <img alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.order_by.avatar">
                                            </a>
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
                                    <a href="#" @click.prevent="$refs.imagePreview.openDialog('/storage/'+order.image)">
                                        <img v-if="order.image" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+order.image">
                                    </a>
                                </td>
                                <td>
                                    {{ order.created_at }}
                                </td>
                                <td>
                                    <span v-if="order.order_status === 1" class="label label-primary ">NEW</span>
                                    <span v-if="order.order_status === 2" class="label label-primary">PROCESSING</span>
                                    <span v-if="order.order_status === 3" class="label label-primary">SHIPPED</span>
                                    <span v-if="order.order_status === 4" class="label label-success">COMPLETED</span>
                                    <span v-if="order.order_status === 5" class="label label-warning">CANCELED</span>
                                    <span v-if="order.order_status === 6" class="label label-danger">FAILED</span>

                                    <select id="" class="form-control pull-right" @change.prevent="showOrderStatusModal($event, order.id)" style="width: 170px;" data-placeholder="Change Status">
                                        <option value="1">New</option>
                                        <option value="2">PROCESSING</option>
                                        <option value="3">SHIPPED</option>
                                        <option value="4">COMPLETED</option>
                                        <option value="5">CANCELED</option>
                                        <option value="6">FAILED</option>
                                    </select>
                                </td>
                                <!--<td>-->
                                <!--<div class="btn-group pull-right">-->
                                <!--<a class="btn btn-default btn-xs" :href="'/cart/order/edit/'+order.id"><i class="fa fa-folder"></i> Archive</a>-->
                                <!--</div>-->
                                <!--</td>-->
                            </tr>
                            </tbody>
                        </table>
                        <!--//pagination-->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="change-order-status" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <button type="button" @click.prevent="changeOrderStatus" class="btn btn-accent">Change</button>
                    </div>
                </div>
            </div>
        </div>

        <image-preview ref="imagePreview"/>

    </div>
</template>

<script>
    import CartService from "../../../services/CartService";
    import {Errors} from "../../../../../../../resources/js/error";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";

    export default {
        name: "ImageOrderList",
        components: {
            ImagePreview,
        },
        data(){
            return{
                errors: new Errors(),
                orders:[],
                order_id: '',
                order_status: 1
            }
        },
        mounted(){
            this.getOrders();
        },
        methods:{
            async getOrders(){
                const response = await CartService.getImageOrders();
                this.orders = response.data.data.imageOrders;
            },

            showOrderStatusModal(event, order_id){
                this.order_id = order_id;
                $("#change-order-status").modal('show');
            },

            async changeOrderStatus(){
                try {
                    const formData = {
                        order_id: this.order_id,
                        status: this.order_status,
                    };
                    const response = await CartService.updateImageOrderStatus(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                $("#change-order-status").modal('hide');
                this.order_status = this.order_id = '';
                this.getOrders();
            },
        }
    }
</script>

<style scoped>

</style>
