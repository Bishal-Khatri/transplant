<template>
    <div>
        <div class="modal fade" id="menu-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Add New Item</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-filled">
                                    <div class="panel-heading">
                                        Add new item.
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="image" class="col-sm-3 col-form-label">Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="image" class="form-control-file mb-1" @change.prevent="handelImage" name="image" accept="image/png, image/jpeg">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                    <span class="form-text small text-danger" v-html="errors.get('image')"></span>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">
                                                    Name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="name" class="form-control" id="name" placeholder="Food item name" >
                                                    <span class="form-text small text-danger" v-html="errors.get('name')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="price" class="col-sm-3 col-form-label">
                                                    Price
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="number" v-model="price" class="form-control" id="price" placeholder="Price" >
                                                    <span class="form-text small text-danger" v-html="errors.get('price')"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="category">
                                                    Category
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="category form-control" style="width: 100%;color:white" id="category" name="parent" v-model="category_id">
                                                        <option value="">Select</option>
                                                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                                    </select>
                                                    <span class="form-text small text-danger" v-html="errors.get('category_id')"></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveMenuItem" >Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../app';
    import {Errors} from "../../../../../../resources/js/error";
    import RestaurantService from "../services/RestaurantService";
    export default {
        name: "AddItem",
        props: [
            'categories'
        ],
        components: {
        },
        data: () => ({
            errors: new Errors(),

            restaurant: "",
            restaurant_id: "",

            name: "",
            price: "",
            category_id: "",
            image: "",
        }),
        computed:{
        },
        methods: {
            openDialog(restaurant) {
                this.restaurant = restaurant;
                this.restaurant_id = restaurant.id;
                $("#menu-dialog").modal("show");
            },
            async saveMenuItem() {
                try {
                    this.saveBtnLoading = true;
                    let formData = new FormData();
                    formData.append("restaurant_id", this.restaurant_id);
                    formData.append("name", this.name);
                    formData.append("price", this.price);
                    formData.append("category_id", this.category_id);

                    if(this.image){
                        formData.append("image", this.image, this.image.name);
                    }
                    const response = await RestaurantService.saveMenuItem(formData);
                    if (response.data.error === false) {
                        $("#menu-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                    window.location.reload();

                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },
            handelImage(event){
                this.image = event.target.files[0];
                // this.image_url = URL.createObjectURL(event.target.files[0]);
            },
            clearForm() {
                this.restaurant_id = this.name = this.price = this.image = '';
            },
        },
    };
</script>

<style >
</style>
