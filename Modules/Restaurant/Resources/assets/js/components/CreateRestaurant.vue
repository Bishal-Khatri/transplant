<template>
    <div>
        <div class="modal fade" id="create-restaurant-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Register New Restaurant</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="logo" class="col-sm-3 col-form-label">Main Image
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="logo" class="form-control-file mb-1" @change.prevent="handelImage" name="image" accept="image/png, image/jpeg">
                                                    <small class="text-muted">Your image needs to be at least 500×500 pixels.</small>
                                                    <span class="form-text small text-danger" v-html="errors.get('logo')"></span>
                                                </div>
                                                <br>
                                            </div>
                                            <div class="form-group row">
                                                <label for="restaurant_name" class="col-sm-3 col-form-label">Restaurant name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="restaurant_name" class="form-control" id="restaurant_name" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('restaurant_name')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address" class="col-sm-3 col-form-label">Address
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="address" class="form-control" id="address" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('address')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="main_user" class="col-sm-3 col-form-label">
                                                    Main User
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" v-model="main_user_email" class="form-control" id="main_user" placeholder="Email address" >
                                                    <span class="form-text small text-danger" v-html="errors.get('user')"></span>
                                                    <span v-if="selected_user" class="label label-accent">{{ selected_user.name }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-accent btn-block" @click.prevent="getUser">Check</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <label> <input type="checkbox" v-model="continue_editing"> Continue editing </label>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveRestaurant">Save</button>
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
        name: "CreateRestaurant",
        props: {
        },
        components: {
        },
        data: () => ({
            errors: new Errors(),
            restaurant_name: "",
            id: "",
            logo: "",
            user_id: "",
            address: "",
            main_user_email: "",
            selected_user: "",
            continue_editing: false,
        }),
        computed:{
        },
        methods: {
            openDialog() {
                // if (value !== "") {
                //     this.id = value.id;
                //     this.restaurant_name = value.name;
                //     this.address = value.address;
                //     this.selected_user = value.user;
                // }
                $("#create-restaurant-dialog").modal("show");
            },
            async getUser() {
                if (this.main_user_email) {
                    try {
                        const response = await RestaurantService.getUserByEmail(this.main_user_email);
                        if (response.data.error === false) {
                            this.selected_user = response.data.data.user;
                            this.user_id = response.data.data.user.id;
                        }
                        this.main_user_email = '';
                    }catch (error) {
                        this.saveBtnLoading = false;
                        Errors.Notification(error.response);
                    }
                }
            },
            async saveRestaurant() {
                try {
                    let formData = new FormData();

                    formData.append("id", this.id);
                    formData.append("restaurant_name", this.restaurant_name);
                    formData.append("address", this.address);
                    formData.append("user", this.user_id);
                    if (this.logo) {
                        formData.append("logo", this.logo, this.logo.name);
                    }

                    const response = await RestaurantService.create(formData);
                    if (response.data.error === false) {
                        if (this.continue_editing && response.data.data.item) {
                            window.location.href = '/grocery/inventory/item/edit/' + response.data.data.item.id;
                        }
                        $("#create-restaurant-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.saveBtnLoading = false;
                } catch (error) {
                    this.saveBtnLoading = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('restaurantAdded');
            },

            handelImage(event) {
                this.logo = event.target.files[0];
            },
            clearForm() {
                this.errors.clear();
                this.id = this.restaurant_name = this.logo = this.user_id = this.main_user_email = this.selected_user = '';
            },
        }
    }
</script>

<style scoped>

</style>
