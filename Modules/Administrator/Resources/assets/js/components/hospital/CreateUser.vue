<template>
    <div class="">
        <form action="">
            <!-- login info -->
            <h2>Login Credentials</h2>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                    Full Name
                    <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                    <input type="text" class="form-control" placeholder="" v-model="name">
                    <span class="form-text text-danger" v-html="errors.get('name')"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                    Email Address
                    <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                    <input type="text" class="form-control" placeholder="" v-model="email">
                    <span class="form-text text-danger" v-html="errors.get('email')"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                    Password
                    <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                    <input type="password" class="form-control" id="password" v-model="password" placeholder="" />
                    <span class="form-text text-danger" v-html="errors.get('password')"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                    Confirm Password
                    <span class="required">*</span>
                </label>
                <div class="col-md-9 col-sm-9">
                    <input type="password" class="form-control" id="confirm_password" v-model="confirm_password" placeholder="" />
                    <span class="form-text text-danger" v-html="errors.get('password')"></span>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";

    export default {
        name: "CreateUser",
        data(){
            return{
                errors: new Errors(),

                name:'',
                email:'',
                password:'',
                confirm_password:'',
            }
        },
    }
</script>

<style scoped>

</style>
