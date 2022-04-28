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
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="" v-model="user_id" data-placeholder="Select Main User">
                                                        <option v-if="users" v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                                                    </select>
                                                    <span class="form-text small text-danger" v-html="errors.get('user')"></span>

                                                    <!--<input type="text" v-model="main_user_email" class="form-control" id="main_user" placeholder="Email address" >-->
                                                    <!--<span v-if="selected_user" class="label label-accent">{{ selected_user.name }}</span>-->
                                                    <!--<small class="text-accent">Validate user email address before submitting.</small>-->
                                                </div>
                                                <!--<div class="col-md-3">-->
                                                    <!--<button class="btn btn-accent" v-if="user_submitting"><i class="fa fa-spinner fa-spin"></i></button>-->
                                                    <!--<button class="btn btn-accent btn-block" @click.prevent="getUser" v-else>Validate</button>-->
                                                <!--</div>-->
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
                        <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveRestaurant" v-else>Save</button>
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
        props: [
            'users'
        ],
        components: {
        },
        data: () => ({
            errors: new Errors(),
            user_submitting: false,
            submitting: false,
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
                $("#create-restaurant-dialog").modal("show");
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
            async saveRestaurant() {
                this.submitting = true;
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
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('restaurantAdded');
                this.submitting = false;
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
