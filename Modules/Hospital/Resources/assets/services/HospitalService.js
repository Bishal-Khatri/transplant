import Api from './Api';

export default {
    updateProfile(formData){
        return Api().post('/hospital/web-api/hospital-update', formData);
    },
}