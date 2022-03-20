import Api from './Api';

export default {
    create(formData){
        return Api().post('/restaurant/web_api/create', formData);
    },
    getUserByEmail(email){
        return Api().post('/api/web_api/getUserByEmail', {'user_email' : email});
    },
    getRestaurant(page,meta){
        return Api().get('/restaurant/web_api/list?page=' + page + '&filter=' + meta.filter);
    },

    deleteRestaurant(restaurant_id){
        return Api().delete('/restaurant/web_api/delete/' + restaurant_id);
    },
}
