import Api from './Api';

export default {

    getPatients(page,filter){
        return Api().get('/hospital/web-api/patient-list?page=' + page + '&filter=' + filter);
    },
}
