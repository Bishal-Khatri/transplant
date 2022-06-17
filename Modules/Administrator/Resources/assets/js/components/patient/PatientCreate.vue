<template>
    <div>
        <div class="modal" id="create-patient-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Register New Patient</h2>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Patient's Photo
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <div class="d-flex">
                                    <img v-if="patient_image_url" :src="patient_image_url" alt="" class="image-sm mr-2 rounded">
                                    <input type="file" class="form-control" placeholder="Enter patient's image" @change.prevent="handelUpload" style="width: 250px;">
                                </div>
                                <span class="form-text text-danger" v-html="errors.get('patient_image')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Patient's Name
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" placeholder="Enter patient's name" v-model="patient_name">
                                <span class="form-text text-danger" v-html="errors.get('patient_name')"></span>
                                <span class="form-text text-danger" v-html="errors.get('unique_patient')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Citizenship Number
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" placeholder="Enter citizenship number" v-model="citizenship_number">
                                <span class="form-text text-danger" v-html="errors.get('citizenship_number')"></span>
                                <span class="form-text text-info">Enter all the characters in citizenship number</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Transplant Center
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <select v-model="transplant_center" class="form-control" id="">
                                    <option value="">Select Transplant Center</option>
                                    <option v-if="hospitals.length" v-for="hospital in hospitals" :key="hospital.id" :value="hospital.id">{{ hospital.hospital_name }}</option>
                                </select>
                                <span class="form-text text-danger" v-html="errors.get('transplant_center')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                Gender <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <select name="" v-model="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="form-text small text-danger" v-html="errors.get('gender')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Transplant Type <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9">
                                <select class="form-control" v-model="transplant_type" required="required">
                                    <option value="">Select Transplant Type</option>
                                    <option value="kidney">Kidney</option>
                                    <option value="liver">Liver</option>
                                </select>
                                <span class="form-text small text-danger" v-html="errors.get('transplant_type')"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="savePatient">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../../app';
    import {Errors} from "../../../../../../../resources/js/error";
    import PatientService from "../../../services/PatientService";

    export default {
        name: "PatientCreate",
        props: ['hospitals'],
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,
            patient_image_url: '',

            // form data
            patient_name: '',
            citizenship_number: '',
            patient_image: '',
            transplant_center: '',
            gender: '',
            transplant_type: '',
        }),
        computed:{
        },
        methods: {
            openDialog() {
                $("#create-patient-dialog").modal("show");
            },

            handelUpload(event){
                this.patient_image = event.target.files[0];
                event.target.files[0] ? this.patient_image_url = URL.createObjectURL(event.target.files[0]) : '';
            },

            async savePatient() {
                this.submitting = true;
                try {
                    let formData = new FormData();
                    this.patient_image ? formData.append("patient_image", this.patient_image, this.patient_image.name) : '';
                    this.patient_name ? formData.append("patient_name", this.patient_name) : '';
                    this.citizenship_number ? formData.append("citizenship_number", this.citizenship_number) : '';
                    this.transplant_center ? formData.append("transplant_center", this.transplant_center) : '';
                    this.gender ? formData.append("gender", this.gender) : '';
                    this.transplant_type ? formData.append("transplant_type", this.transplant_type) : '';

                    const response = await PatientService.savePatient(formData);
                    if (response.data.error === false) {
                        $("#create-patient-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.submitting = false;
                } catch (error) {
                    this.submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('patientCreated');
                this.submitting = false;
            },

            clearForm() {
                this.patient_name = this.citizenship_number = this.patient_image = this.patient_image_url = this.gender = this.transplant_type = '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
