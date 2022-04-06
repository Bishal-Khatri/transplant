<template>
    <div>
        <div class="modal fade" id="create-user-dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title">Register New User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <form class="form-group">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-3 col-form-label">Full Name
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="name" class="form-control" id="name" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('name')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email" class="col-sm-3 col-form-label">Email Address
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="email" v-model="email" class="form-control" id="email" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('email')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="contact" class="col-sm-3 col-form-label">Contact
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" v-model="contact" class="form-control" id="contact" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('contact')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="user_type" class="col-sm-3 col-form-label">User Type</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="user_type" value="ADMINISTRATOR" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-sm-3 col-form-label">Password
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="password" v-model="password" class="form-control" id="password" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('password')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="password" v-model="password_confirmation" class="form-control" id="password_confirmation" required>
                                                    <span class="form-text small text-danger" v-html="errors.get('password_confirmation')"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="role" class="col-sm-3 col-form-label">Role
                                                    <span style="font-size: 18px" class="text-danger">*</span>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select v-model="role" id="role" class="form-control">
                                                        <option value="">Select A Role</option>
                                                        <option v-if="roles.length" v-for="value in roles" :value="value.id">{{ value.name.toUpperCase() }}</option>
                                                    </select>
                                                    <span class="form-text small text-danger" v-html="errors.get('role')"></span>
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
                        <button class="btn btn-accent" v-if="submitting"><i class="fa fa-spinner fa-spin"></i></button>
                        <button type="button" class="btn btn-accent" @click.prevent="saveUser" v-else>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../app';
    import {Errors} from "../../../../../../resources/js/error";
    import UserService from "../../services/UserService";

    export default {
        name: "CreateUser",
        props: ['roles'],
        data: () => ({
            errors: new Errors(),
            submitting: false,
            id: "",
            name: "",
            email: "",
            contact: "",
            password: "",
            password_confirmation: "",
            role: "",
        }),
        methods: {
            openDialog() {
                $("#create-user-dialog").modal("show");
            },
            async saveUser() {
                this.submitting = true;
                try {
                    const formData = {
                        name: this.name,
                        email: this.email,
                        contact: this.contact,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        role: this.role,
                    };

                    const response = await UserService.create(formData);
                    if (response.data.error === false) {
                        $("#create-user-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('userAdded');
                this.submitting = false;
            },

            clearForm() {
                this.errors.clear();
                this.id = this.name = this.email = this.password = this.password_confirmation = this.role = this.contact = '';
            },
        }
    }
</script>

<style scoped>

</style>
