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
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createOccupation.openDialog()">Create New</a></li>
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
                            <tr v-if="!occupations.length">
                                <td colspan="2">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(occupation, index) in occupations" :key="index">
                                <td>
                                    <a class="mr-2" href="#" @click.prevent="$refs.createOccupation.openDialog(occupation)">{{ occupation.title }}</a>
                                    <small class="">Created on {{ occupation.created_at }}</small>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" @click.prevent="$refs.createOccupation.openDialog(occupation)" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(occupation.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="occupations_pg" @pagination-change-page="getOccupations"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-occupation ref="createOccupation"></create-occupation>

        <div class="modal fade" id="delete-occupation-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete occupation</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteOccupation">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import createOccupation from "./CreateOccupation";
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";

    export default {
        name: "occupationIndex",
        components: {
            createOccupation,
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                delete_id: '',

                occupations: {},
                occupations_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getOccupations();
            EventBus.$on('occupationCreated', () => {
                this.getOccupations();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getOccupations();
            }, 800),

            async getOccupations(page = 1) {
                const response = await DataService.getOccupations(page, this.filter);
                this.occupations_pg = response.data.data.occupations;
                this.occupations = response.data.data.occupations.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-occupation-dialog").modal('show');
            },

            async deleteOccupation() {
                this.delete_submitting = true;
                const response = await DataService.deleteOccupation(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getOccupations();
                    $("#delete-occupation-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
        }
    }
</script>

<style scoped>

</style>
