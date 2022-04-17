<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <!--<button class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === '' || user_type === 'subscriber' ? 'btn-primary':''" @click.prevent="getRoles">Subscribers</button>-->
                                <!--<button class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === 'administrator' ? 'btn-primary':''" @click.prevent="getRoles">Administrators</button>-->
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <!--<button v-if="user_type === 'administrator'" @click.prevent="$refs.createUser.openDialog()" class="btn btn-lg btn-accent btn-squared mt-2 btn-block">Register New User</button>-->
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Unique ID" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                        <th style="width: 180px" class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-if="roles.length <= 0">
                                        <td colspan="4">No records found.</td>
                                    </tr>
                                    <tr v-else v-for="role in roles" :key="role.id">
                                        <td>
                                            {{ role.id  }}
                                        </td>
                                        <td>
                                            <a href="#" >{{ role.name || 'No Name' }}</a>
                                        </td>
                                        <td>
                                            {{ role.created_at }}
                                        </td>
                                        <td>
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-default btn-xs" @click.prevent=""><i class="fa fa-folder"></i> View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<create-user ref="createUser" :roles="roles"/>-->
    </div>
</template>

<script>
    import {EventBus} from "../app";
    import UserService from "../../services/UserService";
    // import CreateUser from "./CreateUser";

    export default {
        name: "RoleList",
        components: {
            // CreateUser,
        },
        data(){
            return{
                page: 1,
                filter: '',

                roles:{},
            }
        },
        mounted(){
            this.getRoles();
            EventBus.$on('roleAdded', () => {
                this.getRoles();
            });
        },
        methods:{
            async getRoles(){
                const response = await UserService.getRoles(this.page, this.filter);
                this.roles = response.data.data.roles;
            }
        }
    }
</script>

<style scoped>

</style>
