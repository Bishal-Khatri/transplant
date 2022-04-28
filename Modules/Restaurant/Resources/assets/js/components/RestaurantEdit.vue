<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Restaurant Details
                    </div>
                    <div class="panel-body">
                        <form method="POST" enctype="multipart/form-data" @submit.prevent="saveRestaurant">
                            <div class="form-group mb-4">
                                <label for="restaurant_name">Restaurant Name <span style="font-size: 18px" class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="restaurant_name" placeholder="Restaurant Name" v-model="restaurant_name" required>
                                <span class="form-text small text-danger" v-html="errors.get('restaurant_name')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <label for="restaurant_name">Display Status</label>
                                <input type="checkbox" class="js-switch" v-model="status" :checked="status" />
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
                                <input type="file" id="main-image" class="form-control-file mb-1" style="width:200px" name="image" accept="image/png, image/jpeg" @change="handelImage">
                                <img v-if="main_image_url" :src="main_image_url" alt="" name="image" class="rounded image-xl">
                                <img v-else src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Description</label>
                                <textarea class="form-control summernote" rows="3" v-model="description" id="description"></textarea>
                                <span class="form-text small text-danger" v-html="errors.get('description')"></span>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="main_user">
                                            Main User
                                            <span style="font-size: 18px" class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" id="main_user" v-model="user_id" data-placeholder="Select Main User">
                                            <option v-if="users" v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                                        </select>
                                        <span class="form-text small text-danger" v-html="errors.get('user')"></span>

                                        <!--<input type="text" v-model="main_user_email" class="form-control" id="main_user" placeholder="Email address" >-->
                                        <!--<small class="text-accent">Validate user email address before submitting.</small>-->
                                        <!--<span class="form-text small text-danger" v-html="errors.get('user')"></span>-->
                                    </div>
                                    <!--<div class="col-md-3 " style="margin-top: 34px">-->
                                        <!--<button class="btn btn-accent" v-if="user_submitting"><i class="fa fa-spinner fa-spin"></i></button>-->
                                        <!--<button class="btn btn-accent btn-block" @click.prevent="getUser" v-else>Validate</button>-->
                                    <!--</div>-->
                                    <!--<div class="col-md-3">-->
                                        <!--<h5>Main User</h5>-->
                                        <!--<p v-if="selected_user" class="label label-accent text-dark">{{ selected_user.name }}</p>-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <a href="/grocery/item" class="btn btn-default">Discard</a>
                            <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                            <button type="submit" class="btn btn-accent" v-else>Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!--<div class="panel panel-filled">-->
                    <!--<div class="panel-heading">-->
                        <!--Amenities-->
                    <!--</div>-->
                    <!--<div class="panel-body">-->
                        <!--<div class="row">-->
                            <!--<div class="col-md-6">-->
                                <!--<select class="amenity-select2 form-control" style="width: 100%; color:white" id="amenities" v-model="selected_amenity">-->
                                    <!--<option v-if="amenities.length" v-for="value in amenities" :value="value.id">{{ value.name }}</option>-->
                                <!--</select>-->
                                <!--<span class="form-text small text-danger" v-html="errors.get('amenities')"></span>-->
                            <!--</div>-->
                            <!--<div class="col-md-6">-->
                                <!--<h5>Selected Amenities</h5>-->
                                <!--<p class="label label-accent text-dark">Free Wifi <a href=""><i class="fa fa-times text-dark"></i></a></p>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->


                <div class="panel panel-filled">
                    <div class="panel-heading">
                        Menu
                        <button class="btn btn-default btn-xs float-right" @click.prevent="$refs.addItem.openDialog(restaurant)">
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
                            <tr v-for="value in menu" :key="value.id">
                                <td class="">
                                    <img v-if="value.image" :src="'/storage/'+value.image" alt="" name="image" class="rounded image-md">
                                    <img v-else src="/images/placeholder-dark.jpg" alt="" name="image" class="rounded image-md">
                                </td>
                                <td class=""><code>{{ value.name }}</code></td>
                                <td class=""><code>Rs.{{ value.price }}</code></td>
                                <td class=""><code>{{ value.category.name || '' }}</code></td>
                                <td class="text-right">
                                    <button class="btn btn-default btn-xs" @click.prevent="showDelete(value.id)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteMenu">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <add-item ref="addItem" :categories="categories"/>
    </div>
