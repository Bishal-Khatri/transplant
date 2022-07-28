<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Search Municipalities"
                                       v-model="municipality_filter"
                                       @keydown.backspace="setMunicipalitySearch"
                                       @keydown.enter="setMunicipalitySearch"
                                       @keypress="setMunicipalitySearch"
                                >
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr>
                                <th>Municipalities / Rural Municipalities</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control"
                                           placeholder="Enter new municipality name"
                                           v-model="municipality_title"
                                           @keyup.13="()=>{ municipality_id=''; municipality_edit_mode=false; }">
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button v-if="municipality_submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                                        <button v-else type="button" class="btn btn-accent btn-sm" @click.prevent="saveMunicipality">Create</button>
                                        <button type="button" class="btn btn-secondary btn-sm" @click.prevent="clearMunicipality">Cancel</button>
                                    </div>
                                </td>
                            </tr>

                            <tr v-if="!municipalities.length">
                                <td colspan="2">No Municipality to display.</td>
                            </tr>

                            <tr v-else v-for="(municipality, index) in municipalities" :key="index">
                                <td v-if="!(municipality_edit_mode && municipality_id==municipality.id)" >
                                    <a class="mr-2">{{ municipality.title }}</a><br>
                                    <small class="">Created on {{ municipality.created_at }}</small>
                                </td>
                                <td v-else>
                                    <input type="text" class="form-control"  placeholder="Municipality" v-model="municipality_edit_title">
                                </td>
                                <td class="text-right">
                                    <div class="btn-group"  v-if="!(municipality_edit_mode && municipality_id==municipality.id)">
                                        <a href="#" class="btn btn-secondary btn-sm" type="button" @click.prevent="editMunicipality(municipality)">Edit</a>
                                        <a href="#" @click.prevent="showDeleteModal(municipality.id,'municipality')" class="btn btn-danger btn-sm deleteModal" type="button">Delete</a>
                                    </div>
                                    <div class="btn-group" v-else>
                                        <button v-if="municipality_submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                                        <button v-else type="button" class="btn btn-accent btn-sm" @click.prevent="saveMunicipality">Save</button>
                                        <a href="#" class="btn btn-secondary btn-sm" type="button"
                                           @click.prevent="()=>{municipality_edit_mode=false;clearMunicipality();}">Cancel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="float-right">
                            <pagination :data="municipalities_pg" @pagination-change-page="getMunicipalities"></pagination>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Delete {{ delete_model_data.title }}</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p><strong>Attention !</strong> Are you sure you want to permanently delete this record?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="delete_submitting" type="button" class="btn btn-danger btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" v-if="delete_model_data.isfor=='municipality'" @click.prevent="deleteMunicipality">Confirm</button>
                        <button v-else type="submit" class="btn btn-danger btn-sm" @click.prevent="deletePalika">Confirm</button>
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
                palika_submitting: false,
                // delete model
                delete_model_data:{
                    title:"",
                    isfor:""
                },

                // municipality
                municipality_edit_mode:false,
                municipality_filter: '',
                municipality_submitting: false,
                municipality_id:'',
                municipality_title:'',
                municipality_edit_title:'',
                municipalities:{},
                municipalities_pg: {},

                // palika
                palika_edit_mode:false,
                palika_filter: '',
                palika_id:'',
                palika_title:'',
                palika_edit_title:'',
                palikas:{},
                palikas_pg: {},
            }
        },
        computed: {
        },
        mounted() {
            this.getMunicipalities();
            this.getPalikas();
        },
        methods: {
            // For Municipalities
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

            showDeleteModal(item_id,isfor) {
                this.delete_model_data={
                    title:isfor==="municipality"?"<unicipality":"Palika",
                    isfor
                };
                this.delete_id = item_id;
                $("#delete-dialog").modal('show');
            },

            async deleteMunicipality() {
                this.delete_submitting = true;
                const response = await DataService.deleteMunicipality(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getMunicipalities();
                    $("#delete-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },

            clearMunicipality(){
                this.municipality_edit_mode=false;
                this.municipality_id=this.municipality_title=this.municipality_edit_title='';
            },

            // For Palika

            setPalikaSearch:_.debounce(function(){
                this.getPalikas();
            }, 800),

            async savePalika(){
                this.palika_submitting = true;
                try {
                    const formData = {
                        id: this.palika_id,
                        title:this.palika_title,
                        district_id:this.district_id,
                    };
                    if(this.palika_edit_mode){
                        formData.title=this.palika_edit_title;
                    }
                    const response = await DataService.savePalika(formData);
                    console.log(response);
                    if (response.error === false) {
                        Errors.Notification(response);
                    }
                    this.clearPalika();
                    this.getPalikas();
                    this.palika_submitting = false;
                } catch (error) {
                    this.palika_submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.palika_submitting = false;
            },
            editPalika(palika){
                this.palika_edit_mode=true;
                this.palika_id=palika.id;
                this.palika_edit_title=palika.title;
            },
            async getPalikas(page = 1) {
                const response = await DataService.getPalika(page, this.palika_filter,this.district_id);
                this.palikas_pg = response.data.data.palikas;
                this.palikas = response.data.data.palikas.data;
            },
            async deletePalika() {
                this.delete_submitting = true;
                const response = await DataService.deletePalika(this.delete_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getPalikas();
                    $("#delete-dialog").modal('hide');
                }
                this.delete_id = '';
                this.delete_submitting = false;
            },
            clearPalika(){
                this.palika_edit_mode=false;
                this.palika_id=this.palika_title=this.palika_edit_title='';
            }
        }
    }
</script>

<style scoped>

</style>
