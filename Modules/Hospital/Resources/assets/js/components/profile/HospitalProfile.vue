<template>
    <div class="row">
        <div class="modal" id="changes-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Changes</h2>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="row">
                            <div class="col-6">
                                <h5>Old Data</h5>
                                <div v-for="(data, index) in current_notification.old" :key="index"  class="row"  >
                                    <span class="col-4">{{ index }}</span>
                                    <span>{{ data }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5>New Data</h5>
                                <div v-for="(noti, index) in current_notification.attributes" :key="index">
                                    <span>@{{ index }}</span>
                                    <span>@{{ noti }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars mr-1"></i>{{ tab }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="col-xs-3">
                        <!-- required for floating -->
                        <!-- Nav tabs -->
                        <div class="nav nav-tabs flex-column  bar_tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home1"
                               role="tab" aria-controls="v-pills-home" @click="tab = 'Hospital Details'" aria-selected="true">Hospital Details</a>

                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile1"
                               role="tab" aria-controls="v-pills-profile" @click="tab = 'License Information'" aria-selected="false">License Information</a>

                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages1"
                               role="tab" aria-controls="v-pills-messages" @click="tab = 'Activity Logs'" aria-selected="false">Activity Logs</a>

                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings1"
                               role="tab" aria-controls="v-pills-settings" @click="tab = 'Settings'" aria-selected="false">Settings</a>
                        </div>
                    </div>

                    <div class="col-xs-9 col-md-9">
                        <!-- Tab panes -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <section class="x_panel">
                                    <div class="x_title row">
                                        <h2 class="col-md-3">Hospital Name</h2>
                                        <h2 class="text-accent col-md-6">{{ hospital.hospital_name }}
                                            <button v-if="hospital.approve_status === 'approved'" readonly="" class="btn btn-success btn-sm rounded-0 ml-3"><i class="mr-1 fa fa-check"></i>Approved</button>
                                        </h2>
                                        <div class="col-md-3">
                                            <ul class="nav navbar-right panel_toolbox" v-if="hospital.approve_status !== 'approved'">
                                                <li v-if="!editable"><a class="text-accent" href="#" @click.prevent="editable = true">Edit Profile</a></li>
                                                <li v-else><a class="text-accent" href="#" @click.prevent="editable = false;saveProfile()">Save Profile</a></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="project_detail">
                                                    <p class="title">General Details</p>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Hospital Type
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <!-- if editable select else input field with condition below -->
                                                            <select v-if="editable" v-model="hospital_type" class="form-control" :style="`${editable?'display:block;':'display:none;'}`">
                                                                <option value="">Select Hospital Type</option>
                                                                <option value="1">GOVERNMENT</option>
                                                                <option value="2">PRIVATE</option>
                                                            </select>
                                                            <input v-else-if="!editable && hospital_type === 1" type="text" class="form-control"  value="GOVERNMENT" :readonly="!editable"  placeholder="Hospital Type">
                                                            <input v-else  value="PRIVATE" class="form-control" readonly/>

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Transplant Type
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <!-- if editable select else input field with condition below -->
                                                            <select v-if="editable" v-model="transplant_type" class="form-control" :style="`${editable?'display:block;':'display:none;'}`">
                                                                <option value="">Select Transplant Type</option>
                                                                <option value="kidney">Kidney</option>
                                                                <option value="liver">Liver</option>
                                                            </select>
                                                            <input v-else type="text" class="form-control"  :value="transplant_type ? transplant_type.toUpperCase() : ''" :readonly="!editable"  placeholder="Transplant Type">
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
                                                            <!-- if editable select else input field with condition below -->
                                                            <select v-if="editable" @change.prevent="getDistrict()" v-model="province_id" class="form-control" :style="`${editable?'display:block;':'display:none;'}`">
                                                                <option value="">Select Province</option>
                                                                <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                                            </select>
                                                            <input v-else class="form-control" :value="province ? province.title : 'Not-Available'" :readonly="!editable"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            District
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <!-- if editable select else input field with condition below -->
                                                            <select v-if="editable" @change.prevent="getMunicipality()"  :disabled='district_disable' v-model="district_id" class="form-control" :style="`${editable?'display:block;':'display:none;'}`" >
                                                                <option value="">Select District</option>
                                                                <option v-for="district in districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                            </select>
                                                            <input v-else class="form-control" :value="district ? district.title : 'Not-Available'" :readonly="!editable"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Municipality
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <!-- if editable select else input field with condition below -->
                                                            <select v-if="editable" :disabled='municipality_disable'  v-model="municipality_id" class="form-control" :style="`${editable?'display:block;':'display:none;'}`">
                                                                <option value="">Select Municipality</option>
                                                                <option v-for="municipality in municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                            </select>
                                                            <input v-else class="form-control" :value="municipality ? municipality.title : 'Not-Available'" :readonly="!editable"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Palika
                                                            <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input class="form-control" :value="palika || 'Not-Available'" :readonly="!editable"/>
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
                                                                <span class="btn btn-sm btn-accent" v-if="hospital.status === 1">Enabled</span>
                                                                <span class="btn btn-sm btn-accent" v-else>Disabled</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Document Verification
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <div class="btn-group" role="group">
                                                                <span class="btn btn-sm btn-accent" v-if="hospital.document_verification === 1"><i class="mr-1 fa fa-check"></i>Verified</span>
                                                                <span class="btn btn-sm btn-accent" v-else><i class="mr-1 fa fa-times"></i>Not-Verified</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                                            Physical Verification
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <div class="btn-group" role="group">
                                                                <div class="btn-group" role="group">
                                                                    <span class="btn btn-sm btn-accent" v-if="hospital.physical_verification === 1"><i class="mr-1 fa fa-check"></i>Verified</span>
                                                                    <span class="btn btn-sm btn-accent" v-else><i class="mr-1 fa fa-times"></i>Not-Verified</span>
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
                                                                <span v-if="hospital.approved_by">{{ hospital.approved_by || 'Not-Available' }} On {{ hospital.approved_date }}</span>
                                                                <span v-else>Not-Available</span>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br>
                                                <h5>Files & Documents</h5>
                                                <ul class="list-unstyled project_files" v-if="hospital.document_verified !== 1">
                                                    <hr>
                                                    <li>
                                                        <span v-if="editable">Application Letter</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'application_letter')" >
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">
                                                                <i class="fa fa-file"></i> Application Letter
                                                                <i :class="hospital.application_letter ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li >
                                                        <span v-if="editable">Human Resource</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'human_resource')">
                                                            <a v-else href=""  @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">
                                                                <i class="fa fa-file"></i> Human Resource
                                                                <i :class="hospital.human_resource ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li>
                                                        <span v-if="editable"> Tools & Equipment list</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'tools_list')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tools_list}`)">
                                                                <i class="fa fa-file"></i> Tools & Equipment list
                                                                <i :class="hospital.tools_list ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li >
                                                        <span v-if="editable">Administrative Document</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'administrative_document')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.administrative_document}`)">
                                                                <i class="fa fa-file"></i> Administrative Document
                                                                <i class="ml-2 mr-2" :class="hospital.administrative_document ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li >
                                                        <span v-if="editable">Sanchalan Swikriti</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'sanchalan_swikriti')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.sanchalan_swikriti}`)">
                                                                <i class="fa fa-file"></i> Sanchalan Swikriti
                                                                <i :class="hospital.sanchalan_swikriti ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li>
                                                        <span v-if="editable">Renewal Letter</span>
                                                        <div  class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'renewal_letter')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.renewal_letter}`)">
                                                                <i class="fa fa-file"></i> Renewal Letter
                                                                <i :class="hospital.renewal_letter ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li>
                                                        <span v-if="editable">PAN</span>
                                                        <div class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'pan')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.pan}`)">
                                                                <i class="fa fa-file"></i> PAN
                                                                <i :class="hospital.pan ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                    <li>
                                                        <span v-if="editable">Tax Clearance</span>
                                                        <div  class="d-flex">
                                                            <input type="file" v-if="editable" class="form-control" id="file" name="file" @change="handelImage($event, 'tax_clearance')">
                                                            <a v-else href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tax_clearance}`)">
                                                                <i class="fa fa-file"></i> Tax Clearance
                                                                <i :class="hospital.tax_clearance ? 'fa fa-check' : 'fa fa-times text-danger'"></i>
                                                            </a>
                                                            <a v-if="editable" href="#"  class="float-right btn btn-success">Change</a>
                                                        </div>
                                                    </li>
                                                    <hr>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile1" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <section class="x_panel">
                                    <div class="x_title row">
                                        <div class="col-md-3">
                                            <h2 class="text-accent">License</h2>
                                        </div>
                                        <div class="col-md-9">
                                            <!--disable old license is create-->
                                            <ul class="nav navbar-right panel_toolbox">
                                                <!--<li><a class="text-accent" href="#">Request New License</a></li>-->
                                                <li><a class="text-accent" href="#">Renew License</a></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- start user projects -->
                                                <table class="table table-striped jambo_table bulk_action">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>License Number</th>
                                                        <th>Issued By</th>
                                                        <th>Issue Date</th>
                                                        <th>Expired Date</th>
                                                        <th class="text-right pr-4">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="(license, index) in licenses" :key="index">
                                                        <td>{{ license.id }}</td>
                                                        <td>{{ license.license_number }}</td>
                                                        <td>{{ license.issued_by }}</td>
                                                        <td>{{ license.issue_date }}</td>
                                                        <td>{{ license.expiry_date }}</td>
                                                        <td class="text-right">
                                                            <button class="btn btn-accent btn-sm">Active</button>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                                <!-- end user projects -->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages1" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <section class="x_panel">
                                    <div class="x_title row">
                                        <div class="col-md-6">
                                            <h2 class="text-accent">Recent Activities</h2>
                                        </div>
                                        <div class="col-md-6 d-flex">
                                            <input type="date" class="form-control">
                                            <span class="m-3">To</span>
                                            <input type="date" class="form-control">
                                            <button class="ml-2 btn btn-sm btn-block btn-accent" style="height: 38px;"><i class="fa fa-filter"></i> Filter</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="messages">
                                                    <!-- notifications -->
                                                    <li v-for="(notification,index) in notifications" :key="index">
                                                        <i v-if="notification.event=='updated'" class="fa fa-edit text-accent float-left" style="font-size: 30px;"></i>
                                                        <i v-else-if="notification.event=='created'" class="fa fa-plus text-success float-left" style="font-size: 30px;"></i>
                                                        <i v-else class="fa fa-trash text-danger float-left" style="font-size: 30px;"></i>
                                                        <div class="message_date">
                                                            <h2 class="date text-info"></h2>
                                                            <p class="month">{{ notification.created_at_diff_for_human }}</p>
                                                        </div>
                                                        <div class="message_wrapper">
                                                            <h4 class="heading">Hospital User</h4>
                                                            <blockquote class="message">
                                                                A {{ notification.subject_name }} data has been {{ notification.event }} by Hospital user
                                                                <a href="">{{ notification.created_at_diff_for_human }}</a>.</blockquote>
                                                            <br />
                                                            <p class="url">
                                                                <a href="#" @click.prevent="changeDialog(notification)">View Changes </a>
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-md-12 text-center">
                                                <a v-if="is_load_more" href="#"><i class="fa fa-spinner fa-spin"></i></a>
                                                <a v-else href="#" @click.prevent="load_more()">Load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings1" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <section class="x_panel">
                                    <div class="x_title row">
                                        <div class="col-md-3">
                                            <h2 class="text-accent">Current Access User</h2>
                                        </div>
                                        <div class="col-md-9">
                                            <!--disable old license is create-->
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="text-accent" href="#">Change User</a></li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
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
                                    <div class="x_title row">
                                        <div class="col-md-3">
                                            <h2 class="text-accent">Change Password</h2>
                                        </div>
                                        <div class="col-md-9">

                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form action="">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align text-left">
                                                            Old Password <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input type="password" class="form-control" placeholder="******">
                                                            <span class="form-text text-danger" v-html="errors.get('patient_name')"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align text-left">
                                                            New Password <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input type="password" class="form-control" placeholder="******">
                                                            <span class="form-text text-danger" v-html="errors.get('patient_name')"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-4 col-sm-4 label-align text-left">
                                                            Confirm New Password <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-sm-8">
                                                            <input type="password" class="form-control" placeholder="******">
                                                            <span class="form-text text-danger" v-html="errors.get('patient_name')"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <image-preview ref="imagePreview"/>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";
    import PublicService from "../../../../../../ContentManagement/Resources/assets/services/PublicService";
    import HospitalService from '../../../services/HospitalService';
    import DataService from "../../../services/DataService";
    export default {
        name: "HospitalProfile",
        props: ["hospital_json","licenses_json"],
        components: {
            ImagePreview
        },
        data(){
            return{
                errors: new Errors(),
                is_load_more: false,
                tab: 'Hospital Details',
                editable: false,
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
                // hospital form
                district_disable:true,
                municipality_disable:true,
                province:'',
                district:'',
                municipality:'',
                province_id: '',
                district_id: '',
                municipality_id: '',
                palika:'',
                hospital_type: '',
                transplant_type: '',
                application_letter: '',
                human_resource: '',
                tools_list: '',
                administrative_document: '',
                sanchalan_swikriti: '',
                renewal_letter: '',
                pan: '',
                tax_clearance: '',

                // arrays
                provinces:{},
                districts: {},
                municipalities:{},

                // notification
                notifications:{},
                notification_current_page:0,
                current_notification:{}
            }
        },
        watch:{
            hospital(hospital){
                this.province_id=hospital.province_id;
                this.district_id=hospital.district_id;
                this.municipality_id=hospital.municipality_id;
                this.palika=hospital.palika_name;
                this.hospital_type= hospital.hospital_type;
                this.transplant_type= hospital.transplant_type;
            },

        },
        computed: {
        },
        mounted() {
            this.hospital = JSON.parse(this.hospital_json);
            console.log(this.hospital);
            this.licenses = JSON.parse(this.licenses_json);
            this.province_id=this.hospital.province_id;
            this.district_id=this.hospital.district_id;
            this.municipality_id=this.hospital.municipality_id;
            this.hospital_type= this.hospital.hospital_type;
            this.transplant_type= this.hospital.transplant_type;
            this.province=this.hospital.province;
            this.district=this.hospital.district;
            this.municipality=this.hospital.municipality;
            this.palika=this.hospital.palika_name;

            this.getProvince();
            this.getDistrict();
            this.getMunicipality();
            this.getNotifications();
        },
        methods: {
            setNotifications:_.debounce(function(){
                this.getNotifications();
            }, 800),
            load_more(){
                this.is_load_more = true;
                this.getNotifications(this.notification_current_page+1);
            },
            approve(){
                $("#approve-dialog").modal('show');
            },
            reject(){
                $("#reject-dialog").modal('show');
            },
            async saveProfile(){
                let formData = new FormData();
                formData.append('province_id', this.province_id);
                formData.append('district_id', this.district_id);
                formData.append('municipality_id', this.municipality_id);
                formData.append('palika_name', this.palika);
                formData.append('hospital_type', this.hospital_type);
                formData.append('transplant_type', this.transplant_type);
                this.application_letter !=''?formData.append('application_letter', this.application_letter):'';
                this.human_resource !=''?formData.append('human_resource', this.human_resource):'';
                this.tools_list !=''?formData.append('tools_list', this.tools_list):'';
                this.administrative_document !=''?formData.append('administrative_document', this.administrative_document):'';
                this.sanchalan_swikriti !=''?formData.append('sanchalan_swikriti', this.sanchalan_swikriti):'';
                this.renewal_letter !=''?formData.append('renewal_letter', this.renewal_letter):'';
                this.pan !=''?formData.append('pan', this.pan):'';
                this.tax_clearance !=''?formData.append('tax_clearance', this.tax_clearance):'';


                let response = await HospitalService.updateProfile(formData);
                if(response.data.error === false){
                    Errors.Notification(response);
                        this.errors.clear();
                }
                this.hospital=response.data.data[0];

            },
            approveHospital(){
            },

            rejectHospital(){
            },
            async getProvince(){
                const  response = await PublicService.getProvince();
                this.provinces = response.data.data.provinces;
            },

            async getDistrict(){
                const response = await PublicService.getDistrict(this.province_id);
                this.districts=response.data.data.districts;
                this.district_disable = false;
            },

            async getMunicipality(){
                const response = await PublicService.getMunicipality(this.district_id);
                this.municipalities=response.data.data.municipalities;
                this.municipality_disable = false;
            },
            async getNotifications(page=1){
                let response = await DataService.getNotifications(page);
                if(this.is_load_more){
                    this.is_load_more = false;
                    if([...response.data.data[0].data].length!=0){

                        this.notifications = this.notifications.concat(response.data.data[0]);
                    }
                }else{
                    if(response.data.error === false){
                        this.notifications = response.data.data[0].data;
                    }
                }
                this.notification_current_page=response.data.data[0].current_page;
            },
            handelImage(event, modal){
                if (modal === 'application_letter'){
                    this.application_letter = event.target.files[0];
                }
                if (modal === 'human_resource'){
                    this.human_resource = event.target.files[0];
                }
                if (modal === 'tools_list'){
                    this.tools_list = event.target.files[0];
                }
                if (modal === 'administrative_document'){
                    this.administrative_document = event.target.files[0];
                }
                if (modal === 'sanchalan_swikriti'){
                    this.sanchalan_swikriti = event.target.files[0];
                }
                if (modal === 'renewal_letter'){
                    this.renewal_letter = event.target.files[0];
                }
                if (modal === 'pan'){
                    this.pan = event.target.files[0];
                }
                if (modal === 'tax_clearance'){
                    this.tax_clearance = event.target.files[0];
                }

            },
            toBase64(file){
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = error => reject(error);
                });
            },
            changeDialog(notification){
                // changes-dialog
                console.log(notification);
                $("#changes-dialog").modal('show');
                this.current_notification = notification.properties;
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
