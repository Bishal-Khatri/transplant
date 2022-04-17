import Api from './Api';

export default {

    getPageDetails(page_id){
        return Api().get('/cms/admin/web-api/page/details/' + page_id);
    },

    updatePage(formData){
        return Api().post('/cms/admin/web-api/page/update', formData);
    },

    deleteSection(section_id){
        return Api().delete('/cms/admin/web-api/page/deleteSection/' + section_id);
    },

    addSection(formData){
        return Api().post('/cms/admin/web-api/page/addSection', formData);
    },

    updateSection(formData){
        return Api().post('/cms/admin/web-api/page/updateSection', formData);
    },
}
