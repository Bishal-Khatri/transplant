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
    // getBrands(){
    //     return Api().get('inventory/brand/list');
    // },
    // createBrand(formData){
    //     return Api().post('inventory/brand/create', formData);
    // },
    // deleteBrand(brand_id){
    //     return Api().get('inventory/brand/delete/' + brand_id);
    // },
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
        return Api().get('/grocery/inventory/item/list?page=' + page + '&filter=' + meta.filter + '&category=' + meta.category + '&brand=' + meta.brand);
    },
    createItem(formData){
        return Api().post('/grocery/inventory/item/create', formData);
    },
    deleteItem(item_id){
        return Api().get('inventory/item/delete/' + item_id);
    },
    saveQuantity(formData){
        return Api().post('/grocery/inventory/item/addQuantity',formData);
    },
    getItemDetails(item_id){
        return Api().get('/grocery/inventory/item/getItemDetails/'+item_id);
    },
    deleteQuantity(item_id){
        return Api().get('/grocery/inventory/item/deleteQuantity/' + item_id);
    }
}
