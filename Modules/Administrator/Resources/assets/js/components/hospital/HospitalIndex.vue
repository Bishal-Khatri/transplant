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
                            <div class="col-md-3">
                                <select class="form-control" v-model="filter_by">
                                    <option value="">Filter By</option>
                                    <option value="HospitalTypes">Hospital Type</option>
                                    <option value="HospitalVerificationStatus">Verification Status</option>
                                    <option value="TransplantTypes">Transplant Type</option>
                                    <option value="HospitalApproveStatus">Approve Status</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createhospital.openDialog()">Create New</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Transplant Type</th>
                                <th>Hospital Type</th>
                                <th>Approved On</th>
                                <th>Accessibility</th>
                                <th>Licenses</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!hospitals.length">
                                <td colspan="7">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(hospital, index) in hospitals" :key="index">
                                <td>
                                    <a class="mr-2" href="#" @click.prevent="$refs.createhospital.openDialog(hospital)">{{ hospital.hospital_name }}</a>
                                    <small class="">Created on {{ hospital.created_at }}</small>
                                </td>
                                <td>{{ hospital.transplant_type }}</td>
                                <td>{{ hospitalTypesEnum[hospital.hospital_type-1] }}</td>
                                <td>{{ hospital.approved_by}}  {{ hospital.approved_date?"On "+hospital.approved_date:"" }}</td>
                                <td>{{ hospital.approve_status }}</td>
                                <td>{{ hospital.licenses_number }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <!-- view -->
                                        <a class="btn btn-sm btn-primary mr-2" href="#" @click.prevent="$refs.createhospital.openDialog(hospital)">
                                            <i class="fa fa-eye"></i>View
                                        </a>
                                        <!-- disable -->
                                        <a class="btn btn-sm btn-danger mr-2" href="#" @click.prevent="disableHospital(hospital)">
                                            <i class="fa fa-ban"></i>Disable
                                        </a>
                                        <a href="#" @click.prevent="showDeleteModal(hospital.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="hospitals_pg" @pagination-change-page="getHospitals"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="delete-hospital-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete hospital</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deletehospital">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";

    export default {
        name: "hospitalIndex",
        components: {
        },
        data(){
            return{
                hospitalTypesEnum: ['Government', 'Private'],
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                filter_by: '',
                delete_id: '',

                hospitals: {},
                hospitals_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getHospitals();
            EventBus.$on('hospitalCreated', () => {
                this.getHospitals();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getHospitals();
            }, 800),

            async getHospitals(page = 1) {
                const response = await DataService.getHospitals(page, this.filter,this.filter_by);
                this.hospitals_pg = response.data;
                this.hospitals = response.data.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-hospital-dialog").modal('show');
            },
        }
    }
</script>

<style scoped>

</style>
