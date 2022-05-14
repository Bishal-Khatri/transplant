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
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createProvince.openDialog()">Create New</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th style="width: 180px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!provinces.length">
                                <td colspan="3">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(province, index) in provinces" :key="index">
                                <td>
                                    <h4><a class="mr-2" href="#" @click.prevent="$refs.createProvince.openDialog(province)">{{ province.title }}</a></h4>
                                    <ul class="list-unstyled text-left">
                                        <li>
                                            <strong class="mr-2">Districts</strong>
                                            <a :href="`${district_path}?province_id=${province.id}`" class="btn-link">{{ province.districts_count>1?`${ province.districts_count} Districts`:`${ province.districts_count}` }} View</a>
                                        </li>
                                        <li> <small class="">Created on {{ province.created_at }}</small></li>
                                    </ul>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" @click.prevent="$refs.createProvince.openDialog(province)" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(province.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="provinces_pg" @pagination-change-page="getProvince"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-province ref="createProvince"></create-province>

        <div class="modal fade" id="delete-province-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete Province</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteProvince">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import createProvince from "./CreateProvince";
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";

    export default {
        props:[
            'district_path'
        ],
        name: "provinceIndex",
        components: {
            createProvince,
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                delete_id: '',

                provinces: {},
                provinces_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getProvince();
            EventBus.$on('provinceCreated', () => {
                this.getProvince();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getProvince();
            }, 800),

            async getProvince(page = 1) {
                const response = await DataService.getProvince(page, this.filter);
                this.provinces_pg = response.data.data.provinces;
                this.provinces = response.data.data.provinces.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-province-dialog").modal('show');
            },

            async deleteProvince() {
                this.delete_submitting = true;
                const response = await DataService.deleteProvince(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getProvince();
                    $("#delete-province-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
        }
    }
</script>

<style scoped>

</style>
