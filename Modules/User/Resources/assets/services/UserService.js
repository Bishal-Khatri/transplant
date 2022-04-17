import Api from './Api';

export default {
    getUsers(page, filter, user_type){
        return Api().get('/user/web-api/list?page=' + page + '&filter=' + filter + '&user_type=' + user_type);
    },

    getRoles(page, filter){
        return Api().get('/user/web-api/role/list?page=' + page + '&filter=' + filter);
    },

    create(formData){
        return Api().post('/user/web-api/register', formData);
    }
}
