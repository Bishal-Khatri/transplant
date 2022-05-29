import Api from './Api';

export default {

    getGalleries(){
        return Api().get('/admin/cms/web-api/gallery/list');
    },

    createGallery(formData){
        return Api().post('/admin/cms/web-api/gallery/create', formData);
    },

    getGalleryImages(gallery_id){
        return Api().get('/admin/cms/web-api/gallery/getImages/'+gallery_id);
    },

    addImageToGallery(formData){
        return Api().post('/admin/cms/web-api/gallery/addImageToGallery', formData);
    },

    removeImageFromGallery(gallery_image_id){
        return Api().delete('/admin/cms/web-api/gallery/removeImageFromGallery/'+gallery_image_id);
    },

    removeGallery(gallery_id){
        return Api().delete('/admin/cms/web-api/gallery/removeGallery/'+gallery_id);
    },
}
