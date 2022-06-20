<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <section>
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>Personal Information</h2>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="text-accent" :href="'/hospital/patient/update/'+patient.id">Edit Profile</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Full Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text"  required="required" class="form-control"  :value="`${patient.name ? patient.name:''}`" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Citizenship Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" required="required" class="form-control"   :value="`${patient.citizenship_number ? patient.citizenship_number:''}`"  disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Passport Number
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.passport_number ? patient.passport_number:''}`" required="required" class="form-control" disabled>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Image
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <img :src="`/storage/${patient.image ? patient.image:''}`" class="image-xl rounded" @click.prevent="$refs.imagePreview.openDialog('/storage/'+patient.image)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                        Gender <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input  :value="`${patient.gender ? patient.gender:''}`" class="form-control" disabled/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Date Of Birth <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.date_of_birth ? patient.date_of_birth:''}`" class="form-control" disabled required="required" type="text">
                                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                        <span class="text-sm text-info">Date format: dd/mm/yyyy</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                        Marital Status <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input  :value="`${patient.marital_status ? patient.marital_status:''}`" class="form-control" disabled/>


                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Occupation
                                    </label>

                                    <div class="col-md-9 col-sm-9">
                                        <input name="occupation" class="form-control" disabled :value="`${patient.occupation ? patient.occupation.title:''}`" >

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Religion
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input name="occupation" class="form-control" disabled :value="`${patient.religion ? patient.religion.title:''}`"/>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Education Level
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input name="occupation" class="form-control" disabled :value="`${patient.education_level ? patient.education_level.title:''}`"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Ethnic Group
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input name="occupation" class="form-control" disabled :value="`${patient.ethnic_group ? patient.ethnic_group.title:''}`"/>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Nationality
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.nationality ? patient.nationality:''}`" required="required" class="form-control" disabled>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Father's Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.father_name ? patient.father_name:''}`" required="required" class="form-control" disabled>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                        Mother's Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.mother_name ? patient.mother_name:''}`" required="required" class="form-control" disabled>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>Contact Information</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Email Address <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.email_address ? patient.email_address:''}`" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Relative Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.relative_name ? patient.relative_name:''}`" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 1 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.contact_number_1 ? patient.contact_number_1:''}`" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Relation with Relative <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.relation_with_relative ? patient.relation_with_relative:''}`" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 2 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.contact_number_2 ? patient.contact_number_2:''}`" required="required" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>Address Information</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Permanent Address</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.permanent_province ? patient.permanent_province.title:''}`" required="required"  class="form-control" disabled/>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.permanent_district ? patient.permanent_district.title:''}`" required="required"  class="form-control" disabled >

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.permanent_municipality ? patient.permanent_municipality.title:''}`" required="required"  class="form-control" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.permanent_ward ? patient.permanent_ward:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.permanent_tole ? patient.permanent_tole:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Current Address</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.current_province ? patient.current_province.title:''}`" required="required"  class="form-control" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">

                                        <input :value="`${patient.current_district ? patient.current_district.title:''}`" required="required"  class="form-control" disabled >

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input :value="`${patient.current_municipality ? patient.current_municipality.title:''}`" required="required"  class="form-control" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.current_ward ? patient.current_ward:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.current_tole ? patient.current_tole:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>Diagnosis / Treatment Information</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.letter_number ? patient.letter_number:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Date <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="date" :value="`${patient.letter_date ? patient.letter_date:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">OPD Number / Year <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.opd_number ? patient.opd_number:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Disease <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <span v-if="patient.disease" class="ml-2 badge badge-secondary" style="padding:10px"
                                              v-for="disease in patient.disease"
                                              :key="disease.id">
                                            {{ disease.title }}
                                        </span>
                                        <!--<input type="text" :value="`${patient.disease ? patient.disease:''}`" required="required"  class="form-control" disabled>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Referred By (Palika Name) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input type="text" :value="`${patient.referred_by ? patient.referred_by:''}`" required="required"  class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Transplant Type <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9">
                                        <input  class="form-control" disabled :value="`${patient.transplant_type ? patient.transplant_type.toUpperCase() : ''}`" required="required" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <template v-if="patient.transplant_type === 'kidney'">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                            Dialysis Start Date
                                        </label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="date" :value="`${patient.dialysis_start_date ? patient.dialysis_start_date:''}`" required="required" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">HLA Tissue Type</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="text" :value="patient.hal_tissue_type" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                            Cross Match CDC
                                        </label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="text" :value="patient.cross_match_cdc" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                            DSA Titre
                                        </label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="text" :value="patient.dsa_titre" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                            PRA
                                        </label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="text" :value="patient.pra" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else-if="patient.transplant_type === 'liver'">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">MELD Score</label>
                                        <div class="col-md-9 col-sm-9">
                                            <input type="text" :value="patient.meld_score" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </section>
            <image-preview ref="imagePreview"/>

        </div>
    </div>
</template>
<script>
    import ImagePreview from "../../../../../../../resources/js/components/ImagePreview";
    export default {
        name: "PatientPreview",
        props: ['patient'],
        mounted(){
            // console.log(this.patient);
        },
        components: {
            ImagePreview
        }
    }
</script>
