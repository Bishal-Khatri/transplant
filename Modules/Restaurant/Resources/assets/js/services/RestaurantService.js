import Api from './Api';

export default {
    getRestaurant(page,meta){
        return Api().get('/restaurant/web_api/list?page=' + page + '&filter=' + meta.filter);
    },

    deleteRestaurant(restaurant_id){
        return Api().get('/restaurant/web_api/delete/' + restaurant_id);
    },
}
