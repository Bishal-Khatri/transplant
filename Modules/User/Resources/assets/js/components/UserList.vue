<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-8">
                                <button v-if="types" v-for="userType in types" class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === userType ? 'btn-primary':''" @click.prevent="getUsers(userType)">{{ userType.toUpperCase()}}</button>
                                <!--<button class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === '' || user_type === 'subscriber' ? 'btn-primary':''" @click.prevent="getUsers('subscriber')">Subscribers</button>-->
                                <!--<button class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === 'administrator' ? 'btn-primary':''" @click.prevent="getUsers('administrator')">Administrators</button>-->
                                <!--<button class="btn btn-lg btn-default btn-squared mt-2 mr-2" :class="user_type === 'restaurant' ? 'btn-primary':''" @click.prevent="getUsers('restaurant')">Restaurant</button>-->
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <button @click.prevent="$refs.createUser.openDialog()" class="btn btn-lg btn-accent btn-squared mt-2 btn-block">Register New User</button>
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
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Type</th>
                                <th>Roles</th>
                                <th>Created</th>
                                <th style="width: 180px" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="users.length <= 0">
                                <td colspan="8">No records found.</td>
                            </tr>
                            <tr v-else v-for="user in users" :key="user.id">
                                <td>
                                    {{ user.id  }}
                                </td>
                                <td>
                                    <img v-if="user.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+user.avatar">
                                    <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                </td>
                                <td>
                                    <a href="#" >{{ user.name || 'No Name' }}</a>
                                    <div class="small"><i class="fa fa-phone"></i> {{ user.phone_number || '-' }}</div>
                                </td>
                                <td>
                                    {{ user.email }}
                                </td>
                                <td>
                                    <span class="label label-primary">{{ user.user_type.toUpperCase() }}</span>
                                    <!--<span v-if="user.user_type === 'administrator'" class="label label-primary">ADMINISTRATOR</span>-->
                                    <!--<span v-if="user.user_type === 'restaurant'" class="label label-primary">RESTAURANT</span>-->
                                </td>
                                <td>
                                    <span v-if="user.roles.length" v-for="role in user.roles" class="label label-default">{{ role.name.toUpperCase() }}</span>
                                    <span v-else>Unavailable</span>
                                </td>
                                <td>
                                    {{ user.created_at }}
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
                </div>
            </div>
        </div>
        <div class="pull-right">
            <pagination :data="users_pg" @pagination-change-page="getUsers"></pagination>
        </div>

        <create-user ref="createUser" :types="types" :roles="roles"/>
    </div>
</template>

<script>
    import {EventBus} from "../app";
    import UserService from "../../services/UserService";
    import CreateUser from "./CreateUser";

    export default {
        name: "UserList",
        props:[
            'types'
        ],
        components: {
            CreateUser,
        },
        data(){
            return{
                page: 1,
                filter: '',
                user_type: '',

                roles:{},
                users:{},
                users_pg:{},
            }
        },
        mounted(){
            this.getUsers('subscriber');
            EventBus.$on('userAdded', () => {
                this.getUsers(this.user_type);
            });
        },
        methods:{
            async getUsers(user_type = ''){
                this.user_type = user_type;

                const response = await UserService.getUsers(this.page, this.filter, this.user_type);
                this.users_pg = response.data.data.users;
                this.users = response.data.data.users.data;
                this.roles = response.data.data.roles;
            }
        }
    }
</script>

<style scoped>

</style>
