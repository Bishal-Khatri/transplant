import Api from './Api';

export default {
    // orders
    getOrders(page, filter, status_filter){
        return Api().get('/cart/web-api/order/list?page=' + page + '&filter=' + filter + '&status_filter=' + status_filter);
    },

    getOrderDetails(order_id){
        return Api().get('/cart/web-api/order/orderDetails/'+order_id);
    },

    updatePaymentStatus(formData){
        return Api().post('/cart/web-api/order/updatePaymentStatus', formData);
    },

    updateOrderStatus(formData){
        return Api().post('/cart/web-api/order/updateOrderStatus', formData);
    },

    assignOrder(formData){
        return Api().post('/cart/web-api/order/assignOrder', formData);
    }
}
