<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Restaurant Details
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="" enctype="multipart/form-data" @submit.prevent="saveItem">
                            <div class="form-group mb-4">
                                <label for="restaurant_name">Restaurant Name <span style="font-size: 18px" class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="restaurant_name" placeholder="Restaurant Name" v-model="restaurant_name" required>
                                <span class="form-text small text-danger" v-html="errors.get('restaurant_name')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" v-model="address">
                                <span class="form-text small text-danger" v-html="errors.get('address')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" id="latitude" v-model="latitude">
                                        <span class="form-text small text-danger" v-html="errors.get('latitude')"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" id="longitude" v-model="longitude">
                                        <span class="form-text small text-danger" v-html="errors.get('longitude')"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="main-image">
                                    Main Image <span style="font-size: 18px" class="text-danger">*</span><br>
                                    <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>
                                </label>
                                <input type="file" id="main-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg" @change="handelImage">
                                <img v-if="main_image_url" :src="main_image_url" alt="" name="image" class="rounded image-xl">
                                <img v-else src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="3" v-model="description" id="description"></textarea>
                                <span class="form-text small text-danger" v-html="errors.get('description')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="main_user">
                                            Main User
                                            <span style="font-size: 18px" class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" v-model="main_user_email" class="form-control" id="main_user" placeholder="Email address" >
                                            <span class="form-text small text-danger" v-html="errors.get('user')"></span>
                                            <span v-if="selected_user" class="label label-accent">{{ selected_user.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="brand">Amenities</label>
                                        <select class="brand form-control" style="width: 100%; color:white" id="brand" v-model="amenities">
                                            <option value="0">Root</option>
                                        </select>
                                        <span class="form-text small text-danger" v-html="errors.get('amenities')"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Selected Brand</h5>
                                    </div>
                                </div>
                            </div>
                            <a href="/grocery/item" class="btn btn-default">Discard</a>
                            <button type="subm  it" class="btn btn-accent">Update Details</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Menu
                        <button class="btn btn-default btn-xs float-right" @click.prevent="$refs.addQuantity.openDialog(item)">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th width="100px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="value in 5" :key="value.id">
                                <td class="">
                                    <img src="/images/placeholder-dark.jpg" alt="" name="image" class="rounded image-md">
                                </td>
                                <td class=""><code>Buff Momo</code></td>
                                <td class=""><code>Rs. 200</code></td>
                                <td class=""><code>Non-Veg Snack</code></td>
                                <td class="">
                                    <button class="btn btn-default btn-xs" @click.prevent="showDelete(value.id)">Edit</button>
                                    <button class="btn btn-default btn-xs" @click.prevent="showDelete(value.id)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Additional images (Multiple File Upload) <br>
                        <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>
                    </div>
                    <div class="panel-body">
                        <div class="form-group mb-4">
                            <input type="file" id="additional-image" class="form-control-file mb-1" name="image" accept="image/png, image/jpeg" @change="uploadAdditionalImages" multiple>
                        </div>
                        <div v-if="uploading_image" style="height: 150px;" class="mt-4 pt-4">
                            <div class="loader-bar"></div>
                            <p class="text-center mt-4 text-muted">Uploading Images</p>
                        </div>
                        <div v-else>
                            <img v-if="Object.keys(images).length === 0" src="/images/placeholder-dark.jpg" alt="" name="image" class="rounded image-xl">
                            <div class="row" v-else >
                                <div class="col-md-4 text-center mb-4" v-for="image in images">
                                    <img :src="'/storage/'+image.original" alt="" id="additional-image-preview" name="image" class="rounded mb-1 image-xl">
                                    <button class="btn btn-sm btn-default btn-block" @click.prevent="deleteAdditionalImage(image.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Confirm Delete</h4>
                        <small>Click <code>Delete</code> button to confirm.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click.prevent="hideDelete">Cancel</button>
                        <form action="" id="deleteForm">
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteQuantity">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from "../app";
    import {Errors} from "../../../../../../resources/js/error";

    export default {
        name: "RestaurantEdit",
        components: {
        },
        data: () => ({
            errors: new Errors(),
            uploading_image: false,
            // form data
            restaurant_name:'',
            address: '',
            latitude: '',
            longitude: '',
            main_image_url: '',
            description: '',
            main_user_email: '',
            selected_user: '',

            images:[],
            amenities:[],
            menu:[],
        }),
        props: [
            'restaurant',
        ],
        computed:{
        },
        async mounted(){
            this.setItemData();
            // await this.getItemDetails();
            EventBus.$on('quantityAdded', () => {
                this.getItemDetails();
            });
            EventBus.$on('quantityDeleted', () => {
                this.getItemDetails();
            });
        },
        methods: {
            setItemData(){
                this.restaurant_name = this.restaurant.name;
                this.description = this.restaurant.description;
                this.latitude = this.restaurant.latitude;
                this.longitude = this.restaurant.longitude;
                this.address = this.restaurant.address;
                this.menu = this.restaurant.menu;

                if (this.restaurant.logo){
                    this.main_image_url = '/storage/' + this.restaurant.logo;
                }
            },
            async getItemDetails() {
                const response = await InventoryService.getItemDetails(this.itemId);
                this.setItemData(response.data.data);

            },
            async saveItem() {
                try {
                    let formData = new FormData();
                    formData.append("item_id", this.itemId);
                    formData.append("item_name", this.name);
                    this.sku ? formData.append("sku", this.sku) : '';
                    this.unit_size ? formData.append("unit_size", this.unit_size) : '';
                    this.description ? formData.append("description", this.description): '';
                    if (this.category_id){
                        formData.append("category_id", this.category_id);
                    }
                    if (this.brand_id) {
                        formData.append("brand_id", this.brand_id);
                    }
                    if(this.main_image){
                        formData.append("main_image", this.main_image, this.main_image.name);
                    }

                    const response = await InventoryService.createItem(formData);
                    if (response.data.error === false) {
                        this.getItemDetails();
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('itemAdded');
            },

            handelImage(event){
                this.main_image = event.target.files[0];
                this.item_image_url = URL.createObjectURL(event.target.files[0]);
            },
            clearForm() {
                // this.id = this.item_name = this.sku = this.category = this.brand = '';
            },
            async showDelete(delete_id){
                this.delete_quantity_id = delete_id;
                $("#deleteModal").modal("show");
            },
            async hideDelete(){
                this.delete_quantity_id = '';
                $("#deleteModal").modal("hide");
            },

            async uploadAdditionalImages(event){
                this.uploading_image = true;
                const files = event.target.files;
                if (files.length){
                    for (let i=0; i < files.length; i++){
                        await this.uploadFile(files[i]);
                    }
                    this.getItemDetails();
                }
                this.uploading_image = false;
            },

            async uploadFile(file){
                const fd = new FormData();
                if (file) {
                    fd.append("file", file, file.name);
                }
                fd.append("item_id", this.itemId);
                try {
                    const response = await InventoryService.uploadAdditionalImage(fd);
                    if (response.data.error === false) {
                    }
                    Errors.Notification(response);
                }catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },

            async deleteAdditionalImage(image_id){
                const response = await InventoryService.deleteAdditionalImage(image_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItemDetails();
                }
            }
        },
    }
</script>

<style scoped>

</style>
