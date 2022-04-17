import Api from './Api';

export default {
    getOrders(page, status_filter){
        return Api().get('/restaurant/client/web-api/orderList?page=' + page + '&status_filter=' + status_filter);
    },

    getMenu(page, filter){
        return Api().get('/restaurant/client/web-api/getMenu?page='+ page + '&filter=' + filter);
    },

    updateItemStatus(formData){
        return Api().post('/restaurant/client/web-api/updateItemStatus', formData);
    },
}
