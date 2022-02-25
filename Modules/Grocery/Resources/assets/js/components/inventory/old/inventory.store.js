import state from "./state";
import {Errors} from "../../utils/error";
import InventoryService from "../../services/InventoryService";

export const InventoryStore = {
    namespaced: true,
    // strict: true,
    state () {
        return {...state}
    },
    mutations:{
        setCategoryList(state, payload){
            state.categories = payload;
        },
        setBrandList(state, payload){
            state.brands = payload;
        },
        setVendorList(state, payload){
            state.vendors = payload;
        },
        setItems(state, payload){
            state.items = payload;
        },
    },
    getters:{
        categories(state){
            return state.categories;
        },
        brands(state){
            return state.brands;
        },
        items(state){
            return state.items;
        },
        vendors(state){
            return state.vendors;
        },
    },
    actions:{
        async setCategoryList(state, payload){
            try {
                const response = await InventoryService.getCategories(payload);
                state.commit("setCategoryList", response.data.data.categories)
            }catch (error) {
                Errors.Notification(error.response);
            }
        },
        async setBrandList(state, payload){
            try {
                const response = await InventoryService.getBrands(payload);
                state.commit("setBrandList", response.data.data.brands)
            }catch (error) {
                Errors.Notification(error.response);
            }
        },
        async setVendorList(state){
            try {
                const response = await InventoryService.getVendors();
                state.commit("setVendorList", response.data.data.vendors)
            }catch (error) {
                Errors.Notification(error.response);
            }
        },
        async setItems(state, payload){
            try {
                const response = await InventoryService.getItems(payload);
                state.commit("setItems", response.data.data.items)
            }catch (error) {
                Errors.Notification(error.response);
            }
        },
    }
};
