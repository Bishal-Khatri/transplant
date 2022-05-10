import Api from './Api';

export default {
    getBrands(page,meta){
        return Api().get('/grocery/web-api/brand/list?page=' + page + '&filter=' + meta.filter);
    },
}
