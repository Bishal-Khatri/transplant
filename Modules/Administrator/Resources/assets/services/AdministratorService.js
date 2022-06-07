import Api from './Api';

export default {
    getHospitalDetails(hospital_id){
        return Api().get('/admin/web-api/hospitals-details/'+hospital_id);
    },

    changeHospitalStatus(formData){
        return Api().post('/admin/web-api/hospital-update-status', formData);
    },

    approveHospital(formData){
        return Api().post('/admin/web-api/hospital-approve', formData);
    },

    rejectHospital(formData){
        return Api().post('/admin/web-api/hospital-reject', formData);
    },
}
