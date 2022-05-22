import Api from './Api';

export default {
    getProvince(){
        return Api().get('/web-api/public/province');
    },
    getDistrict(province_id){
        return Api().get('/web-api/public/district'+'?province_id='+province_id);
    },
    getMunicipality(district_id){
        return Api().get('/web-api/public/municipality'+'?district_id='+district_id);
    },
}
