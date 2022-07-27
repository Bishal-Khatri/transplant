import Api from './Api';

export default {

    getPatients(page,filter){
        return Api().get('/admin/web-api/patient/list?page=' + page + '&filter=' + filter.query + '&t_t=' + filter.transplant_type + '&p_s=' + filter.patient_status + '&b_t=' + filter.blood_type);
    },

    getPatientsCount(){
        return Api().get('/admin/web-api/patient/count');
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

    changePatientStatus(formData){
        return Api().post('/admin/web-api/patient/change-status',formData);
    },
}
