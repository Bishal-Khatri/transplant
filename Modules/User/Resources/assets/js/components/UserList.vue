<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-9">
                                <button v-if="types" v-for="userType in types" class="btn btn-sm btn-default btn-squared mt-2 mr-2" :class="user_type === userType ? 'btn-accent':''" @click.prevent="getUsers(userType)">{{ userType.toUpperCase()}}</button>
                            </div>
                            <div class="col-md-3">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="text-accent" href="#" @click.prevent="$refs.createUser.openDialog()">Register New User</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Type</th>
                                <!--<th>Roles</th>-->
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
                                    <a href="#" >{{ user.name || 'Not-Available' }}</a>
                                    <div class="small"><i class="fa fa-phone"></i> {{ user.phone_number || 'Not-Available' }}</div>
                                </td>
                                <td>
                                    {{ user.email || 'Not-Available' }}
                                </td>
                                <td>
                                    <span class="label label-primary">{{ user.user_type.toUpperCase() }}</span>
                                </td>
                                <!--<td>-->
                                    <!--<span v-if="user.roles.length" v-for="role in user.roles" class="label label-default">{{ role.name.toUpperCase() }}</span>-->
                                    <!--<span v-else>Not-Available</span>-->
                                <!--</td>-->
                                <td>
                                    {{ user.created_at }}
                                </td>
                                <td>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-default btn-sm" @click.prevent=""><i class="fa fa-folder"></i> View Details</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="users_pg" @pagination-change-page="getUsers"></pagination>
                        </div>
                    </div>
                </div>
            </div>
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
            this.getUsers('administrator');
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
