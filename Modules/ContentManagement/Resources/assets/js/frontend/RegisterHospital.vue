<template>
    <section class="mt-0 pt-0">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-4">
                    <div class="boxed bg--secondary boxed--lg boxed--border">
                        <h4>Hospital Registration Form</h4>
                        <p>
                            Using the
                            <a href="http://getbootstrap.com/css/#grid" target="_blank">Bootstrap column classes</a>, you can easily control the widths of the inputs in your form.
                        </p>
                        <p>
                            The below code would render a form with two equally sized (six columns) inputs in two adjacent columns.
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, dicta et nihil odio quia quis recusandae! Cupiditate ea esse labore porro possimus quisquam sapiente vel. Error exercitationem ipsa ipsam tenetur.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="boxed boxed--border" v-if="display_success_message">
                        <h5>Success</h5>
                        <p>
                            Your form has been submitted successfully. Please check your email form approval message.
                        </p>
                        <a class="btn btn--primary" href="#" @click.prevent="display_success_message = false;">
                            <span class="btn__text">Show Form</span>
                        </a>
                    </div>
                    <div class="boxed bg--secondary boxed--lg boxed--border" v-else>
                        <form class="row" @submit.prevent="submit">

                            <div class="col-md-12">
                                <label>Hospital Name</label>
                                <input type="text" name="name" placeholder="Type Name Here" v-model="hospital_name"/>
                                <span class="small text-danger" v-html="errors.get('hospital_name')"></span>
                            </div>

                            <div class="col-md-6">
                                <label>Province</label>
                                <div class="input-select">
                                    <select @change.prevent="getDistrict" v-model="province" >
                                        <option value="">Select Province</option>
                                        <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                    </select>
                                    <span class="small text-danger" v-html="errors.get('province')"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>District</label>
                                <div class="input-select">
                                    <select @change.prevent="getMunicipality" :disabled="district_disable" v-model="district" >
                                        <option value="">Select District</option>
                                        <option v-for="district in districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                    </select>
                                    <span class="small text-danger" v-html="errors.get('district')"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Municipality</label>
                                <div class="input-select">
                                    <select :disabled="municipality_disable" v-model="municipality" >
                                        <option value="">Select Municipality</option>
                                        <option v-for="municipality in municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                    </select>
                                    <span class="small text-danger" v-html="errors.get('municipality')"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Palika</label>
                                <input type="text" class="form-control" name="palika" placeholder="Palika Name" v-model="palika" >
                                <span class="small text-danger" v-html="errors.get('palika')"></span>
                            </div>

                            <div class="col-md-6">
                                <label>Hospital Type</label>
                                <div class="input-select">
                                    <select v-model="hospital_type" >
                                        <option value="">Select Hospital Type</option>
                                        <option value="1">Government</option>
                                        <option value="2">Private</option>
                                    </select>
                                    <span class="small text-danger" v-html="errors.get('hospital_type')"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Transplant Type</label>
                                <div class="input-select">
                                    <select v-model="transplant_type" >
                                        <option value="">Select Transplant Type</option>
                                        <option value="kidney">KIDNEY</option>
                                        <option value="liver">LIVER</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label>Application Letter <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="application_letter" @change="handelImage($event, 'application_letter')"  >
                                <span class="small text-danger" v-html="errors.get('application_letter')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>Human Resource <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="human_resource"  @change="handelImage($event, 'human_resource')">
                                <span class="small text-danger" v-html="errors.get('human_resource')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>Tools List <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="tools_list" @change="handelImage($event, 'tools_list')">
                                <span class="small text-danger" v-html="errors.get('tools_list')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>Administrative Document <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="administrative_document" @change="handelImage($event, 'administrative_document')">
                                <span class="small text-danger" v-html="errors.get('administrative_document')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>Sanchalan Swrikity <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="sanchalan_swikriti"  @change="handelImage($event, 'sanchalan_swikriti')">
                                <span class="small text-danger" v-html="errors.get('sanchalan_swikriti')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>Renewal Letter <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="renewal_letter" @change="handelImage($event, 'renewal_letter')">
                                <span class="small text-danger" v-html="errors.get('renewal_letter')"></span>
                            </div>

                            <div class="col-md-12">
                                <label>PAN <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="pan"  @change="handelImage($event, 'pan')">
                                <span class="small text-danger" v-html="errors.get('pan')"></span>
                            </div>
                            <div class="col-md-12">
                                <label>TAX Clearance <span class="small text-info ml-1">Supported file type: < JPEG, JPG, PNG ></span></label>
                                <input type="file" class="form-control" name="tax_clearance"  @change="handelImage($event, 'tax_clearance')">
                                <span class="small text-danger" v-html="errors.get('tax_clearance')"></span>
                            </div>


                            <div class="col-md-12">
                                <div class="input-checkbox">
                                    <input type="checkbox" name="agree" v-model="agree" />
                                    <label></label>
                                </div>
                                <span>I have read and agree to the<a href="#">terms and conditions</a></span>
                            </div>
                                <span class="small text-danger" v-html="errors.get('agree')" style="margin-top: -2rem;margin-left: 2rem;"></span>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn--primary" v-if="submitting">Submitting Form ....</button>
                                <button type="submit" class="btn btn--primary" v-else>Submit Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
