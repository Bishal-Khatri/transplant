<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
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
                                    <li><a class="text-accent" href="#" @click.prevent="$refs.createPatient.openDialog()">Register New Patient</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!--// filter-->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <button id="filter-hospital-type" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter mr-1"></i> Transplant Type
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="filter-hospital-type"
                                         x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="#">KIDNEY</a>
                                        <a class="dropdown-item" href="#" >LIVER</a>
                                    </div>
                                </div>

                                <div class="btn-group" role="group">
                                    <button id="filter-blood-type" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter mr-1"></i>  Blood Group:
                                        <span v-if="filter.blood_type">{{ filter.blood_type }}</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="filter-hospital-type"
                                         x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'A+'; getPatients();">A+</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'A-'; getPatients();">A-</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'B+'; getPatients();">B+</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'B-'; getPatients();">B-</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'O+'; getPatients();">O+</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'O-'; getPatients();">O-</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'AB+'; getPatients();">AB+</a>
                                        <a class="dropdown-item" href="#" @click.prevent="filter.blood_type = 'AB-'; getPatients();">AB-</a>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Patient's Photo</th>
                                <th>Patient's Name</th>
                                <th>Citizenship Number</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Transplant Type</th>
                                <th>Blood Group</th>
                                <th style="width: 180px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!patients.length">
                                <td colspan="8">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(patient, index) in patients" :key="index">
                                <td style="width: 150px;">
                                    <a v-if="patient.image" href="#" @click.prevent="$refs.imagePreview.openDialog('/storage/'+patient.image)">
                                        <img :src="'/storage/'+patient.image" alt="" class="rounded" width="60">
                                    </a>
                                    <img v-else src="/images/placeholder-dark.jpg" alt="" width="60" height="40">
                                </td>
                                <td>
                                    <a class="mr-2" :href="'/hospital/patient/update/'+patient.id">{{ patient.name || 'Not-Available' }}</a> <br>
                                    <small class="">Created on {{ patient.created_at }}</small>
                                </td>
                                <td>{{ patient.citizenship_number || 'Not-Available' }}</td>
                                <td>{{ patient.gender ? patient.gender.toUpperCase() : 'Not-Available' }}</td>
                                <td>{{ patient.date_of_birth || 'Not-Available' }}</td>
                                <td>{{ patient.transplant_type ? patient.transplant_type.toUpperCase() : 'Not-Available' }}</td>
                                <td>{{ patient.blood_group || 'Not-Available' }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a href="#" class="dropdown-item" :href="'/hospital/patient/view/'+patient.id" type="button">View</a>
                                            <a href="#" class="dropdown-item" :href="'/hospital/patient/update/'+patient.id" type="button">Edit</a>
                                            <a href="#" class="dropdown-item" @click.prevent="showTransferModal(patient.id)" type="button">Transfer</a>
                                            <a href="#" class="dropdown-item text-danger deleteModal" @click.prevent="showDeleteModal(patient.id)" type="button">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <pagination :data="patients_pg" @pagination-change-page=""></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="delete-patient-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="myModalLabel">Delete Patient</h2>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deletePatient">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="transfer-patient-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Transfer Patient</h2>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body m-3">

                        <form action="">
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <p><strong>Attention !</strong> Are you sure you want to transfer this patient permanently?</p>
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
                                        <option v-for="hospital in hospitals" :key="hospital.id" :value="hospital.id">{{ hospital.hospital_name }}</option>
                                    </select>
                                    <span class="form-text text-danger" v-html="errors.get('transplant_center')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Remarks
                                    <small class="">Optional</small>
                                </label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea v-model="transfer_remarks" cols="20" rows="5" class="form-control"></textarea>
                                    <span class="form-text text-danger" v-html="errors.get('transfer_remarks')"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="transfer_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="transferPatient">Transfer</button>
                    </div>
                </div>
            </div>
        </div>

        <patient-create ref="createPatient"/>
        <image-preview ref="imagePreview"/>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import PatientService from "../../../services/PatientService";
    import PatientCreate from "./PatientCreate";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";

    export default {
        name: "PatientList",
        props: ['hospitals'],
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                transfer_submitting: false,
                filter: {
                    query: '',
                    transplant_type: 'kidney',
                    blood_type: '',
                },

                patients: {},
                patients_pg: {},

                delete_id: '',
                transfer_patient_id: '',
                transplant_center: '',
                transfer_remarks: '',
            }
        },
        components: {
            PatientCreate,
            ImagePreview
        },
        computed: {
        },
        mounted() {
            this.getPatients();
            EventBus.$on('patientCreated', () => {
                this.getPatients();
            });

            let vm = this;
            this.$nextTick(() => {
                $('.modal').each(function (){
                    $(this).on('hidden.bs.modal', function () {
                        vm.clearForm();
                    });
                });
            });

        },
        methods: {
            setSearch:_.debounce(function(){
                this.getPatients();
            }, 800),

            async getPatients(page = 1){
                const response = await PatientService.getPatients(page, this.filter);
                if (response.data.error === false){
                    this.patients_pg = response.data.data.patients;
                    this.patients = response.data.data.patients.data;
                }
            },

            showTransferModal(patient_id) {
                this.transfer_patient_id = patient_id;
                $("#transfer-patient-dialog").modal('show');
            },

            async transferPatient() {
                this.transfer_submitting = true;
                const formData = {
                    patient_id: this.transfer_patient_id,
                    transplant_center: this.transplant_center,
                    transfer_remarks: this.transfer_remarks
                };

                try{
                    const response = await PatientService.transferPatient(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                        this.getPatients();
                        $("#transfer-patient-dialog").modal('hide');
                        this.transfer_patient_id  = this.transplant_center = this.transfer_remarks = '';
                        this.getPatients();
                    }
                }catch (error) {
                    this.transfer_submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },

            showDeleteModal(patient_id) {
                this.delete_id = patient_id;
                $("#delete-patient-dialog").modal('show');
            },

            async deletePatient() {
                this.delete_submitting = true;
                const response = await PatientService.deletePatient(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getPatients();
                    $("#delete-patient-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },

            clearForm(){
                this.delete_id = this.delete_id = this.transfer_patient_id = this.ransplant_center = this.transfer_remarks = '';
            },
        }
    }
</script>

<style scoped>

</style>
