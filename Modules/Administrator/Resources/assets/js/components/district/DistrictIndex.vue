<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                       placeholder="Search" v-model="filter"
                                       @keydown.backspace="setSearch"
                                       @keydown.enter="setSearch"
                                       @keypress="setSearch">
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createDistrict.openDialog()">Create New</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>District</th>
                                <th>Municipalities</th>
                                <th>Palikas</th>
                                <th style="width: 180px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!districts.length">
                                <td colspan="4">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(district, index) in districts" :key="index">
                                <td>
                                    <h4><a class="mr-2" href="#" @click.prevent="$refs.createDistrict.openDialog(district)">{{ district.title }}</a></h4>
                                    <!--<ul class="list-unstyled text-left">-->
                                        <!--<li>-->
                                            <!--<strong class="mr-2">Municipalities</strong>-->
                                            <!--<a :href="`${local_level_route}?district_id=${district.id}`"  class="btn-link">-->
                                                <!--{{ district.municipalities_count>1?`${ district.municipalities_count} Municipalities`:`${ district.municipalities_count}` }} View-->
                                            <!--</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<strong class="mr-2">Palikas</strong>-->
                                            <!--<a :href="`${local_level_route}?district_id=${district.id}`" class="btn-link">{{ district.palikas_count>1?`${ district.palikas_count}`:`${ district.palikas_count}` }} View</a>-->
                                        <!--</li>-->
                                        <!--<li> <small class="">Created on {{ district.created_at }}</small></li>-->
                                    <!--</ul>-->
                                    <!--<small class="">Created on {{ district.created_at }}</small>-->
                                </td>
                                <td>
                                     <a class="mr-2" :href="`${local_level_route}?district_id=${district.id}`"  >{{ district.municipalities_count>1?`${ district.municipalities_count} Municipalities`:`${ district.municipalities_count} Municipality` }} </a>
                                </td>
                                <td>
                                     <a class="mr-2" :href="`${local_level_route}?district_id=${district.id}`"  >{{ district.palikas_count>1?`${ district.palikas_count} Palikas`:`${ district.palikas_count} Palika` }} </a>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" @click.prevent="$refs.createDistrict.openDialog(district)" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(district.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="districts_pg" @pagination-change-page="getDistrict"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-district ref="createDistrict" :province_id="province_id"></create-district>

        <div class="modal fade" id="delete-district-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete District</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteDistrict">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import createDistrict from "./CreateDistrict";
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";

    export default {
        name: "districtIndex",
        props:[
            'province_id',
            'local_level_route'
        ],
        components: {
            createDistrict,
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                delete_id: '',
                districts: {},
                districts_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getDistrict();
            EventBus.$on('districtCreated', () => {
                this.getDistrict();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getDistrict();
            }, 800),

            async getDistrict(page = 1) {
                const response = await DataService.getDistrict(page, this.filter,this.province_id);
                this.districts_pg = response.data.data.districts;
                this.districts = response.data.data.districts.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-district-dialog").modal('show');
            },

            async deleteDistrict() {
                this.delete_submitting = true;
                const response = await DataService.deleteDistrict(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getDistrict();
                    $("#delete-district-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
        }
    }
</script>

<style scoped>

</style>
