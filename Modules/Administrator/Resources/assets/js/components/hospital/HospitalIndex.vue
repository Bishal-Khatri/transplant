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
                                    <li><a style="color: #5A738E;" :href="create_route">Create New Hospital</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                       <div class="row mb-3">
                           <div class="col-md-12">
                               <div style="display: flex;" class="mb-2">
                                   <h4 class="mr-3">
                                       <i class="fa fa-filter mr-1"></i> Filter Options
                                   </h4>
                                   <button>Hospital Type: GOVERNMENT <i class="fa fa-times" @click.prevent="removeFilter"></i></button>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-hospital-type" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Hospital Type
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-hospital-type"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#">GOVERNMENT</a>
                                       <a class="dropdown-item" href="#" >PRIVATE</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-approval-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Approval Status
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-approval-status"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#">UNAPPROVED</a>
                                       <a class="dropdown-item" href="#" >APPROVED</a>
                                       <a class="dropdown-item" href="#" >REJECTED</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-verification-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Approval Status
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-verification-status"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#">NONE</a>
                                       <a class="dropdown-item" href="#">DOCUMENT_VERIFIED</a>
                                       <a class="dropdown-item" href="#">PHYSICAL_VERIFIED</a>
                                       <a class="dropdown-item" href="#">VERIFIED</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-transplant" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Transplant Type
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-transplant"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#">KIDNEY</a>
                                       <a class="dropdown-item" href="#" >LIVER</a>
                                   </div>
                               </div>
                               <!--<select class="form-control" v-model="filter_by">-->
                                   <!--<option value="">Filter By</option>-->
                                   <!--<option value="HospitalTypes">Hospital Type</option>-->
                                   <!--<option value="HospitalVerificationStatus">Verification Status</option>-->
                                   <!--<option value="TransplantTypes">Transplant Type</option>-->
                                   <!--<option value="HospitalApproveStatus">Approve Status</option>-->
                               <!--</select>-->
                           </div>
                           <!--<div class="col-md-3">-->
                               <!--<select class="form-control" v-model="filter_by_option" @change="getHospitals()">-->
                                   <!--<option value="" selected>Filter By Options</option>-->
                                   <!--<option v-for="(option, index) in filter_by_options" :key="index" :value="option.value">{{ option.text }}</option>-->
                               <!--</select>-->
                           <!--</div>-->
                       </div>
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
                                    <a class="mr-2" href="#" :href="`${route}/${hospital.id}`">{{ hospital.hospital_name }}</a><br>
                                    <small class="">Created on {{ hospital.created_at }}</small>
                                </td>
                                <td>{{ hospital.transplant_type.toUpperCase() }}</td>
                                <td>{{ hospitalTypesEnum[hospital.hospital_type-1] }}</td>
                                <td>
                                    {{ hospital.approve_status.toUpperCase() }} <br>
                                    {{ hospital.approved_by}}  {{ hospital.approved_date?"On "+hospital.approved_date:"" }}
                                </td>
                                <td>
                                    <span class="text-accent" v-if="hospital.status === 1">ENABLED</span>
                                    <span class="text-secondary" v-else>DISABLED</span>
                                </td>
                                <td>{{ hospital.licenses_number }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" :href="`${route}/${hospital.id}`">View / Edit</a>
                                            <a class="dropdown-item" href="#" @click.prevent="disableHospital(hospital)">Disable</a>
                                            <a class="dropdown-item" href="#" @click.prevent="showDeleteModal(hospital.id)">Delete</a>
                                        </div>
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
        props: ['route','create_route'],
        data(){
            return{
                hospitalTypesEnum: ['Government', 'Private'],
                filter_by_options: [],
                filter_by_option: '',
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                filter_by: '',
                delete_id: '',

                hospitals: {},
                hospitals_pg: {},
            }
        },
        watch:{
            filter_by(value){
                 console.log(this.filter_by_options);
                switch(value){
                    case 'HospitalTypes':
                        this.filter_by_options = [{
                            value: 1,
                            text: 'Government'
                        },{
                            value: 2,
                            text: 'Private'
                        }];
                        break;
                    case 'HospitalVerificationStatus':
                        this.filter_by_options = [
                            {
                                value: 0,
                                text: 'None'
                            },
                            {
                                value: 1,
                                text: 'Document Verified'
                            },
                                                        {
                                value: 2,
                                text: 'Physical Verified'
                            },
                            {
                                value: 3,
                                text: 'Verified'
                            }
                        ];
                        break;
                    case 'TransplantTypes':
                        this.filter_by_options =[
                            {
                                value: 'kidney',
                                text: 'Kidney'
                            },
                            {
                                value: 'liver',
                                text: 'Liver'
                            }
                        ];
                        break;
                    case 'HospitalApproveStatus':
                        this.filter_by_options = [
                            {
                                value: 0,
                                text: 'None'
                            },
                            {
                                value: 1,
                                text: 'Approved'
                            },
                            {
                                value: 2,
                                text: 'Rejected'
                            }
                        ];
                        break;
                    default:
                        this.filter_by_options = [];
                        break;
                }
            },
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
                const response = await DataService.getHospitals(page, this.filter,this.filter_by,this.filter_by_option);
                this.hospitals_pg = response.data;
                this.hospitals = response.data.data;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-hospital-dialog").modal('show');
            },

            removeFilter(){
                alert()
            }
        },

    }
</script>

<style scoped>

</style>
