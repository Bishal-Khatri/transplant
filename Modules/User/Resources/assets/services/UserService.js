import Api from './Api';

export default {
    getUsers(page, filter, user_type){
        return Api().get('/user/web-api/list?page=' + page + '&filter=' + filter + '&user_type=' + user_type);
    },

    create(formData){
        return Api().post('/user/web-api/register', formData);
    }
}
