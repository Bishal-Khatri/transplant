import Api from './Api';

export default {
    registerHospital(formData){
        return Api().post('/register-hospital', formData);
    },
}
