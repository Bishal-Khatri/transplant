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
                                    <li><a class="text-accent" href="#" @click.prevent="$refs.createEthnicGroup.openDialog()">Create New</a></li>
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
                            <tr v-if="!ethnicGroups.length">
                                <td colspan="2">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(EthnicGroup, index) in ethnicGroups" :key="index">
                                <td>
                                    <a class="mr-2" href="#" @click.prevent="$refs.createEthnicGroup.openDialog(EthnicGroup)">{{ EthnicGroup.title }}</a>
                                    <br>
                                    <small class="">Created on {{ EthnicGroup.created_at }}</small>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="#" @click.prevent="$refs.createEthnicGroup.openDialog(EthnicGroup)" class="btn btn-secondary btn-sm" type="button">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(EthnicGroup.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="ethnicGroups_pg" @pagination-change-page="getEthnicGroups"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-EthnicGroup ref="createEthnicGroup"></create-EthnicGroup>

        <div class="modal fade" id="delete-ethnicGroup-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete Ethnic Group</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteEthnicGroup">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CreateEthnicGroup from "./CreateEthnicGroups";
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";

    export default {
        name: "EthnicGroupIndex",
        components: {
            CreateEthnicGroup,
        },
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                delete_id: '',

                ethnicGroups: {},
                ethnicGroups_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getEthnicGroups();
            EventBus.$on('ethnicGroupCreated', () => {
                this.getEthnicGroups();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getEthnicGroups();
            }, 800),

            async getEthnicGroups(page = 1) {
                const response = await DataService.getEthnicGroups(page, this.filter);
                this.ethnicGroups_pg = response.data.data.ethnicGroups;
                this.ethnicGroups = response.data.data.ethnicGroups.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-ethnicGroup-dialog").modal('show');
            },

            async deleteEthnicGroup() {
                this.delete_submitting = true;
                const response = await DataService.deleteEthnicGroup(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getEthnicGroups();
                    $("#delete-ethnicGroup-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
        }
    }
</script>

<style scoped>

</style>
