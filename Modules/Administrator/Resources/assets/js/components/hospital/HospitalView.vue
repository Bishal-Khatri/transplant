<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hospital Name</label>
                    <input type="text" class="form-control"  :value="hospital.hospital_name" readonly>
                </div>

                <div class="form-group">
                    <label >Hospital Type</label>
                    <input type="text" class="form-control"  :value="hospital.hospital_type" readonly>
                </div>

                <div class="form-group">
                    <label >transplant_type</label>
                    <input type="text" class="form-control"  :value="hospital.transplant_type" readonly>
                </div>

                <div class="form-group">
                    <label >approved_date</label>
                    <input type="text" class="form-control"  :value="hospital.approved_date" readonly>
                </div>

                <div class="form-group">
                    <label >approved_by</label>
                    <input type="text" class="form-control"  :value="hospital.approved_by" readonly>
                </div>

                <div class="form-group">
                    <label >reject_message</label>
                    <input type="text" class="form-control"  :value="hospital.reject_message" readonly>
                </div>

                <div class="form-group">
                    <label >approve_status</label>
                    <input type="text" class="form-control"  :value="hospital.approve_status" readonly>
                </div>

                <div class="form-group">
                    <label >verification_status</label>
                    <input type="text" class="form-control"  :value="hospital.verification_status" readonly>
                </div>

                <div class="form-group">
                    <label >active_license_id</label>
                    <input type="text" class="form-control"  :value="hospital.active_license_id" readonly>
                </div>

                <div class="form-group">
                    <label for="province">Province</label>
                    <input type="text" class="form-control" id="province" v-model="hospital.province.title || 'Not-Available'" disabled>
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" v-model="hospital.district.title || 'Not-Available'" disabled>
                </div>

                <div class="form-group">
                    <label for="municipality">Municipality</label>
                    <input type="text" class="form-control" id="municipality" v-model="hospital.municipality.title || 'Not-Available'" disabled>
                </div>

                <div class="form-group">
                    <label for="palika">Palika</label>
                    <input type="text" class="form-control" id="palika" v-model="hospital.palika_name" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped jambo_table">
                    <thead>
                    <tr>
                        <th>File Type</th>
                        <th>File Name</th>
                        <th>File</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Application Letter</td>
                        <td>
                            <a href="#" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">{{hospital.application_letter}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.application_letter}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Human Resource</td>
                        <td>
                            <a href="#" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">{{hospital.human_resource}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.human_resource}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Tools & Equipment list</td>
                        <td>
                            <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tools_list}`)">{{hospital.tools_list}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.tools_list}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tools_list}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Administrative Document</td>
                        <td>
                            <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.administrative_document}`)">{{hospital.administrative_document}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.administrative_document}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.administrative_document}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Sanchalan Swikriti</td>
                        <td>
                            <a href="#" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.sanchalan_swikriti}`)">{{hospital.sanchalan_swikriti}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.sanchalan_swikriti}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.sanchalan_swikriti}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Renewal Letter</td>
                        <td>
                            <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.renewal_letter}`)">{{hospital.renewal_letter}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.renewal_letter}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.renewal_letter}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>PAN</td>
                        <td>
                            <a href="" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.pan}`)">{{hospital.pan}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.pan}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.pan}`)">
                        </td>
                    </tr>

                    <tr>
                        <td>Tax Clearance</td>
                        <td>
                            <a href="#" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tax_clearance}`)">{{hospital.tax_clearance}}</a>
                        </td>
                        <td>
                            <img :src="`/storage/${hospital.tax_clearance}`" alt="" class="img-preview"
                                 @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tax_clearance}`)">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
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
                        <h4 class="modal-title">Approve Hospital</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body ml-2 mr-2 mb-0">
                        <p>
                            <strong>Attention !</strong> Are you sure you want to <code>Approve</code> this hospital?
                            Enter new login credentials for portal accessibility and click <code>Approve</code> button.
                        </p>
                        <!-- login info -->
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Full Name
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" placeholder="" v-model="name">
                                <span class="form-text text-danger" v-html="errors.get('name')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Email Address
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" placeholder="" v-model="email">
                                <span class="form-text text-danger" v-html="errors.get('email')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Password
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="password" class="form-control" id="password" v-model="password" placeholder="" />
                                <span class="form-text text-danger" v-html="errors.get('password')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Confirm Password
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="password" class="form-control" id="confirm_password" v-model="confirm_password" placeholder="" />
                                <span class="form-text text-danger" v-html="errors.get('password')"></span>
                            </div>
                        </div>
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

    export default {
        name: "HospitalView",
        props: ["hospital_json"],
        components: {
            ImagePreview
        },
        data(){
            return{
                errors: new Errors(),

                hospital:'',
                reject_submitting:false,
                approve_submitting:false,
                // approve
                name:'',
                email:'',
                password:'',
                confirm_password:'',
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
