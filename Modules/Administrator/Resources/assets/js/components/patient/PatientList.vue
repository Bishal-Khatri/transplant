<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control"
                                       placeholder="Search" v-model="filter"
                                       @keydown.backspace="setSearch"
                                       @keydown.enter="setSearch"
                                       @keypress="setSearch">
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a style="color: #5A738E;" href="#" @click.prevent="$refs.createPatient.openDialog()">Register New Patient</a></li>
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
                                    <button id="filter-patient-status" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter mr-1"></i> Patient Status: Active (12)
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="filter-patient-status"
                                         x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="#">Active (12)</a>
                                        <a class="dropdown-item" href="#" >On Hold (2)</a>
                                        <a class="dropdown-item" href="#" >Received (0)</a>
                                        <a class="dropdown-item" href="#" >Canceled / Deceased (9)</a>
                                    </div>
                                </div>
                                <div class="btn-group" role="group">
                                    <button id="filter-hospital-type" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter mr-1"></i> Transplant Type: KIDNEY
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="filter-hospital-type"
                                         x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="#">KIDNEY</a>
                                        <a class="dropdown-item" href="#" >LIVER</a>
                                    </div>
                                </div>

                                <div class="btn-group float-right" role="group">
                                    <button id="export" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="!selected.length">
                                        <i class="fa fa-download mr-1"></i> Export
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="export"
                                         x-placement="bottom-start"
                                         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                        <a class="dropdown-item" href="#" @click.prevent="exportPatient('excel')">Excel (.xls)</a>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" v-model="selectAll" @click="select">
                                            <i class="form-icon"></i>
                                        </label>
                                    </div>
                                </th>
                                <th>Patient's Photo</th>
                                <th>Patient's Name</th>
                                <th>Citizenship Number</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Transplant Type</th>
                                <th>Transplant Center</th>
                                <th>Score</th>
                                <th style="width: 180px" class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!patients.length">
                                <td colspan="10">No items to display.</td>
                            </tr>
                            <tr v-else v-for="(patient, index) in patients" :key="index">
                                <td>
                                    <input type="checkbox" class="rowCheck" :value="patient.id" v-model="selected"/>
                                </td>
                                <td style="width: 150px;">
                                    <a v-if="patient.image" href="#" @click.prevent="$refs.imagePreview.openDialog('/storage/'+patient.image)">
                                        <img :src="'/storage/'+patient.image" alt="" class="rounded" width="60">
                                    </a>
                                    <img v-else src="/images/placeholder-dark.jpg" alt="" width="60" height="40">
                                </td>
                                <td>
                                    <a class="mr-2" :href="'/admin/patient/update/'+patient.id">{{ patient.name || 'Not-Available' }}</a> <br>
                                    <small class="">Created on {{ patient.created_at }}</small>
                                </td>
                                <td>{{ patient.citizenship_number || 'Not-Available' }}</td>
                                <td>{{ patient.gender ? patient.gender.toUpperCase() : 'Not-Available' }}</td>
                                <td>{{ patient.date_of_birth || 'Not-Available' }}</td>
                                <td>{{ patient.transplant_type ? patient.transplant_type.toUpperCase() : 'Not-Available' }}</td>
                                <td>{{ patient.hospital.hospital_name || 'Not-Available' }}</td>
                                <td style="width: 70px;">{{ patient.point }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a href="#" class="dropdown-item" :href="'/admin/patient/view/'+patient.id" type="button">View</a>
                                            <a href="#" class="dropdown-item" :href="'/admin/patient/update/'+patient.id" type="button">Edit</a>
                                            <a href="#" class="dropdown-item" @click.prevent="showDeleteModal(patient.id)" type="button">Change Status</a>
                                            <!--<a href="#" class="dropdown-item" @click.prevent="showTransferModal(patient.id)" type="button">Transfer</a>-->
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

        <patient-create ref="createPatient" :hospitals="hospitals"/>
        <image-preview ref="imagePreview"/>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import PatientService from "../../../services/PatientService";
    import {EventBus} from "../../app";
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";
    import PatientCreate from "./PatientCreate";

    export default {
        name: "PatientList",
        data(){
            return{
                errors: new Errors(),
                hospitals: '',
                filter: '',

                patients: {},
                patients_pg: {},
                delete_submitting: '',
                delete_id: '',

                selectAll:'',
                selected:[],
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
                    this.hospitals = response.data.data.hospitals;
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

            select() {
                this.selected = [];
                if (!this.selectAll) {
                    for (let i in this.patients) {
                        this.selected.push(this.patients[i].id);
                    }
                }
            },

            exportPatient(type) {
                alert(type)
                console.log(this.selected)
            },
        }
    }
</script>

<style scoped>

</style>
