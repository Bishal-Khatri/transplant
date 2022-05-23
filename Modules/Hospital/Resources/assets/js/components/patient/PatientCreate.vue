<template>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_content">
                        <form-wizard nextButtonText="Next"
                                     backButtonText="Back"
                                     finishButtonText="Submit"
                                     stepSize="xs"
                                     color="#34495E"
                                     shape="square"
                                     title="" subtitle=""
                                     @on-change="nextTab">
                            <tab-content title="Personal Information">
                                <form class="form-horizontal form-label-left">

                                    <span class="section">Personal Information</span>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">First Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="first-name2" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Last Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="text" id="last-name2" name="last-name" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Middle Name / Initial</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input id="middle-name2" class="form-control " type="text" name="middle-name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                        <div class="col-md-6 col-sm-6">
                                            <div id="gender2" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-secondary">
                                                    <input type="radio" name="gender" value="male" class="join-btn"> &nbsp; Male &nbsp;
                                                </label>
                                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-secondary">
                                                    <input type="radio" name="gender" value="female" class="join-btn" checked=""> Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <input id="birthday2" class="date-picker form-control" required="required" type="text">
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
        data(){
            return{
                errors: new Errors(),
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
            nextTab(prevIndex,nextIndex){
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
