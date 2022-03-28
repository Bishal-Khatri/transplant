import Api from './Api';

export default {
    // categories
    // getCategories(){
    //     return Api().get('inventory/category/list');
    // },
    // createCategory(formData){
    //     return Api().post('inventory/category/create', formData);
    // },
    // deleteCategory(cat_id){
    //     return Api().get('inventory/category/delete/' + cat_id);
    // },
    //
    // // brands
    getBrands(page,meta){
        return Api().get('/grocery/web-api/brand/list?page=' + page + '&filter=' + meta.filter);
    },
    createBrand(formData){
        return Api().post('/grocery/web-api/brand/create', formData);
    },
    deleteBrand(brand_id){
        return Api().get('/grocery/web-api/brand/delete/' + brand_id);
    },
    //
    // // vendors
    // getVendors(){
    //     return Api().get('inventory/vendor/list');
    // },
    // createVendor(formData){
    //     return Api().post('inventory/vendor/create', formData);
    // },
    // deleteVendor(vendor_id){
    //     return Api().get('inventory/vendor/delete/' + vendor_id);
    // },

    // Items
    getItems(page,meta){
        return Api().get('/grocery/web-api/item/list?page=' + page + '&filter=' + meta.filter + '&category=' + meta.category + '&brand=' + meta.brand);
    },
    createItem(formData){
        return Api().post('/grocery/web-api/item/create', formData);
    },
    deleteItem(item_id){
        return Api().get('/grocery/web-api/item/delete/' + item_id);
    },
    saveQuantity(formData){
        return Api().post('/grocery/web-api/item/addQuantity',formData);
    },
    getItemDetails(item_id){
        return Api().get('/grocery/web-api/item/getItemDetails/'+item_id);
    },
    deleteQuantity(item_id){
        return Api().get('/grocery/web-api/item/deleteQuantity/' + item_id);
    },
    uploadAdditionalImage(formData){
        return Api().post('/grocery/web-api/item/uploadAdditionalImage', formData);
    },
    deleteAdditionalImage(image_id){
        return Api().get('/grocery/web-api/item/deleteAdditionalImage/'+image_id);
    },

    // orders
    getOrders(page, meta){
        return Api().get('/grocery/web-api/order/list?page=' + page + '&filter=' + meta.filter + '&status_filter=' + meta.status_filter);
    }
}
