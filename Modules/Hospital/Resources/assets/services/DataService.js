import Api from './Api';

export default {
    getNotifications(page,meta){
        return Api().get('/hospital/web-api/notification/list?page=' + page );
    }
}