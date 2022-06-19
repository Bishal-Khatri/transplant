import Api from './Api';

export default {
    getPatient(id){
        return Api().get('/hospital/web-api/patient/get/' + id);
    },
    getPatients(page,filter){
        return Api().get('/hospital/web-api/patient/list?page=' + page + '&filter=' + filter);
    },

    savePatient(formData){
        return Api().post('/hospital/web-api/patient/create', formData);
    },

    updatePatient(formData){
        return Api().post('/hospital/web-api/patient/update', formData);
    },

    deletePatient(patient_id){
        return Api().delete('/hospital/web-api/patient/delete/'+patient_id);
    },

    transferPatient(formData){
        return Api().post('/hospital/web-api/patient/transfer', formData);
    },
}
