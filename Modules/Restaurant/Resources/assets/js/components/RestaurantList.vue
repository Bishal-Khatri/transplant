<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <button @click.prevent="$refs.createRestaurant.openDialog()" class="btn btn-accent btn-block mt-1">Add New Restaurant</button>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group m-b-xs m-t-xs">
                                    <input type="text" class="form-control" placeholder="Search by Name.." aria-describedby="button-addon2" v-model="meta.filter"
                                           @keydown.enter="getRestaurants"
                                           @click:append="getRestaurants"
                                           @keypress="getRestaurants">
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
                                <th>Logo</th>
                                <th>Restaurant</th>
                                <th>Main User</th>
                                <th>Display Status</th>
                                <th style="width: 164px" class="text-right">
                                    <span class="float-left">Actions</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="restaurants.length" v-for="(value, index) in restaurants" :key="index">
                                <td>
                                    {{ value.id }}
                                </td>
                                <td>
                                    <img alt="image" class="rounded image-md" :src="'/storage/'+value.logo">
                                </td>
                                <td>
                                    <a href="#" >{{ value.name }}</a>
                                    <div class="small"><i class="fa fa-map-pin"></i> Address: {{ value.address || '-' }}</div>
                                </td>
                                <td>
                                    <template v-if="value.user">
                                        <div class="float-left mr-2">
                                            <img v-if="value.user.avatar" alt="image" class="rounded image-md text-left mr-1" :src="'/storage/'+value.user.avatar">
                                            <img v-else alt="image" class="rounded image-md text-left mr-1" src="/images/placeholder-dark.jpg">
                                        </div>
                                        <a href="#" >{{ value.user.name }}</a>
                                        <div class="small"><i class="fa fa-map-pin"></i> Email: {{ value.user.email || '-' }}</div>
                                    </template>
                                </td>
                                <td>
                                    <button class="btn btn-accent btn-rounded btn-sm" v-if="value.status === true">ENABLED</button>
                                    <button class="btn btn-accent btn-rounded btn-sm" v-else-if="value.status === false">DISABLED</button>
                                </td>
                                <td>
                                    <div class="btn-group pull-left">
                                        <a class="btn btn-default btn-xs" :href="'/restaurant/edit/'+value.id">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <button class="btn btn-default btn-xs" @click.prevent="showDeleteModal(value.id)">
                                            <i class="fa fa-trash text-danger"></i> Delete
                                        </button>
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
            <pagination :data="restaurants_pg" @pagination-change-page="getRestaurants"></pagination>
        </div>

        <!--<preview-item ref="previewItem"></preview-item>-->
        <create-restaurant ref="createRestaurant"/>

        <div class="modal fade" id="deleteRestaurantModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <form action="" id="deleteForm">
                            <button type="submit" class="btn btn-accent" @click.prevent="deleteRestaurant">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import CreateRestaurant from "./CreateRestaurant";
    import {Errors} from "../../../../../../resources/js/error";
    import {EventBus} from "../app";
    import RestaurantService from "../services/RestaurantService";

    export default {
        name: "RestaurantList",
        components: {
            CreateRestaurant,
        },
        data(){
            return{
                meta:{
                    filter: '',
                    category: '',
                    brand: '',
                },
                delete_id: '',

                restaurants: {},
                restaurants_pg: {},
            }
        },
        mounted() {
            this.getRestaurants();
            EventBus.$on('restaurantAdded', () => {
                this.getRestaurants();
            });
            EventBus.$on('restaurantDeleted', () => {
                this.getRestaurants();
            });
        },
        methods:{
            async getRestaurants(page=1){
                const response = await RestaurantService.getRestaurant(page,this.meta);
                this.restaurants_pg = response.data.data.restaurants;
                this.restaurants = response.data.data.restaurants.data;
            },

            showDeleteModal(restaurant_id){
                this.delete_id = restaurant_id;
                $("#deleteRestaurantModal").modal('show');
            },

            async deleteRestaurant(){
                const response = await RestaurantService.deleteRestaurant(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getRestaurants();
                    $("#deleteRestaurantModal").modal('hide');
                }
                this.delete_id = '';
            },
        }
    }
</script>

<style scoped>

</style>
