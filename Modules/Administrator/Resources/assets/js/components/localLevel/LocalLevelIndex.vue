<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" 
                                    class="form-control"
                                    placeholder="Search" 
                                        v-model="filter"
                                        @keydown.backspace="setMunicipalitySearch"
                                        @keydown.enter="setMunicipalitySearch"
                                        @keypress="setMunicipalitySearch"
                                >
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a style="color: #5A738E;" href="#">Create New</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Municipalities</th>
                                <th>Action</th>
                                <th>Palikas</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control"  placeholder="Municipality" v-model="municipality_title" @keydown.enter="()=>{
                                        municipality_id='';
                                        municipality_edit_mode=false;
                                    }">
                                </td>
                                <td>
                                    <button v-if="municipality_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                                    <button v-else type="button" class="btn btn-success btn-sm" @click="saveMunicipality">Save</button>
                                </td>
                                <td> <input type="text" class="form-control"  placeholder="Palika" > </td>
                                <td>
                                    <button  class="btn btn-success btn-sm" type="button">Save</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table style="width: -webkit-fill-available;">
                                    <tr v-if="!municipalities.length">
                                        <td colspan="2">No Municipality to display.</td>
                                    </tr>
                                    <tr v-else v-for="(municipality, index) in municipalities" :key="index">
                                        <td v-if="!(municipality_edit_mode && municipality_id==municipality.id)" >
                                            <a class="mr-2" @click="editMunicipality(municipality)">{{ municipality.title }}</a>
                                            <small class="">Created on {{ municipality.created_at }}</small>
                                        </td>
                                        <td v-else>
                                            <input type="text" class="form-control"  placeholder="Municipality" v-model="municipality_edit_title"> 
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group"  v-if="!(municipality_edit_mode && municipality_id==municipality.id)">
                                                <a href="#" class="btn btn-secondary btn-sm" type="button" @click="editMunicipality(municipality)">Edit</a>
                                                <a href="#" @click.prevent="showDeleteModal(municipality.id)" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                            </div>
                                            <div class="btn-group"  v-else>
                                                <a href="#"  class="btn btn-success btn-sm" type="button" @click.prevent="saveMunicipality">Save</a>
                                                <a href="#" class="btn btn-secondary btn-sm" type="button" @click.prevent="()=>{
                                                    municipality_edit_mode=false;
                                                    clearMunicipality();
                                                }">Cancel</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <pagination :data="municipalities_pg" @pagination-change-page="getMunicipalities"></pagination>
                                            <input type="text" 
                                                class="form-control"
                                                placeholder="Search Municipalities" 
                                                    v-model="municipality_filter"
                                                    @keydown.backspace="setMunicipalitySearch"
                                                    @keydown.enter="setMunicipalitySearch"
                                                    @keypress="setMunicipalitySearch"
                                            >
                                        </td>
                                    </tr>
                                     </table>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>

   

        <div class="modal fade" id="delete-municipality-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete municipality</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deleteMunicipality">Confirm</button>
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

    export default {
        name: "municipalityIndex",
        props:[
            'district_id',
        ],
        data(){
            return{
                errors: new Errors(),
                delete_submitting: false,
                filter: '',
                delete_id: '',
                submitting: false,

                // municipality
                municipality_edit_mode:false,
                municipality_filter: '',
                municipality_submitting: false,
                municipality_id:'',
                municipality_title:'',
                municipality_edit_title:'',
                municipalities:{},
                municipalities_pg: {},

            }
        },
        computed: {
        },
        mounted() {
            this.getMunicipalities();
        },
        methods: {
            setMunicipalitySearch:_.debounce(function(){
                this.getMunicipalities();
            }, 800),
            async saveMunicipality(){
                this.municipality_submitting = true;
                try {
                    const formData = {
                        id: this.municipality_id,
                        title:this.municipality_title,
                        district_id:this.district_id,
                    };
                    console.log(formData);
                    console.log(this.municipality_edit_mode);
                    
                    if(this.municipality_edit_mode){
                        formData.title=this.municipality_edit_title;
                    }
                    const response = await DataService.saveMunicipality(formData);
                    console.log(response);
                    if (response.error === false) {
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.clearMunicipality();
                    this.getMunicipalities();
                    this.municipality_submitting = false;
                } catch (error) {
                    this.municipality_submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.municipality_submitting = false;
            },
            editMunicipality(municipality){
                this.municipality_edit_mode=true;
                this.municipality_id=municipality.id;
                this.municipality_edit_title=municipality.title;
            },
            async getMunicipalities(page = 1) {
                const response = await DataService.getMunicipality(page, this.municipality_filter,this.district_id);
                this.municipalities_pg = response.data.data.municipalities;
                this.municipalities = response.data.data.municipalities.data;
            },
            showDeleteModal(item_id) {
                this.delete_id = item_id;
                $("#delete-municipality-dialog").modal('show');
            },
            async deleteMunicipality() {
                this.delete_submitting = true;
                const response = await DataService.deleteMunicipality(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getMunicipalities();
                    $("#delete-municipality-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
            clearMunicipality(){
                this.municipality_edit_mode=false;
                this.municipality_id=this.municipality_title=this.municipality_edit_title='';
            }
        }
    }
</script>

<style scoped>

</style>
