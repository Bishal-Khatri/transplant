import Api from './Api';

export default {

    saveThemeData(formData){
        return Api().post('/admin/cms/web-api/theme/update', formData);
    },
}
