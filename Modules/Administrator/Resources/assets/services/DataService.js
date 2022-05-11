import Api from './Api';

export default {

    getReligions(page,filter){
        return Api().get('/admin/web-api/religions?page=' + page + '&filter=' + filter);
    },

    saveReligion(formData){
        return Api().post('/admin/web-api/religions/create', formData);
    },

    deleteReligion(id){
        return Api().delete('/admin/web-api/religions/delete/'+id);
    },
}
