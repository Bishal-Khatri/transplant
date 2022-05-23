<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        <form-wizard ref="update-patient"
                            nextButtonText="Next"
                                     backButtonText="Back"
                                     finishButtonText="Submit"
                                     stepSize="xs"
                                     color="#34495E"
                                     shape="square"
                                     title="" subtitle=""
                                     @on-change="changeTab">
                            <tab-content title="Personal Information">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Personal Information</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Full Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="name" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Image <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="file" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                                    Gender <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="" v-model="gender" class="form-control">
                                                        <option value="">Select Gender</option>
                                                        <option value="married">Male</option>
                                                        <option value="married">Female</option>
                                                        <option value="married">Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Date Of Birth <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input v-model="date_of_birth" class="date-picker form-control" required="required" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                                    Marital Status <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="" v-model="marital_status" id="" class="form-control">
                                                        <option value="">Select Marital Status</option>
                                                        <option value="married">Married</option>
                                                        <option value="unmarried">UnMarried</option>
                                                        <option value="widowed">Widowed</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                    Occupation <span class="required">*</span>
                                                </label>

                                                <div class="col-md-9 col-sm-9">
                                                    <select name="occupation" class="form-control" v-model="occupation" >
                                                        <option value="">Select Occupation</option>
                                                        <option v-for="(occupation, index) in occupations"
                                                                :key="index"
                                                                :value="occupation.id">
                                                            {{ occupation.title }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                    Religion <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="occupation" class="form-control" v-model="religion">
                                                        <option value="">Select Religion</option>
                                                        <option v-for="(religion, index) in religions"
                                                                :key="index"
                                                                :value="religion.id">
                                                            {{ religion.title }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                    Education Level <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="occupation" class="form-control" v-model="education_level">
                                                        <option value="">Select Education Level</option>
                                                        <option v-for="(education_level, index) in education_levels"
                                                                :key="index"
                                                                :value="education_level.id">
                                                            {{ education_level.title }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                    Ethnic Group <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="occupation" class="form-control" v-model="ethnic_group">
                                                        <option value="">Select Ethnic Group</option>
                                                        <option v-for="(ethnic_group, index) in ethnic_groups"
                                                                :key="index"
                                                                :value="ethnic_group.id">
                                                            {{ ethnic_group.title }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nationality <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="nationality" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Citizenship Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="citizenship_number" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Passport Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="passport_number" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Father's Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="father_name" required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Mother's Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="mother_name" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </tab-content>
                            <tab-content title="Contact Information">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Contact Information</span>

                                </form>
                            </tab-content>
                            <tab-content title="Address">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Address</span>

                                </form>
                            </tab-content>
                            <tab-content title="Diagnosis / Treatment Information">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Diagnosis / Treatment Information</span>

                                </form>
                            </tab-content>
                            <tab-content title="Preview">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Preview</span>

                                </form>
                            </tab-content>
                        </form-wizard>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import PatientService from "../../../services/PatientService";
    import {FormWizard, TabContent} from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'

    export default {
        name: "PatientCreate",
        props:['patient', 'religions', 'ethnic_groups', 'education_levels', 'occupations'],

        data(){
            return{
                errors: new Errors(),

                // form data
                name: '',
                gender: '',
                date_of_birth: '',
                marital_status: '',
                occupation: '',
                religion: '',
                education_level: '',
                ethnic_group: '',
                nationality: '',
                citizenship_number: '',
                passport_number: '',
                father_name: '',
                mother_name: '',
            }
        },
        components: {
            FormWizard,
            TabContent
        },
        computed: {
        },
        mounted() {
        },
        methods: {
            changeTab(prevIndex,nextIndex){
                this.refs.update-patient.nextTab()
                if(prevIndex === 0){
                    // create new patient
                }
                console.log({prevIndex})
                console.log({nextIndex})
            }
        }
    }
</script>

<style scoped>

</style>
