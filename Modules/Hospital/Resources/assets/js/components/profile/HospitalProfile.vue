<template>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content d-flex justify-content-center" style="min-height:70vh;">
                    
                    <div class="col-md-9 col-sm-9 ">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">License</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                                    <!-- start recent activity -->
                                    <ul class="messages">
                                        <li>
                                            <img src="/asset/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">24</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Desmond Davison</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="/asset/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-error">21</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Brian Michaels</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                    <a href="#" data-original-title="">Download</a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="/asset/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">24</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Desmond Davison</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="/asset/gentelella/images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-error">21</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Brian Michaels</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                    <a href="#" data-original-title="">Download</a>
                                                </p>
                                            </div>
                                        </li>

                                    </ul>
                                    <!-- end recent activity -->

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                     <section class="x_panel">
                                                    <div class="x_title">
                                                        <div class="col-md-3">
                                                            <h2 class="text-accent">License</h2>

                                                        </div>
                                                        <div class="col-md-9">
                                                            <!--disable old license is create-->
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a style="color: #5A738E;" href="#">Request New License</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel-body">                    
                                                    <!-- start user projects -->
                                                    <table class="data table table-striped no-margin">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>License Number</th>
                                                            <th>Issued By</th>
                                                            <th>Issue Date</th>
                                                            <th>Expired Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(license, index) in licenses" :key="index">
                                                            <td>{{ license.id }}</td>
                                                            <td>{{ license.license_number }}</td>
                                                            <td>{{ license.issued_by }}</td>
                                                            <td>{{ license.issue_date }}</td>
                                                            <td>{{ license.expiry_date }}</td>
                                                            <td><button class="btn btn-success">Renew</button></td>
                                                        </tr>
                                                    
                                                        </tbody>
                                                    </table>
                                                    <!-- end user projects -->
                                                    </div>

                                                </section>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                        <div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <section class="x_panel">
                                                    <div class="x_title row">
                                                        <h2 class="col-md-3 pl-1">Hospital Name</h2>
                                                        <h2 class="text-accent col-md-9">{{ hospital.hospital_name }}</h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="project_detail">
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
                                                                </label>
                                                                <div class="col-md-9 col-sm-9">
                                                                    <div class="btn-group" role="group">
                                                                            <span class="badge badge-success" v-if="hospital.status === 1">Enabled</span>
                                                                            <span class="badge badge-danger" v-else>Disabled</span>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                                    Verification status
                                                                </label>
                                                                <div class="col-md-9 col-sm-9">
                                                                    <div class="btn-group" role="group">
                                                                            <span class="badge badge-danger" v-if="hospital.verification_status === 0">NONE</span>
                                                                            <span class="badge badge-secondary" v-if="hospital.verification_status === 1">DOCUMENT VERIFIED</span>
                                                                            <span class="badge badge-primary" v-if="hospital.verification_status === 2">PHYSICALLY VERIFIED</span>
                                                                            <span class="badge badge-success" v-if="hospital.verification_status === 3">VERIFIED</span>
                                                                    
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

                                                </section>


                                                
                                            </div>
                                        </div>

                                        

                            

                                        <image-preview ref="imagePreview"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";

    export default {
        name: "HospitalProfile",
        props: ["hospital_json","licenses_json"],
        components: {
            ImagePreview
        },
        data(){
            return{
                errors: new Errors(),

                hospital: {},
                reject_submitting:false,
                approve_submitting:false,
                // approve
                name:'',
                email:'',
                password:'',
                confirm_password:'',
                // reject
                reject_reason:'',
                licenses:{},
            }
        },
        watch:{

        },
        computed: {
        },
        mounted() {
            this.hospital = JSON.parse(this.hospital_json);
            this.licenses = JSON.parse(this.licenses_json);
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