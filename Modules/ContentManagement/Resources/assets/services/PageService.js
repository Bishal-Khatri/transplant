import Api from './Api';

export default {

    getPageDetails(page_id){
        return Api().get('/admin/cms/web-api/page/details/' + page_id);
    },

    updatePage(formData){
        return Api().post('/admin/cms/web-api/page/update', formData);
    },

    deleteSection(section_id){
        return Api().delete('/admin/cms/web-api/page/deleteSection/' + section_id);
    },

    addSection(formData){
        return Api().post('/admin/cms/web-api/page/addSection', formData);
    },

    updateSection(formData){
        return Api().post('/admin/cms/web-api/page/updateSection', formData);
    },
}
