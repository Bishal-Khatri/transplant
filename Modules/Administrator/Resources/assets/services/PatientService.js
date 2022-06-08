import Api from './Api';

export default {

    getPatients(page,filter){
        return Api().get('/admin/web-api/patient/list?page=' + page + '&filter=' + filter);
    },

    savePatient(formData){
        return Api().post('/admin/web-api/patient/create', formData);
    },

    updatePatient(formData){
        return Api().post('/admin/web-api/patient/update', formData);
    },

    deletePatient(patient_id){
        return Api().delete('/admin/web-api/patient/delete/'+patient_id);
    },
}
