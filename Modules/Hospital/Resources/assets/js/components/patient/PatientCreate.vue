<template>
    <div>
        <div class="modal fade" id="create-patient-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Register New Patient</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left"></label>
                            <div class="col-md-9 col-sm-9">
                                <img v-if="patient_image_url" :src="patient_image_url" alt="" width="150">
                                <img v-else src="/images/placeholder-dark.jpg" alt="" width="150">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Patient's Photo
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="file" class="form-control" placeholder="Enter patient's image" @change.prevent="handelUpload" style="width: 250px;">
                                <span class="form-text text-danger" v-html="errors.get('patient_image')"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
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
                            <label class="col-form-label col-md-3 col-sm-3 label-align text-left">
                                Citizenship Number
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9">
                                <input type="text" class="form-control" placeholder="Enter citizenship number" v-model="citizenship_number">
                                <span class="form-text text-danger" v-html="errors.get('citizenship_number')"></span>
                                <span class="form-text text-info">Enter all the characters in citizenship number</span>
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
        props: {
        },
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
                this.patient_name = this.citizenship_number = this.patient_image = this.patient_image_url = '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
