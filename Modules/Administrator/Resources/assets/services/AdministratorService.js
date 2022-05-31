import Api from './Api';

export default {
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
