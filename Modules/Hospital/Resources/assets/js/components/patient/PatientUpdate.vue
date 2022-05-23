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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Relative Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="relative_name" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Relation with Relative <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="relation_with_relative" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 1 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="contact_number_1" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 2 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="contact_number_2" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email Address <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="email_address" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </tab-content>
                            <tab-content title="Address">
                                <form class="form-horizontal form-label-left">
                                    <span class="section">Address</span>
                                    <span class="section">Permanent Address</span>
                                    <div class="row">
    
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <!-- <input type="text" v-model="permanent_province" required="required" class="form-control"> -->
                                                    <select v-model="permanent_province" required="required" class="form-control">
                                                        <option value="">Select Province</option>
                                                        <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="permanent_district" required="required" class="form-control" >
                                                        <option value="">Select District</option>
                                                        <option v-for="district in permanent_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="permanent_municipality" required="required" class="form-control">
                                                        <option value="">Select Municipality</option>
                                                        <option v-for="municipality in permanent_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="permanent_ward" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="permanent_tole" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <span class="section">Current Address</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="current_province" required="required" class="form-control">
                                                        <option value="">Select Province</option>
                                                        <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <!-- <input type="text" v-model="current_district" required="required" class="form-control"> -->
                                                    <select v-model="current_district" required="required" class="form-control" >
                                                        <option value="">Select District</option>
                                                        <option v-for="district in current_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="current_municipality" required="required" class="form-control">
                                                        <option value="">Select Municipality</option>
                                                        <option v-for="municipality in current_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="current_ward" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="current_tole" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </tab-content>
                            <tab-content title="Diagnosis / Treatment Information">
                                <form class="form-horizontal form-label-left">
                                    <span class="section">Diagnosis / Treatment Information</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="letter_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Date <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="date" v-model="letter_date" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">OPD Number / Year <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="opd_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Hospital Bipanna Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="hospital_bipanna_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Disease <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="disease" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Max Facilitatory Amount <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="max_facilitatory_amount" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Referred By (Palika Name) <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="referred_by" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Transplant Type <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select class="form-control" v-model="transplant_type" required="required" >
                                                        <option value="">Select Transplant Type</option>
                                                        <option value="kidney">Kidney</option>
                                                        <option value="liver">Liver</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </tab-content>
                            <tab-content title="Preview">
                                <form class="form-horizontal form-label-left">
                                    <span class="section">Preview</span>
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
                                    <span class="section">Contact Information</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Relative Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="relative_name" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Relation with Relative <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="relation_with_relative" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 1 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="contact_number_1" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 2 <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="contact_number_2" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email Address <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="email_address" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="section">Address</span>
                                    <span class="section">Permanent Address</span>
                                    <div class="row">
    
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <!-- <input type="text" v-model="permanent_province" required="required" class="form-control"> -->
                                                    <select v-model="permanent_province" required="required" class="form-control">
                                                        <option value="">Select Province</option>
                                                        <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="permanent_district" required="required" class="form-control" >
                                                        <option value="">Select District</option>
                                                        <option v-for="district in permanent_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="permanent_municipality" required="required" class="form-control">
                                                        <option value="">Select Municipality</option>
                                                        <option v-for="municipality in permanent_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="permanent_ward" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="permanent_tole" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <span class="section">Current Address</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Province <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="current_province" required="required" class="form-control">
                                                        <option value="">Select Province</option>
                                                        <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <!-- <input type="text" v-model="current_district" required="required" class="form-control"> -->
                                                    <select v-model="current_district" required="required" class="form-control" >
                                                        <option value="">Select District</option>
                                                        <option v-for="district in current_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select v-model="current_municipality" required="required" class="form-control">
                                                        <option value="">Select Municipality</option>
                                                        <option v-for="municipality in current_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="current_ward" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tole <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="current_tole" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="section">Diagnosis / Treatment Information</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="letter_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Letter Date <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="date" v-model="letter_date" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">OPD Number / Year <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="opd_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Hospital Bipanna Number <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="hospital_bipanna_number" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Disease <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="disease" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Max Facilitatory Amount <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="max_facilitatory_amount" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Referred By (Palika Name) <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <input type="text" v-model="referred_by" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align">Transplant Type <span class="required">*</span>
                                                </label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select class="form-control" v-model="transplant_type" required="required" >
                                                        <option value="">Select Transplant Type</option>
                                                        <option value="kidney">Kidney</option>
                                                        <option value="liver">Liver</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

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
    import PublicService from "../../../../../../ContentManagement/Resources/assets/services/PublicService";
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

                // address Actions
                provinces: [],
                // permanent
                permanent_districts: [],
                permanent_municipalities: [],
                // current
                current_districts: [],
                current_municipalities: [],

                // contact information
                relative_name:"",
                relation_with_relative:"",
                contact_number_1:"",
                contact_number_2:"",
                email_address:'',
                // address information
                // permanent address
                permanent_province:'',
                permanent_district:'',
                permanent_municipality:'',
                permanent_ward:'',
                permanent_tole:'',
                // current address
                current_province:'',
                current_district:'',
                current_municipality:'',
                current_ward:'',
                current_tole:'',
                // Diagnosis / Treatment Information
                letter_number:'',
                letter_date:'',
                opd_number:'',
                hospital_bipanna_number:'',
                disease:'',
                max_facilitatory_amount:'',
                referred_by:'',
                transplant_type:'',

            }
        },
        components: {
            FormWizard,
            TabContent
        },
        computed: {
        },
        mounted() {
            this.getProvince();
        },
        watch:{
            current_province(value){
                this.getCurrentDistrict(value);
            },
            current_district(value){
                this.getCurrentMunicipality(value);
            },
            permanent_province(value){
                this.getPermanentDistrict(value);
            },
            permanent_district(value){
                this.getPermanentMunicipality(value);
            },
            

        },
        methods: {
            changeTab(prevIndex,nextIndex){
                this.refs.update-patient.nextTab()
                if(prevIndex === 0){
                    // create new patient
                }
                console.log({prevIndex})
                console.log({nextIndex})
            },
            async getProvince(){
                const  response = await PublicService.getProvince();
                this.provinces = response.data.data.provinces;
            },
            // For Permanent Address
            async getPermanentDistrict(province_id){
                const  response = await PublicService.getDistrict(province_id);
                this.permanent_districts = response.data.data.districts;
            },
            async getPermanentMunicipality(district_id){
                const  response = await PublicService.getMunicipality(district_id);
                this.permanent_municipalities = response.data.data.municipalities;
            },
            async getCurrentDistrict(province_id){
                const  response = await PublicService.getDistrict(province_id);
                this.current_districts = response.data.data.districts;
            },
            async getCurrentMunicipality(district_id){
                const  response = await PublicService.getMunicipality(district_id);
                this.current_municipalities = response.data.data.municipalities;
            },
        }
    }
</script>

<style scoped>

</style>
