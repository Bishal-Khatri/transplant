<template>
    <div>
        <template v-if="hospital_details_loading">
            <div class="row">
                <div class="col-md-12 ">
                    <section class="x_panel" >
                        <div class="panel-body d-flex justify-content-center align-items-center" style="height: 80vh;">
                            <i class="fa fa-spinner fa-spin " style=""></i>
                        </div>
                    </section>
                </div>
            </div>
        </template>

        <template v-else>
            <div class="row">
                <div class="col-md-8">

                    <section class="x_panel">
                        <div class="x_title row">
                            <h2 class="col-md-3">Hospital Name</h2>
                            <h2 class="text-accent col-md-9">{{ hospital.hospital_name }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="project_detail ml-1">
                                <p class="title">General Details</p>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Hospital Type
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control"  v-if="hospital.hospital_type === 1"  value="GOVERNMENT" readonly/>
                                        <input v-else  value="PRIVATE" class="form-control" readonly/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Transplant Type
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control" :value="hospital.transplant_type ? hospital.transplant_type.toUpperCase() : ''" readonly/>
                                    </div>
                                </div>
                                <br>
                                <p class="title">Address</p>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Province
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control" :value="hospital.province ? hospital.province.title : 'Not-Available'" readonly/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        District
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control" :value="hospital.district ? hospital.district.title : 'Not-Available'" readonly/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Municipality
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control" :value="hospital.municipality ? hospital.municipality.title : 'Not-Available'" readonly/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Palika
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input class="form-control" :value="hospital.palika_name || 'Not-Available'" readonly/>
                                    </div>
                                </div>

                                <br>
                                <p class="title">Files & Documents</p>
                                <hr>
                                <ul class="list-unstyled project_files">
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">
                                            <i class="fa fa-file"></i> Application Letter
                                            <i :class="hospital.application_letter ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""  @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">
                                            <i class="fa fa-file"></i> Human Resource
                                            <i :class="hospital.human_resource ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tools_list}`)">
                                            <i class="fa fa-file"></i> Tools & Equipment list
                                            <i :class="hospital.tools_list ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.administrative_document}`)">
                                            <i class="fa fa-file"></i> Administrative Document
                                            <i :class="hospital.administrative_document ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.sanchalan_swikriti}`)">
                                            <i class="fa fa-file"></i> Sanchalan Swikriti
                                            <i :class="hospital.sanchalan_swikriti ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.renewal_letter}`)">
                                            <i class="fa fa-file"></i> Renewal Letter
                                            <i :class="hospital.renewal_letter ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.pan}`)">
                                            <i class="fa fa-file"></i> PAN
                                            <i :class="hospital.pan ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tax_clearance}`)">
                                            <i class="fa fa-file"></i> Tax Clearance
                                            <i :class="hospital.tax_clearance ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                </ul>

                                <br>
                                <p class="title">Status</p>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Accessibility
                                        <i type="button" class="fa fa-info-circle text-info"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Access user can login to the portal if enabled."></i>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="btn-group" role="group">
                                            <button id="status" type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span v-if="hospital.status === 1"><i class="mr-1 fa fa-check"></i>Enabled</span>
                                                <span v-else><i class="mr-1 fa fa-times"></i>Disabled</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="status"
                                                 x-placement="bottom-start"
                                                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('accessibility ', 1)">Enable</a>
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('accessibility ', 0)">Disable</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Document Verification
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="btn-group" role="group">
                                            <button id="verification" type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span v-if="hospital.document_verification === 1"><i class="mr-1 fa fa-check"></i>Verified</span>
                                                <span v-else><i class="mr-1 fa fa-times"></i>Not-Verified</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="verification"
                                                 x-placement="bottom-start"
                                                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('document_verification ', 0)">Not-Verified</a>
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('document_verification ', 1)">Verified</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Physical Verification
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="btn-group" role="group">
                                            <button id="physical_verification" type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span v-if="hospital.physical_verification === 1"><i class="mr-1 fa fa-check"></i>Verified</span>
                                                <span v-else><i class="mr-1 fa fa-times"></i>Not-Verified</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="verification"
                                                 x-placement="bottom-start"
                                                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('physical_verification', 0)">Not-Verified</a>
                                                <a class="dropdown-item" href="#" @click.prevent="$refs.hospitalStatus.changeStatus('physical_verification', 1)">Verified</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Approval status
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <template v-if="hospital.approve_status === 'approved'">
                                            <span class="btn btn-sm btn-accent"><i class="mr-1 fa fa-check"></i>Approved</span>
                                        </template>
                                        <template v-else-if="hospital.approve_status === 'rejected'">
                                            <span class="btn btn-sm btn-accent"><i class="mr-1 fa fa-times"></i>Rejected</span>
                                            <br>
                                            <label for="">Reject Message</label>
                                            <textarea name=""  class="form-control" style="border-color: red;" readonly>{{ hospital.reject_message }}</textarea>
                                        </template>
                                        <template v-else>
                                            <span class="btn btn-sm btn-accent"><i class="mr-1 fa fa-times"></i>Not-Approved</span>
                                        </template>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                        Approved By
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <p class="mt-2">
                                        <span v-if="hospital.approved_by">
                                            <a href="javascript:void(0)">{{ hospital.approved_by_user.name || 'Not-Available' }}</a>
                                            On <a href="javascript:void(0)">{{ hospital.approved_date }}</a></span>
                                            <span v-else>Not-Available</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
                <div class="col-md-4">
                    <section class="x_panel">
                        <div class="x_title">
                            <div class="col-md-3">
                                <h2 class="text-accent">Access User</h2>

                            </div>
                            <div class="col-md-9">
                                <!--disable old license is create-->
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="text-accent" href="#">Edit User</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row ml-1">
                                <div class="col-md-12">
                                    <ul class="list-unstyled project_files" v-if="hospital.user">
                                        <li>
                                            <strong>User's Name:</strong> {{ hospital.user.name || 'Not_available' }}
                                        </li>
                                        <li>
                                            <strong>Email Address:</strong> {{ hospital.user.email || 'Not-Available' }}
                                        </li>
                                        <li>
                                            <strong>Password:</strong> <a href="">Change Password</a>
                                        </li>
                                        <li>
                                            <strong>Created At:</strong> {{ hospital.user.created_at || 'Not-Available' }}
                                        </li>
                                        <li>
                                            <strong>Updated At:</strong> {{ hospital.user.updated_at || 'Not-Available' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </section>


                    <section class="x_panel">
                        <div class="x_title">
                            <div class="col-md-3">
                                <h2 class="text-accent">License</h2>
                            </div>
                            <div class="col-md-9">
                                <!--disable old license is create-->
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="text-accent" href="#">Renew License</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row ml-1">
                                <div class="col-md-12">
                                    <ul class="list-unstyled project_files" v-if="hospital.license">
                                        <li>
                                            <!-- Show license details: issue_date, expiry_date, license_number, issued_by on click-->
                                            <i class="fa fa-certificate mr-1"></i>License Number: {{ hospital.license.license_number || 'Not-Available' }}
                                            <small v-if="!license_expiry_status.status" class="text-danger">Expired</small>
                                            <small v-else class="text-success">Active</small>

                                        </li>
                                        <li>
                                            <i class="fa fa-calendar text-success mr-1"></i>Issued Date: {{ hospital.license.expiry_date || 'Not-Available' }}
                                            <br>
                                            <small class="ml-3">Issued by
                                                <a class="text-success" href="javascript:void(0);">{{ hospital.license.issued_by_user.name || 'Not-Available' }}</a>
                                            </small>
                                        </li>
                                        <li>
                                            <i class="fa fa-calendar text-danger mr-1"></i>Expiry Date: {{ hospital.license.expiry_date || 'Not-Available' }}
                                            <br>
                                            <small class="ml-3">Expires in {{ license_expiry_status.expiry_diff || 'Not-Available' }}</small>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled project_files" v-else>
                                        <li>
                                            <i class="fa fa-certificate"></i> Not-Available
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </section>

                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12 text-left" v-if="hospital.approve_status === 'unapproved' || hospital.approve_status === 'rejected'">
                    <button class="btn btn-accent btn-sm" @click.prevent="approve()">Approve</button>
                    <button class="btn btn-danger btn-sm" @click.prevent="reject()">Reject</button>
                </div>
                <div class="col-md-12 text-left" v-else-if="hospital.approve_status === 'approved'">
                    <button readonly="" class="btn btn-success btn-sm rounded-0"><i class="mr-1 fa fa-check"></i>Approved</button>
                </div>
            </div>

            <div class="modal" id="reject-dialog" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Reject Hospital</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body ml-2 mr-2 mb-0">
                            <p>
                                <strong>Attention !</strong> Are you sure you want to <code>Reject</code> this hospital?
                                Enter rejection reason and click <code>Reject</code> button.
                            </p>
                            <div class="form-group">
                                <label for="reject_reason">Reason for rejection</label>
                                <textarea class="form-control" id="reject_reason" v-model="reject_reason" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button v-if="reject_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                            <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="rejectHospital">Reject</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="approve-dialog" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title ml-2">Approve Hospital</h2>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body ml-2 mr-2 mb-0">
                            <p>
                                <strong>Attention !</strong> Are you sure you want to <code>Approve</code> this hospital?
                                Enter new login credentials for portal accessibility and click <code>Approve</code> button.
                            </p>

                            <h2>Login Credentials</h2>
                            <ul class="list-unstyled project_files" v-if="hospital.user">
                                <li>
                                    <strong>Login Status:</strong>
                                    <span v-if="hospital.status === 1"><i class="mr-1 fa fa-check"></i>Enabled</span>
                                    <span v-else><i class="mr-1 fa fa-times"></i>Disabled</span>
                                </li>
                                <li>
                                    <strong>User's Name:</strong> {{ hospital.user.name || 'Not_available' }}
                                </li>
                                <li>
                                    <strong>Email Address:</strong> {{ hospital.user.email || 'Not-Available' }}
                                </li>
                                <li>
                                    <strong>Password:</strong> <a href="">Default Password</a>
                                </li>
                            </ul>

                            <h2>License Information</h2>
                            <template v-if="!hospital.active_license_id">
                                <p>Create New License</p>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5 col-sm-5 label-align text-left">
                                        Expiry Date (Year)
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-7 col-sm-7">
                                        <input class="form-control" name="expiry_date" type="date" v-model="expiry_date">
                                        <span class="form-text text-danger" v-html="errors.get('expiry_date')"></span>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <ul class="list-unstyled project_files" v-if="hospital.license">
                                    <li>
                                        <!-- Show license details: issue_date, expiry_date, license_number, issued_by on click-->
                                        <i class="fa fa-certificate mr-1"></i>License Number: {{ hospital.license.license_number || 'Not-Available' }}
                                        <small v-if="!license_expiry_status.status" class="text-danger">Expired</small>
                                        <small v-else class="text-success">Active</small>

                                    </li>
                                    <li>
                                        <i class="fa fa-calendar text-success mr-1"></i>Issued Date: {{ hospital.license.expiry_date || 'Not-Available' }}
                                        <br>
                                        <small class="ml-3">Issued by
                                            <a class="text-success" href="javascript:void(0);">{{ hospital.license.issued_by_user.name || 'Not-Available' }}</a>
                                        </small>
                                    </li>
                                    <li>
                                        <i class="fa fa-calendar text-danger mr-1"></i>Expiry Date: {{ hospital.license.expiry_date || 'Not-Available' }}
                                        <br>
                                        <small class="ml-3">Expires in {{ license_expiry_status.expiry_diff || 'Not-Available' }}</small>
                                    </li>
                                </ul>
                                <ul class="list-unstyled project_files" v-else>
                                    <li>
                                        <i class="fa fa-certificate"></i> Not-Available
                                    </li>
                                </ul>
                            </template>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button v-if="approve_submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                            <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="approveHospital">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="create-user-dialog" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title ml-2">Create User</h2>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body ml-2 mr-2 mb-0">
                            <p>
                                <strong>Attention !</strong> Are you sure you want to <code>Approve</code> this hospital?
                                Enter new login credentials for portal accessibility and click <code>Approve</code> button.
                            </p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button v-if="approve_submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                            <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="approveHospital">Approve</button>
                        </div>
                    </div>
                </div>
            </div>

            <image-preview ref="imagePreview"/>
            <change-hospital-status ref="hospitalStatus" :hospital="hospital"/>

        </template>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";
    import AdministratorService from "../../../services/AdministratorService";
    import ChangeHospitalStatus from "./ChangeHospitalStatus";

    export default {
        name: "HospitalView",
        props: ["hospital_id"],
        components: {
            ImagePreview,
            ChangeHospitalStatus
        },
        data(){
            return{
                errors: new Errors(),

                hospital: {},
                license_expiry_status: '',
                reject_submitting:false,
                approve_submitting:false,
                hospital_details_loading:false,
                // reject
                reject_reason:'',
                expiry_date:'',
            }
        },
        watch:{

        },
        computed: {
        },
        async mounted() {
            this.hospital_details_loading = true;
            await this.getHospitalDetails();
            this.hospital_details_loading = false;

            EventBus.$on('hospitalStatusChanged', () => {
                this.getHospitalDetails();
            });
        },
        methods: {
            async getHospitalDetails()
            {
                const response = await AdministratorService.getHospitalDetails(this.hospital_id);
                this.hospital = response.data.data.hospital;
                this.license_expiry_status = response.data.data.license_expiry_status;
            },
            approve(){
                $("#approve-dialog").modal('show');
            },
            reject(){
                $("#reject-dialog").modal('show');
            },

            async approveHospital(){
                this.approve_submitting = true;
                try {
                    const formData = {
                        'hospital_id': this.hospital.id,
                        'expiry_date': this.expiry_date
                    };

                    const response = await AdministratorService.approveHospital(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                        $("#approve-dialog").modal('hide');
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                }
                this.approve_submitting = false;
                this.getHospitalDetails();
            },

            async rejectHospital(){
                this.reject_submitting = true;
                try {
                    const formData = {
                        'hospital_id': this.hospital.id,
                        'reject_message': this.reject_reason,
                    };

                    const response = await AdministratorService.rejectHospital(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                        $("#reject-dialog").modal('hide');
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                }
                this.reject_submitting = false;
                this.getHospitalDetails();
            },
        }
    }
</script>

<style scoped>
    .img-preview{
        width: 3rem;
        height: 3rem;
        object-fit: cover;
        cursor: pointer;
    }
</style>
