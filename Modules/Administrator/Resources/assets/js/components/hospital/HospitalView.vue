<template>
    <div>
        <span class="section">Hospital Details</span>
        <div class="row p-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="hospital_name">Hospital Name</label>
                    <input type="text" class="form-control"  :value="hospital.hospital_name" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="province">Province</label>
                    <input type="text" class="form-control" id="province" v-model="hospital.province.title" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" v-model="hospital.district.title" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="municipality">Municipality</label>
                    <input type="text" class="form-control" id="municipality" v-model="hospital.municipality.title" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="palika">Palika</label>
                    <input type="text" class="form-control" id="palika" v-model="hospital.palika_name" disabled>
                </div>
            </div>
        </div>
        <span class="section">Required Files</span>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group d-flex flex-column">
                    <label for="application_letter">Application Letter</label>
                    <img :src="`/storage/${hospital.application_letter}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.application_letter}`)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group d-flex flex-column">
                    <label for="human_resource">Human Resource</label>
                    <img :src="`/storage/${hospital.human_resource}`" alt="" class="img-preview"  @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.human_resource}`)">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group d-flex flex-column">
                    <label for="tools_equipment">Tools & Equipment list</label>
                    <img :src="`/storage/${hospital.tools_list}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tools_list}`)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group d-flex flex-column">
                    <label for="administrative_document">Administrative Document</label>
                    <img :src="`/storage/${hospital.administrative_document}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.administrative_document}`)">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group d-flex flex-column">
                    <label for="sanchalan_swikriti">Sanchalan Swikriti</label>
                    <img :src="`/storage/${hospital.sanchalan_swikriti}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.sanchalan_swikriti}`)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group d-flex flex-column">
                    <label for="renewal_letter">Renewal Letter</label>
                    <img :src="`/storage/${hospital.renewal_letter}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.renewal_letter}`)"> 
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="form-group d-flex flex-column">
                    <label for="pan">PAN</label>
                    <img :src="`/storage/${hospital.pan}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.pan}`)">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group d-flex flex-column">
                    <label for="tax_clearance">Tax Clearance</label>
                    <img :src="`/storage/${hospital.tax_clearance}`" alt="" class="img-preview" @click.prevent="$refs.imagePreview.openDialog(`/storage/${hospital.tax_clearance}`)">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-end">
                <button class="btn btn-success" @click.prevent="approve()">Approve</button>

            </div>
            <div class="col-md-6">
                <button class="btn btn-danger" @click.prevent="reject()">Reject</button>
            </div>
        </div>
        <image-preview ref="imagePreview"/>
        <div class="modal fade" id="reject-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Reject</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="form-group">
                            <label for="reject_reason">Reason</label>
                            <textarea class="form-control" id="reject_reason" v-model="reject_reason" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="reject_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" >Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="approve-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Approve</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <!-- login info -->
                        <!-- email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" v-model="email" placeholder="Email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="password" placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" v-model="confirm_password" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="approve_submitting" type="button" class="btn btn-success btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-success btn-sm" >Confirm</button>
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
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";

    export default {
        name: "HospitalView",
        props: ["hospital_json"],
        components: {
            ImagePreview
        },
        data(){
            return{
                hospital:'',
                reject_submitting:false,
                approve_submitting:false,
                // approve
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
            }
            
        }
    }
</script>

<style scoped>
    .img-preview{
        width: 10rem;
        height: 10rem;
        object-fit: cover;
    }
</style>