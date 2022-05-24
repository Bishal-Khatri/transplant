import Api from './Api';

export default {

    getPatients(page,filter){
        return Api().get('/hospital/web-api/patient/list?page=' + page + '&filter=' + filter);
    },

    savePatient(formData){
        return Api().post('/hospital/web-api/patient/create', formData);
    },

    deletePatient(patient_id){
        return Api().delete('/hospital/web-api/patient/delete/'+patient_id);
    },
}
