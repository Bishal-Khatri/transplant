import Api from './Api';

export default {
    updateProfile(formData){
        return Api().post('/hospital/web-api/hospital-update', formData);
    },

    changeHospitalStatus(formData){
        return Api().post('/admin/web-api/hospital-update-status', formData);
    },
}
