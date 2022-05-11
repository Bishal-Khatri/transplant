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
    // For Ethnic Group
    getEthnicGroups(page,filter){
        return Api().get('/admin/web-api/ethnic-groups?page=' + page + '&filter=' + filter);
    },
    saveEthnicGroup(formData){
        return Api().post('/admin/web-api/ethnic-groups/create', formData);
    },
    deleteEthnicGroup(id){
        return Api().delete('/admin/web-api/ethnic-groups/delete/'+id);
    },
}
