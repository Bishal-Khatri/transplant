<template>
    <div>
        <template v-if="patient_details_loading">
            <div class="row">
                <div class="col-md-12 ">
                    <section class="x_panel" >
                        <div class="panel-body d-flex justify-content-center align-items-center" style="height: 80vh;">
                            <i class="fa fa-spinner fa-spin " style=""></i>
                        </div>
                    </section>
                </div>
            </div>
        </template>

        <template v-else>
            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_content">
                            <form-wizard ref="updatePatient"
                                         stepSize="xs"
                                         color="#34495E"
                                         shape="square"
                                         @on-change="onTabChange"
                                         title="" subtitle="">

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
                                                        <span class="form-text small text-danger" v-html="errors.get('name')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Image
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <div class="d-flex">
                                                            <img v-if="patient_image_url" :src="patient_image_url" alt="" class="image-sm mr-2 rounded">
                                                            <input type="file" required="required" class="form-control" id="image" @change.prevent="handelImage">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Citizenship Number <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="citizenship_number" required="required" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Passport Number
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="passport_number" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('passport_number')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
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
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Date of birth (AD) <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input v-model="date_of_birth" class="form-control" required="required" type="date">
                                                        <span class="text-sm text-info">Date format: month / day / year</span>
                                                        <span class="form-text small text-danger" v-html="errors.get('date_of_birth')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                                        Marital Status <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <select name="" v-model="marital_status" class="form-control">
                                                            <option value="">Select Marital Status</option>
                                                            <option value="married">Married</option>
                                                            <option value="unmarried">UnMarried</option>
                                                            <option value="widowed">Widowed</option>
                                                            <option value="divorced">Divorced</option>
                                                            <option value="separated">Separated</option>
                                                        </select>
                                                        <span class="form-text small text-danger" v-html="errors.get('marital_status')"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Occupation
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
                                                        <span class="form-text small text-danger" v-html="errors.get('occupation')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Religion
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
                                                        <span class="form-text small text-danger" v-html="errors.get('religion')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Education Level
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
                                                        <span class="form-text small text-danger" v-html="errors.get('education_level')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Ethnic Group
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
                                                        <span class="form-text small text-danger" v-html="errors.get('ethnic_group')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Nationality
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="nationality" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('nationality')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Father's Name <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="father_name" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('father_name')"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                        Mother's Name <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="mother_name" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('mother_name')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </tab-content>

                                <tab-content title="Contact Information & Address">
                                    <form class="form-horizontal form-label-left">

                                        <span class="section">Contact Information</span>
                                        <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Email Address <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="email_address" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('email_address')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Relative Name <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="relative_name" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('relative_name')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 1 <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="contact_number_1" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('contact_number_1')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Relation with Relative <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="relation_with_relative" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('relation_with_relative')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Contact Number 2 <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="contact_number_2" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('contact_number_2')"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
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
                                                        <span class="form-text small text-danger" v-html="errors.get('permanent_province_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" value="Select District" required="required" class="form-control" v-if="!permanent_province_is_loaded" readonly>
                                                        <select v-model="permanent_district" required="required" class="form-control" v-else>
                                                            <option value="">Select District</option>
                                                            <option v-for="district in permanent_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                        </select>
                                                        <span class="form-text small text-danger" v-html="errors.get('permanent_district_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" value="Select Municipality" required="required" class="form-control" v-if="!permanent_district_is_loaded" readonly>
                                                        <select v-else v-model="permanent_municipality" required="required" class="form-control">
                                                            <option value="">Select Municipality</option>
                                                            <option v-for="municipality in permanent_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                        </select>
                                                         <span class="form-text small text-danger" v-html="errors.get('permanent_municipality_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="permanent_ward" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('permanent_ward')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tole
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="permanent_tole" required="required" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="section">
                                            Current Address
                                            <span style="font-size:.8rem;">
                                                <input type="checkbox" v-model="same_as_permanent_address" >
                                                Same as Permanent Address
                                            </span>
                                        </span>
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
                                                        <span class="form-text small text-danger" v-html="errors.get('current_province_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">District <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" value="Select District" required="required" class="form-control" v-if="!current_province_is_loaded" readonly>
                                                        <select v-else v-model="current_district" required="required" class="form-control" >
                                                            <option value="">Select District</option>
                                                            <option v-for="district in current_districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                                        </select>
                                                        <span class="form-text small text-danger" v-html="errors.get('current_district_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Municipality <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" value="Select Municipality" required="required" class="form-control" v-if="!current_district_is_loaded" readonly>
                                                        <select v-else v-model="current_municipality" required="required" class="form-control">
                                                            <option value="">Select Municipality</option>
                                                            <option v-for="municipality in current_municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                                        </select>
                                                        <span class="form-text small text-danger" v-html="errors.get('current_municipality_id')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Ward <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="current_ward" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('current_ward')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Tole
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
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Diseases</label>
                                                    <div class="col-md-9 col-sm-9 ">
                                                        <select class="select2_multiple form-control" multiple v-model="disease">
                                                            <option v-for="disease in diseases"
                                                                    :key="disease.id" :value="disease.id">
                                                                {{ disease.title }}
                                                            </option>
                                                        </select>
                                                        <br>
                                                        <span v-if="patient.disease" v-for="disease in patient.disease" class="ml-2">{{ disease.title }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Referred By (Palika Name) <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <input type="text" v-model="referred_by" required="required" class="form-control">
                                                        <span class="form-text small text-danger" v-html="errors.get('referred_by')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Blood Group</label>
                                                    <div class="col-md-9 col-sm-9">
                                                        <select class="form-control" v-model="blood_group" required="required">
                                                            <option value="">Select Blood Group</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Transplant Type <span class="required">*</span>
                                                    </label>
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
                                        </div>
                                        <br>
                                        <template v-if="transplant_type === 'kidney'">
                                            <span class="section">HLL Typing</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                            Dialysis Start Date
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="date" v-model="dialysis_start_date" required="required" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                                                            PRA
                                                        </label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="pra" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--HLA tissue type start-->
                                                <div class="col-md-6">
                                                    <div class="form-group row ">
                                                        <h4 class="col-form-label col-md-3 col-sm-3 label-align">Patient</h4>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> HLA -A*</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="patient_hla_a">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> HLA -B</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="patient_hla_b">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> HLA -DRB1</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="patient_hla_drb1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row ">
                                                        <h4 class="col-form-label col-md-3 col-sm-3 label-align">Donor</h4>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align">HLA -A*</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="donor_hla_a">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> HLA -B</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="donor_hla_b">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> HLA -DRB1</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text"  class="form-control" v-model="donor_hla_drb1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--HLA tissue type end-->

                                                <!--CDC start-->
                                                <div class="col-md-6">
                                                    <h4 class="col-form-label col-md-3 col-sm-3 label-align">Cross Match CDC</h4>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> T cell</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="cdc_t_cell" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> B cell</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="cdc_B_cell" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--CDC End-->

                                                <!--DSA Start-->
                                                <div class="col-md-6">
                                                    <h4 class="col-form-label col-md-3 col-sm-3 label-align">DSA Titre</h4>
                                                </div>
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Class 1</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="dsa_class_1" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Class 2</label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="dsa_class_2" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--DSA END-->

                                            </div>
                                        </template>
                                        <template v-else-if="transplant_type === 'liver'">
                                            <span class="section">Liver Transplant</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align">MELD Score <span class="required">*</span></label>
                                                        <div class="col-md-9 col-sm-9">
                                                            <input type="text" v-model="meld_score" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </form>
                                </tab-content>

                                <tab-content title="Preview">
                                    <patient-preview :patient="patient"/>
                                </tab-content>

                                <template slot="footer" slot-scope="props">
                                    <div class="wizard-footer-left">
                                        <button v-if="props.activeTabIndex > 0" class="btn btn-accent" @click.prevent="$refs.updatePatient.prevTab()">Back</button>
                                    </div>
                                    <div class="wizard-footer-right">
                                        <button class="btn btn-accent" v-if="!props.isLastStep" @click.prevent="submitForm(submitFormName)"><i v-if="submitting" class="fa fa-spinner fa-spin"></i> Save & Proceed</button>
                                        <a class="btn btn-accent" v-else-if="auth_user.user_type === 'administrator'" href="/admin/patient">Done</a>
                                        <a class="btn btn-accent" v-else href="/hospital/patient">Done</a>
                                    </div>
                                </template>
                            </form-wizard>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../resources/js/error";
    import PatientService from "../../../services/PatientService";
    import PublicService from "../../../../../../ContentManagement/Resources/assets/services/PublicService";
    import {FormWizard, TabContent, WizardButton} from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css';
    import PatientPreview from "./PatientPreview";

    export default {
        name: "PatientCreate",
        props:['patient_id','religions', 'ethnic_groups', 'education_levels', 'occupations', 'diseases', 'auth_user'],

        data(){
            return{
                errors: new Errors(),
                tmp_current_address: {},
                same_as_permanent_address: false,

                // initial data 'patient'
                patient:{},

                // isLastStep: false,
                submitting: false,
                patient_details_loading: false,
                // form data
                name: '',
                image:'',
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

                patient_image_url:'',

                // submit
                submitFormName: 'personal_information',

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

                // is loading
                permanent_province_is_loaded: false,
                permanent_district_is_loaded: false,

                // current address
                current_province:'',
                current_district:'',
                current_municipality:'',
                current_ward:'',
                current_tole:'',

                // is loading
                current_province_is_loaded: false,
                current_district_is_loaded: false,

                // Diagnosis / Treatment Information
                disease: [],
                referred_by:'',
                blood_group: '',
                transplant_type:'',

                // kidney
                dialysis_start_date: '',
                pra: '',
                // HLA
                hla_a_m: '',
                hla_a_f: '',
                hla_b_m: '',
                hla_b_f: '',
                hla_dr_m: '',
                hla_dr_f: '',
                cdc_t_cell: '',
                cdc_B_cell: '',
                dsa_class_1: '',
                dsa_class_2: '',

                // liver
                meld_score: '',

                // HLL Typing
                // patient
                patient_hla_a:'',
                patient_hla_b:'',
                patient_hla_drb1:'',

                // donor
                donor_hla_a:'',
                donor_hla_b:'',
                donor_hla_drb1:'',

            }
        },
        components: {
            FormWizard,
            TabContent,
            WizardButton,
            PatientPreview
        },
        computed: {
        },
        async mounted() {
            this.getProvince();
            this.patient_details_loading = true;
            await this.getPatient();
            await this.initForm();
            this.patient_details_loading = false;
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
            same_as_permanent_address(){
                if(this.same_as_permanent_address){
                    this.tmp_current_address= {
                        province: this.current_province,
                        district: this.current_district,
                        municipality: this.current_municipality,
                        ward: this.current_ward,
                        tole: this.current_tole
                    };
                    this.current_province = this.permanent_province;
                    this.current_district = this.permanent_district;
                    this.current_municipality = this.permanent_municipality;
                    this.current_ward = this.permanent_ward;
                    this.current_tole = this.permanent_tole;
                }else{
                    if(this.tmp_current_address !={}){
                        this.current_province = this.tmp_current_address.province;
                        this.current_district = this.tmp_current_address.district;
                        this.current_municipality = this.tmp_current_address.municipality;
                        this.current_ward = this.tmp_current_address.ward;
                        this.current_tole = this.tmp_current_address.tole;
                    }
                }

            }
        },
        methods: {
            isLastStep() {
                if (this.$refs.updatePatient) {
                    return this.$refs.updatePatient.isLastStep
                }
                return false
            },

            onTabChange(oldIndex, newIndex){
                if(newIndex === 0){
                    this.submitFormName = 'personal_information';
                }else if(newIndex === 1){
                    this.submitFormName = 'contact_information';
                }else if(newIndex === 2){
                    this.submitFormName = 'diagnosis_information';
                }
            },
            initForm(){
                this.name = this.patient.name;
                this.patient_image_url = this.patient.image ? '/storage/'+this.patient.image : '';
                this.gender = this.patient.gender;
                this.date_of_birth = this.patient.date_of_birth;
                this.marital_status = this.patient.marital_status;
                this.occupation = this.patient.occupation_id;
                this.religion = this.patient.religion_id;
                this.education_level = this.patient.education_level_id;
                this.ethnic_group = this.patient.ethnic_group_id;
                this.nationality = this.patient.nationality;
                this.citizenship_number = this.patient.citizenship_number;
                this.passport_number = this.patient.passport_number;
                this.father_name = this.patient.father_name;
                this.mother_name = this.patient.mother_name;

                this.relative_name = this.patient.relative_name;
                this.relation_with_relative = this.patient.relation_with_relative;
                this.contact_number_1 = this.patient.contact_number_1;
                this.contact_number_2 = this.patient.contact_number_2;
                this.email_address = this.patient.email_address;

                this.permanent_province = this.patient.permanent_province_id??'';
                this.permanent_district = this.patient.permanent_district_id??'';
                this.permanent_municipality = this.patient.permanent_municipality_id??'';
                this.permanent_ward = this.patient.permanent_ward;
                this.permanent_tole = this.patient.permanent_tole;

                this.current_province = this.patient.current_province_id??'';
                this.current_district = this.patient.current_district_id??'';
                this.current_municipality = this.patient.current_municipality_id??'';
                this.current_ward = this.patient.current_ward;
                this.current_tole = this.patient.current_tole;

                // disease
                var disease = this.patient.disease.map(function(object) {
                    return object.id;
                });
                this.disease = disease;
                this.blood_group = this.patient.blood_group;
                this.referred_by = this.patient.referred_by;
                this.transplant_type = this.patient.transplant_type;

                // kidney
                this.dialysis_start_date = this.patient.dialysis_start_date;
                this.pra = this.patient.pra;

                this.hla_a_m = this.patient.hla_a_m;
                this.hla_a_f = this.patient.hla_a_f;
                this.hla_b_m = this.patient.hla_b_m;
                this.hla_b_f = this.patient.hla_b_f;
                this.hla_dr_m = this.patient.hla_dr_m;
                this.hla_dr_f = this.patient.hla_dr_f;
                this.cdc_t_cell = this.patient.cdc_t_cell;
                this.cdc_B_cell = this.patient.cdc_B_cell;
                this.dsa_class_1 = this.patient.dsa_class_1;
                this.dsa_class_2 = this.patient.dsa_class_2;

                this.patient_hla_a = this.patient.patient_hla_a;
                this.patient_hla_b = this.patient.patient_hla_b;
                this.patient_hla_drb1 = this.patient.patient_hla_drb1;

                this.donor_hla_a = this.patient.donor_hla_a;
                this.donor_hla_b = this.patient.donor_hla_b;
                this.donor_hla_drb1 = this.patient.donor_hla_drb1;

                // liver
                this.meld_score = this.patient.meld_score;


            },

            async submitForm(page_name){
                this.submitting = true;
                let formData = new FormData();
                let nextForm = '';
                formData.append('patient_id', this.patient.id);
                if(page_name === 'personal_information'){
                    formData.append('page', page_name);
                    this.patient_image ? formData.append("patient_image", this.patient_image, this.patient_image.name) : '';
                    this.name ? formData.append("name", this.name) : '';
                    this.gender ? formData.append("gender", this.gender) : '';
                    this.image? formData.append("image", this.image) : '';
                    this.date_of_birth ? formData.append("date_of_birth", this.date_of_birth) : "";
                    this.marital_status ? formData.append("marital_status", this.marital_status) : '';
                    this.occupation ? formData.append("occupation", this.occupation) : '';
                    this.religion ? formData.append("religion", this.religion) : '';
                    this.education_level ? formData.append("education_level", this.education_level) : '';
                    this.ethnic_group ? formData.append("ethnic_group", this.ethnic_group) : '';
                    this.nationality ? formData.append("nationality", this.nationality) : '';
                    // this.citizenship_number ? formData.append("citizenship_number", this.citizenship_number) : '';
                    this.passport_number ? formData.append("passport_number", this.passport_number) : '';
                    this.father_name ? formData.append("father_name", this.father_name) : '';
                    this.mother_name ? formData.append("mother_name", this.mother_name) : '';
                    nextForm ="contact_information";

                }else if(page_name === 'contact_information'){
                    formData.append('page', page_name);
                    this.relative_name ? formData.append("relative_name", this.relative_name) : '';
                    this.relation_with_relative ? formData.append("relation_with_relative", this.relation_with_relative) : '';
                    this.contact_number_1 ? formData.append("contact_number_1", this.contact_number_1) : '';
                    this.contact_number_2 ? formData.append("contact_number_2", this.contact_number_2) : '';
                    this.email_address ? formData.append("email_address", this.email_address) : '';
                    this.permanent_province ? formData.append("permanent_province_id", this.permanent_province) : '';
                    this.permanent_district ? formData.append("permanent_district_id", this.permanent_district) : '';
                    this.permanent_municipality ? formData.append("permanent_municipality_id", this.permanent_municipality) : '';
                    this.permanent_ward ? formData.append("permanent_ward", this.permanent_ward) : '';
                    this.permanent_tole ? formData.append("permanent_tole", this.permanent_tole) : '';
                    this.current_province ? formData.append("current_province_id", this.current_province) : '';
                    this.current_district ? formData.append("current_district_id", this.current_district) : '';
                    this.current_municipality ? formData.append("current_municipality_id", this.current_municipality) : '';
                    this.current_ward ? formData.append("current_ward", this.current_ward) : '';
                    this.current_tole ? formData.append("current_tole", this.current_tole) : '';
                    nextForm = "diagnosis_information";
                }else if(page_name === 'diagnosis_information'){
                    formData.append('page', page_name);
                    this.disease ? formData.append("disease", JSON.stringify(this.disease)) : '';
                    this.referred_by ? formData.append("referred_by", this.referred_by) : '';
                    this.transplant_type ? formData.append("transplant_type", this.transplant_type) : '';
                    this.blood_group ? formData.append("blood_group", this.blood_group) : '';

                    // kidney
                    this.dialysis_start_date ? formData.append("dialysis_start_date", this.dialysis_start_date) : '';
                    this.pra ? formData.append("pra", this.pra) : '';

                    this.hla_a_m ? formData.append("hla_a_m", this.hla_a_m) : '';
                    this.hla_a_f ? formData.append("hla_a_f", this.hla_a_f) : '';
                    this.hla_b_m ? formData.append("hla_b_m", this.hla_b_m) : '';
                    this.hla_b_f ? formData.append("hla_b_f", this.hla_b_f) : '';
                    this.hla_dr_m ? formData.append("hla_dr_m", this.hla_dr_m) : '';
                    this.hla_dr_f ? formData.append("hla_dr_f", this.hla_dr_f) : '';
                    this.cdc_t_cell ? formData.append("cdc_t_cell", this.cdc_t_cell) : '';
                    this.cdc_B_cell ? formData.append("cdc_B_cell", this.cdc_B_cell) : '';
                    this.dsa_class_1 ? formData.append("dsa_class_1", this.dsa_class_1) : '';
                    this.dsa_class_2 ? formData.append("dsa_class_2", this.dsa_class_2) : '';

                    this.patient_hla_a ? formData.append("patient_hla_a", this.patient_hla_a) : '';
                    this.patient_hla_b ? formData.append("patient_hla_b", this.patient_hla_b) : '';
                    this.patient_hla_drb1 ? formData.append("patient_hla_drb1", this.patient_hla_drb1) : '';

                    this.donor_hla_a ? formData.append("donor_hla_a", this.donor_hla_a) : '';
                    this.donor_hla_b ? formData.append("donor_hla_b", this.donor_hla_b) : '';
                    this.donor_hla_drb1 ? formData.append("donor_hla_drb1", this.donor_hla_drb1) : '';

                    // liver
                    this.meld_score ? formData.append("meld_score", this.meld_score) : '';
                    nextForm = "preview";
                }
                try {
                    const response = await PatientService.updatePatient(formData);
                    if(response.data.error === false){
                        Errors.Notification(response);
                        this.submitFormName = nextForm;
                        await this.getPatient();
                        this.$refs.updatePatient.nextTab();
                        this.errors.clear();

                    }
                }catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                this.submitting = false;
            },

            handelImage(){
                this.image= $("#image")[0].files[0];
            },

            async getProvince(){
                const  response = await PublicService.getProvince();
                this.provinces = await response.data.data.provinces;
            },
            // For Permanent Address
            async getPermanentDistrict(province_id){
                if(this.permanent_province >0){
                    this.permanent_province_is_loaded = true;
                }
                const  response = await PublicService.getDistrict(province_id);
                this.permanent_districts = response.data.data.districts;
            },
            async getPermanentMunicipality(district_id){
                if(this.permanent_district >0){
                    this.permanent_district_is_loaded = true;
                }
                const  response = await PublicService.getMunicipality(district_id);
                this.permanent_municipalities = response.data.data.municipalities;
            },
            async getCurrentDistrict(province_id){
                if(this.current_province >0){
                    this.current_province_is_loaded = true;
                }
                const  response = await PublicService.getDistrict(province_id);
                this.current_districts = response.data.data.districts;
            },
            async getCurrentMunicipality(district_id){
                if(this.current_district >0){
                    this.current_district_is_loaded = true;
                }
                const  response = await PublicService.getMunicipality(district_id);
                this.current_municipalities = response.data.data.municipalities;
            },
            // initialize the form
            async getPatient(){
                const response = await PatientService.getPatient(this.patient_id);
                if(response.data.error === false){
                    const data=response.data.data;
                    this.patient = data.patient;
                }
            }
        }
    }
</script>

<style scoped>

</style>
