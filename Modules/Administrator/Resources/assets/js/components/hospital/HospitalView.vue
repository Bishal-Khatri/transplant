<template>
    <div>
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
                            <hr>
                            <p class="title">Address</p>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                    Province
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" :value="hospital.province ? hospital.province.title : 'Not-Availabl'" readonly/>
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
                            <p></p>
                            <hr>
                            <p class="title">Status</p>

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
                                            <span v-if="hospital.status === 1">Enabled</span>
                                            <span v-else>Disabled</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="status"
                                             x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('status', 1)">Enable</a>
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('status', 0)">Disable</a>
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
                                            <span v-if="hospital.document_verification === 1">VERIFIED</span>
                                            <span v-else>UNVERIFIED</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="verification"
                                             x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('document_verification', 0)">UNVERIFIED</a>
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('document_verification', 1)">VERIFIED</a>
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
                                            <span v-if="hospital.physical_verification === 1">VERIFIED</span>
                                            <span v-else>UNVERIFIED</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="verification"
                                             x-placement="bottom-start"
                                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('physical_verification', 0)">UNVERIFIED</a>
                                            <a class="dropdown-item" href="#" @click.prevent="changeStatus('physical_verification', 1)">VERIFIED</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                    Approval status
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <span class="btn btn-sm btn-accent">{{ hospital.approve_status ? hospital.approve_status.toUpperCase() : '' }}</span>
                                    <span v-if="hospital.approve_status === 'rejected'">
                                        <label for="">Reject Message</label>
                                        <textarea name="" id="" cols="30" rows="10">{{ hospital.reject_message }}</textarea>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                    Approved By
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <p class="mt-2">
                                        <span v-if="hospital.approved_by">{{ hospital.approved_by || 'Not-Available' }} On {{ hospital.approved_date }}</span>
                                        <span v-else>Not-Available</span>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <br>
                        <h5>Files & Docuemnts</h5>
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
                                <li><a style="color: #5A738E;" href="#">Change User</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row ml-1">
                            <div class="col-md-12">
                                <ul class="list-unstyled project_files">
                                    <li>
                                        <strong>User's Name:</strong> Bishal Khatri
                                    </li>
                                    <li>
                                        <strong>Email Address:</strong> bishal.khatri343@gmail.com
                                    </li>
                                    <li>
                                        <strong>Password:</strong> <a href="">Change Password</a>
                                    </li>
                                    <li>
                                        <strong>Created At:</strong> Apr 23 2022
                                    </li>
                                    <li>
                                        <strong>Updated At:</strong> Apr 23 2022
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
                                <li><a style="color: #5A738E;" href="#">Renew License</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row ml-1">
                            <div class="col-md-12">
                                <ul class="list-unstyled project_files">
                                    <li>
                                        <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">
                                            <!-- Show license details: issue_date, expiry_date, license_number, issued_by on click-->
                                            <i class="fa fa-certificate"></i> < license number >
                                            <i :class="hospital.application_letter ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href=""  @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">
                                            <i class="fa fa-certificate"></i> < license number >
                                            <small class="text-danger">Expired</small>
                                        </a>
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
            <div class="col-md-12 text-left">
                <button class="btn btn-accent btn-sm" @click.prevent="approve()">Approve</button>
                <button class="btn btn-danger btn-sm" @click.prevent="reject()">Reject</button>
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

                        <create-user></create-user>
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

                        <create-user></create-user>
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
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";
    import CreateUser from "./CreateUser";

    export default {
        name: "HospitalView",
        props: ["hospital_json"],
        components: {
            ImagePreview,
            CreateUser
        },
        data(){
            return{
                errors: new Errors(),

                hospital: {},
                reject_submitting:false,
                approve_submitting:false,
                // reject
                reject_reason:'',
            }
        },
        watch:{

        },
        computed: {
        },
        mounted() {
            console.log(this.hospital_json);
            this.hospital = JSON.parse(this.hospital_json);
        },
        methods: {
            approve(){
                $("#approve-dialog").modal('show');
            },
            reject(){
                $("#reject-dialog").modal('show');
            },

            approveHospital(){
            },

            rejectHospital(){
            }

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