</template>

<script>
    import {EventBus} from "../app";
    import {Errors} from "../../../../../../resources/js/error";
    import AddItem from "./AddItem";
    import RestaurantService from "../services/RestaurantService";

    export default {
        name: "RestaurantEdit",
        components: {
            AddItem
        },
        props: [
            'restaurant',
            'categories',
            'amenities',
            'users',
        ],
        data: () => ({
            errors: new Errors(),
            user_submitting: false,
            submitting: false,
            delete_menu_id: '',
            uploading_image: false,
            // form data
            restaurant_name:'',
            address: '',
            latitude: '',
            longitude: '',
            user_id: '',
            main_image_url: '',
            description: '',
            // main_user_email: '',
            status: '',
            // selected_user: '',

            images:[],
            selected_amenity:'',
            menu:[],
        }),
        computed:{
        },
        async mounted(){
            var vm = this;
            await this.setItemData();
            $(".amenity-select2").select2().on('change', function (e) {
                vm.selected_amenity = e.target.value;
                vm.addAmenities()
            });
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ]
            });
            EventBus.$on('quantityAdded', () => {
                this.getItemDetails();
            });
            EventBus.$on('quantityDeleted', () => {
                this.getItemDetails();
            });

            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem, { color: '#f6a821',size: 'small'});
        },
        methods: {
            async addAmenities() {
                try {
                    const formData = {
                        restaurant_id: this.restaurant.id,
                        amenity_id: this.selected_amenity
                    };
                    const response = await RestaurantService.addAmenity(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                }catch (error) {
                    this.saveBtnLoading = false;
                    Errors.Notification(error.response);
                }
            },
            // async getUser() {
            //     this.user_submitting = true;
            //     if (this.main_user_email) {
            //         try {
            //             const response = await RestaurantService.getUserByEmail(this.main_user_email);
            //             if (response.data.error === false) {
            //                 this.selected_user = response.data.data.user;
            //                 this.user_id = response.data.data.user.id;
            //             }
            //             this.main_user_email = '';
            //         }catch (error) {
            //             this.saveBtnLoading = false;
            //             Errors.Notification(error.response);
            //         }
            //     }
            //     this.user_submitting = false;
            // },
            setItemData(){
                this.restaurant_name = this.restaurant.name;
                this.status = this.restaurant.status;
                this.description = this.restaurant.description;
                this.latitude = this.restaurant.latitude;
                this.longitude = this.restaurant.longitude;
                this.address = this.restaurant.address;
                this.menu = this.restaurant.menu;
                // this.selected_user = this.restaurant.user;
                this.user_id = this.restaurant.user.id;

                if (this.restaurant.logo){
                    this.main_image_url = '/storage/' + this.restaurant.logo;
                }
            },

            async saveRestaurant() {
                this.submitting = true;
                try {
                    let formData = new FormData();
                    formData.append("id", this.restaurant.id);
                    formData.append("restaurant_name", this.restaurant_name);
                    formData.append("address", this.address);
                    this.latitude ? formData.append("latitude", this.latitude) : '';
                    this.longitude ? formData.append("longitude", this.longitude) : '';
                    formData.append("user", this.user_id);
                    formData.append("status", this.status);

                    var description = $("#description").val();
                    description ? formData.append("description", description): '';

                    if (this.category_id){
                        formData.append("category_id", this.category_id);
                    }
                    if (this.brand_id) {
                        formData.append("brand_id", this.brand_id);
                    }
                    if(this.main_image){
                        formData.append("main_image", this.main_image, this.main_image.name);
                    }

                    const response = await RestaurantService.create(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                        // window.location.reload();
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.submitting = false;
            },

            handelImage(event){
                this.main_image = event.target.files[0];
                this.item_image_url = URL.createObjectURL(event.target.files[0]);
            },

            async showDelete(delete_id){
                this.delete_menu_id = delete_id;
                $("#deleteMenuModal").modal("show");
            },
            async hideDelete(){
                this.delete_menu_id = '';
                $("#deleteMenuModal").modal("hide");
            },

            async deleteMenu(){
                const response = await RestaurantService.deleteMenu(this.delete_menu_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    window.location.reload();
                }
            }
        },
    }
</script>

<style scoped>

</style>
