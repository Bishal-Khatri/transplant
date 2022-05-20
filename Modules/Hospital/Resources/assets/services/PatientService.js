import Api from './Api';

export default {

    getReligions(page,filter){
        return Api().get('/admin/web-api/religions?page=' + page + '&filter=' + filter);
    },
}
