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
    // For Diseases 
    getDiseases(page,filter){
        return Api().get('/admin/web-api/diseases?page=' + page + '&filter=' + filter);
    },
    saveDisease(formData){
        return Api().post('/admin/web-api/diseases/create', formData);
    },
    deleteDisease(id){
        return Api().delete('/admin/web-api/diseases/delete/'+id);
    },
    // For Education Levels 
    getEducationLevels(page,filter){
        return Api().get('/admin/web-api/education-levels?page=' + page + '&filter=' + filter);
    },
    saveEducationLevel(formData){
        return Api().post('/admin/web-api/education-levels/create', formData);
    },
    deleteEducationLevel(id){
        return Api().delete('/admin/web-api/education-levels/delete/'+id);
    },
    // For Occupations 
    getOccupations(page,filter){
        return Api().get('/admin/web-api/occupations?page=' + page + '&filter=' + filter);
    },
    saveOccupation(formData){
        return Api().post('/admin/web-api/occupations/create', formData);
    },
    deleteOccupation(id){
        return Api().delete('/admin/web-api/occupations/delete/'+id);
    },
}
