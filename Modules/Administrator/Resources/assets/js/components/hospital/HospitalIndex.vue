<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                       placeholder="Search" v-model="filter.query"
                                       @keydown.backspace="setSearch"
                                       @keydown.enter="setSearch"
                                       @keypress="setSearch">
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="text-accent" :href="create_route">Create New Hospital</a></li>
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

                                   <button v-if="filter.hospital_type">Hospital Type: 
                                      <span v-if="filter.hospital_type===1">Government</span>
                                      <span v-else-if="filter.hospital_type===2">Private</span>
                                      <span v-else> All</span>
                                     <i class="fa fa-times" @click.prevent="filter.hospital_type='';getHospitals();"></i>
                                    </button>
                                    <!--  transplant_type -->
                                    <button v-if="filter.transplant_type">Transplant Type: 
                                      <span v-if="filter.transplant_type==='kidney'">Kidney</span>
                                      <span v-else-if="filter.transplant_type==='liver'">Liver</span>
                                      <span v-else> All</span>
                                        <i class="fa fa-times" @click.prevent="filter.transplant_type='';getHospitals();"></i>
                                    </button>
                                    <!-- approval status -->
                                    <button v-if="filter.approval_status">Approval Status: 
                                      <span v-if="filter.approval_status==='approved'">Approved</span>
                                      <span v-else-if="filter.approval_status==='unapproved'">Un Approved</span>
                                        <span v-else> Rejected</span>
                                        <i class="fa fa-times" @click.prevent="filter.approval_status='';getHospitals();"></i>
                                    </button>
                                    <!-- physical_verification -->
                                    <button v-if="filter.physical_verification">Physical Verification: 
                                      <span v-if="filter.physical_verification===1">Verified</span>
                                      <span v-else-if="filter.physical_verification===2">Not Verified</span>
                                        <span v-else> All</span>
                                        <i class="fa fa-times" @click.prevent="filter.physical_verification='';getHospitals();"></i>
                                    </button>
                                    <!-- documentation_verification -->
                                    <button v-if="filter.document_verification">Documentation Verification: 
                                      <span v-if="filter.document_verification===1">Verified</span>
                                      <span v-else-if="filter.document_verification===2">Not Verified</span>
                                        <span v-else> All</span>
                                        <i class="fa fa-times" @click.prevent="filter.document_verification='';getHospitals();"></i>
                                    </button>
                                    <!-- clear all -->
                                    <a v-if="filter.hospital_type!='' || filter.transplant_type!='' || filter.approval_status !='' || filter.physical_verification !='' || filter.document_verification !=''"  href="#" @click.prevent="clearFilter();getHospitals();">Clear All</a>
                                    
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-hospital-type" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                       Hospital Type
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-hospital-type"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#" @click.prevent="filter.hospital_type=1;getHospitals();">GOVERNMENT</a>
                                       <a class="dropdown-item" href="#" @click.prevent="filter.hospital_type=2;getHospitals();">PRIVATE</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-approval-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Approval Status
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-approval-status"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#" @click.prevent="filter.approval_status='unapproved';getHospitals();">UNAPPROVED</a>
                                       <a class="dropdown-item" href="#" @click.prevent="filter.approval_status='approved';getHospitals();">APPROVED</a>
                                       <a class="dropdown-item" href="#"  @click.prevent="filter.approval_status='rejected';getHospitals();">REJECTED</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-verification-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Approval Status
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-verification-status"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#" @click.prevent="filter.physical_verification=0;filter.document_verification=1;getHospitals();">DOCUMENT_VERIFIED</a>
                                       <a class="dropdown-item" href="#" @click.prevent="filter.document_verification=0;filter.physical_verification=1;getHospitals();">PHYSICAL_VERIFIED</a>
                                       <a class="dropdown-item" href="#" @click.prevent="filter.document_verification=1;filter.physical_verification=1;getHospitals();">VERIFIED</a>
                                   </div>
                               </div>

                               <div class="btn-group" role="group">
                                   <button id="filter-transplant" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Transplant Type
                                   </button>
                                   <div class="dropdown-menu" aria-labelledby="filter-transplant"
                                        x-placement="bottom-start"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                       <a class="dropdown-item" href="#" @click.prevent="filter.transplant_type='kidney';getHospitals();">KIDNEY</a>
                                       <a class="dropdown-item" href="#" @click.prevent="filter.transplant_type='liver';getHospitals();" >LIVER</a>
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
                                    <a class="mr-2" href="#" :href="'/admin/hospital-display/'+hospital.id">{{ hospital.hospital_name }}</a><br>
                                    <small class="">Created on {{ hospital.created_at }}</small>
                                </td>
                                <td>{{ hospital.transplant_type.toUpperCase() }}</td>
                                <td>{{ hospitalTypesEnum[hospital.hospital_type-1] }}</td>
                                <td>
                                    <span :class="hospital.approve_status === 'unapproved' ? 'text-danger' : 'text-accent'">{{ hospital.approve_status.toUpperCase() }}</span> <br>
                                   <small v-if="hospital.approve_status === 'approved'">
                                       Approved By: {{ hospital.approved_by_user ? hospital.approved_by_user.name : 'Not-Available' }} {{ hospital.approved_date?"On "+hospital.approved_date:"" }}
                                   </small>
                                </td>
                                <td>
                                    <span class="text-accent" v-if="hospital.status === 1">Enabled</span>
                                    <span class="text-danger" v-else>Disabled</span>
                                </td>
                                <td>{{ hospital.licenses_number }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" :href="'/admin/hospital-display/'+hospital.id">View / Edit</a>
                                            <a class="dropdown-item text-danger" href="#" @click.prevent="clicked_hospital = hospital; $refs.hospitalStatus.changeStatus('accessibility ', 0)" v-if="hospital.status === 1">Disable Login</a>
                                            <a class="dropdown-item" href="#" @click.prevent="clicked_hospital = hospital; $refs.hospitalStatus.changeStatus('accessibility ', 1)" v-else>Enable Login</a>
                                            <a class="dropdown-item text-danger" href="#" @click.prevent="showDeleteModal(hospital.id)">Delete</a>
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

        <change-hospital-status ref="hospitalStatus" :hospital="clicked_hospital"/>
    </div>
</template>

<script>
    import DataService from "../../../services/DataService";
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";
    import ChangeHospitalStatus from "./ChangeHospitalStatus";

    export default {
        name: "hospitalIndex",
        components: {
            ChangeHospitalStatus
        },
        props: ['route','create_route'],
        data(){
            return{
                hospitalTypesEnum: ['Government', 'Private'],
                filter_by_options: [],
                filter_by_option: '',
                errors: new Errors(),
                delete_submitting: false,
                filter:{
                    query: '',
                    hospital_type: '',
                    transplant_type: '',
                    approval_status: '',
                    physical_verification: '',
                    document_verification: '',
                },
                filter_by: '',
                delete_id: '',

                hospitals: {},
                hospitals_pg: {},

                clicked_hospital: "",

                // filters
                hospital_type: "",
                approval_status: "",
                document_approval_status: "",
                transplant_type: "",
                last_page:1,
                filter_options: {
                    hospital_type: {},
                    approval_status: [],
                    document_approval_status: [],
                    transplant_type: []
                },
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
            EventBus.$on('hospitalStatusChanged', () => {
                this.getHospitals();
            });
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getHospitals();
            }, 800),

            async getHospitals(page = 1) {
                const response = await DataService.getHospitals(page,this.filter);
                this.hospitals_pg = response.data;
                this.hospitals = response.data.data;
                this.last_page = response.data.last_page;
            },

            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-hospital-dialog").modal('show');
            },

            changeStatus(status) {
                this.delete_id = item_id;
                $("#delete-hospital-dialog").modal('show');
            },

            removeFilter(){
                alert()
            },
            updateFilter(key,value) {
                switch (key) {
                    case 'hospital_type':
                        this.filter_by='HospitalTypes';
                        this.filter_by_option = value;
                        this.filter_options.hospital_type ={
                            filter_by:'HospitalTypes',
                            filter_by_option:value
                        };
                        break;
                    case 'approval_status':
                        this.filter_by='HospitalApproveStatus';
                        this.filter_by_option = value;
                        this.filter_options.approval_status ={
                            filter_by:'HospitalApproveStatus',
                            filter_by_option:value
                        };
                        break;
                    case 'document_approval_status':
                        this.filter_by='HospitalVerificationStatus';
                        this.filter_by_option = value;
                        this.filter_options.document_approval_status ={
                            filter_by:'HospitalVerificationStatus',
                            filter_by_option:value
                        };
                        break;
                    case 'transplant_type':
                        this.filter_by='TransplantTypes';
                        this.filter_by_option = value;
                        this.filter_options.transplant_type ={
                            filter_by:'TransplantTypes',
                            filter_by_option:value
                        };
                        break;
                }
                this.getHospitals();
            }
            ,clearFilter(){
                this.filter={
                    query: '',
                    hospital_type: '',
                    transplant_type: '',
                    approval_status: '',
                    physical_verification: '',
                    document_verification: '',
                };
            }
            ,checkFilter(){
                if( this.filter.hospital_type === '' || this.filter.approval_status === '' || this.filter.document_approval_status === '' || this.filter.transplant_type === ''){
                    return true;
                }
                return false;
            }
        },

    }
</script>

<style scoped>

</style>
