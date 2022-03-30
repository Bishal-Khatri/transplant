import Api from './Api';

export default {
    // orders
    getOrders(page, meta){
        return Api().get('/cart/web-api/order/list?page=' + page + '&filter=' + meta.filter + '&status_filter=' + meta.status_filter);
    }
}
