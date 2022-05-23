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
    // For Province 
    getProvince(page,filter){
        return Api().get('/admin/web-api/province?page=' + page + '&filter=' + filter);
    },
    saveProvince(formData){
        return Api().post('/admin/web-api/province/create', formData);
    },
    deleteProvince(id){
        return Api().delete('/admin/web-api/province/delete/'+id);
    },
    // For District 
    getDistrict(page,filter,province_id=null){
        let params="";
        province_id ? params='&province_id=' +province_id:null;
        return Api().get('/admin/web-api/district?page=' + page + '&filter=' + filter+params);
    },
    saveDistrict(formData){
        return Api().post('/admin/web-api/district/create', formData);
    },
    deleteDistrict(id){
        return Api().delete('/admin/web-api/district/delete/'+id);
    },

    // For Municipality
    getMunicipality(page,filter,district_id=null){
        let params="";
        district_id ? params='&district_id=' +district_id:null;
        return Api().get('/admin/web-api/municipality?page=' + page + '&filter=' + filter+params);
    },
    saveMunicipality(formData){
        return Api().post('/admin/web-api/municipality/create', formData);
    },
    deleteMunicipality(id){
        return Api().delete('/admin/web-api/municipality/delete/'+id);
    },

    // For Palika
    getPalika(page,filter,district_id=null){
        let params="";
        district_id ? params='&district_id=' +district_id:null;
        return Api().get('/admin/web-api/palika?page=' + page + '&filter=' + filter+params);
    },
    savePalika(formData){
        return Api().post('/admin/web-api/palika/create', formData);
    },
    deletePalika(id){
        return Api().delete('/admin/web-api/palika/delete/'+id);
    },
    getHospitals(page,filter,filter_by,filter_by_option){
        return Api().get('/admin/web-api/hospitals?page=' + page + '&filter=' + filter+'&filter_by='+filter_by+'&filter_by_option='+filter_by_option);
    }
    
}