</template>

<script>
    import PublicService from "../../services/PublicService";
    import {Errors} from "../../../../../../resources/js/error";
    import HospitalFrontendService from "../../services/HospitalFrontendService";
    export default {
        name:"RegisterHospital",
        props: {
        },
        components: {
        },
        data:()=>({
            errors: new Errors(),
            submitting: false,
            district_disable: true,
            municipality_disable: true,
            display_success_message: false,

            // form data
            hospital_name: "",
            province:"",
            district:"",
            municipality:"",
            palika:"",
            hospital_type: '',
            transplant_type: '',
            application_letter: '',
            human_resource: '',
            tools_list: '',
            administrative_document: '',
            sanchalan_swikriti: '',
            renewal_letter: '',
            pan: '',
            tax_clearance: '',
            agree: false,


            provinces:{},
            districts: {},
            municipalities:{},
            palikas:{},
        }),
        mounted(){
            this.getProvince();
        },
        methods: {
            async getProvince(){
                const  response = await PublicService.getProvince();
                this.provinces = response.data.data.provinces;
            },

            async getDistrict(){
                const response = await PublicService.getDistrict(this.province);
                this.districts=response.data.data.districts;
                this.district_disable = false;
            },

            async getMunicipality(){
                const response = await PublicService.getMunicipality(this.district);
                this.municipalities=response.data.data.municipalities;
                this.municipality_disable = false;
            },

            handelImage(event, modal){
                if (modal === 'application_letter'){
                    this.application_letter = event.target.files[0];
                }
                if (modal === 'human_resource'){
                    this.human_resource = event.target.files[0];
                }
                if (modal === 'tools_list'){
                    this.tools_list = event.target.files[0];
                }
                if (modal === 'administrative_document'){
                    this.administrative_document = event.target.files[0];
                }
                if (modal === 'sanchalan_swikriti'){
                    this.sanchalan_swikriti = event.target.files[0];
                }
                if (modal === 'renewal_letter'){
                    this.renewal_letter = event.target.files[0];
                }
                if (modal === 'pan'){
                    this.pan = event.target.files[0];
                }
                if (modal === 'tax_clearance'){
                    this.tax_clearance = event.target.files[0];
                }

            },

            async submit(){
                this.submitting = true;
                try {
                    let formData = new FormData();
                    formData.append("hospital_name", this.hospital_name);
                    this.province ? formData.append("province", this.province) : '';
                    this.district ? formData.append("district", this.district) : '';
                    this.municipality ? formData.append("municipality", this.municipality) : '';

                    this.palika ? formData.append("palika", this.palika) : '';
                    formData.append("hospital_type", this.hospital_type);
                    formData.append("transplant_type", this.transplant_type);
                    this.application_letter ? formData.append("application_letter", this.application_letter) : '';
                    this.human_resource ? formData.append("human_resource", this.human_resource) : '';
                    this.tools_list ? formData.append("tools_list", this.tools_list) : '';
                    this.administrative_document ? formData.append("administrative_document", this.administrative_document) : '';
                    this.sanchalan_swikriti ? formData.append("sanchalan_swikriti", this.sanchalan_swikriti) : '';
                    this.renewal_letter ? formData.append("renewal_letter", this.renewal_letter) : '';
                    this.pan ? formData.append("pan", this.pan) : '';
                    this.tax_clearance ? formData.append("tax_clearance", this.tax_clearance) : '';
                    formData.append("agree", this.agree?1:0);

                    if(this.application_letter){
                        formData.append("application_letter", this.application_letter, this.application_letter.name);
                    }
                    if(this.human_resource){
                        formData.append("human_resource", this.human_resource, this.human_resource.name);
                    }
                    if(this.tools_list){
                        formData.append("tools_list", this.tools_list, this.tools_list.name);
                    }
                    if(this.administrative_document){
                        formData.append("administrative_document", this.administrative_document, this.administrative_document.name);
                    }
                    if(this.sanchalan_swikriti){
                        formData.append("sanchalan_swikriti", this.sanchalan_swikriti, this.sanchalan_swikriti.name);
                    }
                    if(this.renewal_letter){
                        formData.append("renewal_letter", this.renewal_letter, this.renewal_letter.name);
                    }
                    if(this.pan){
                        formData.append("pan", this.pan, this.pan.name);
                    }
                    if(this.tax_clearance){
                        formData.append("tax_clearance", this.tax_clearance, this.tax_clearance.name);
                    }
                    
                    const response = await HospitalFrontendService.registerHospital(formData);
                    if (response.data.error === false) {
                        this.display_success_message = true;
                        this.clearForm();
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                }
                this.submitting = false;
            },

            clearForm(){
                this.hospital_name = '';
                this.errors.clear();
            }
        },
    };
</script>

<style>
</style>
