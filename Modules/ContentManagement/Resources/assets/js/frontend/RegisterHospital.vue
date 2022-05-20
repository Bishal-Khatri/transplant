<template>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <!-- when ever i use wizard class v-model is not working -->
            <div class="wizard">
                <h5>Intro</h5>
                <section class="text-center">
                    <div class="pos-vertical-center">
                            <div class="form-group">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control" v-model="hospital_name" placeholder="Enter Hospital Name">
                            </div>                      
                            <div class="form-group">
                                <label>Province</label>
                                <select class="form-control"  id="provinceSelector">
                                    <option value="">Select Province</option>
                                    <option v-for="province in provinces" :value="province.id" :key="province.id">{{ province.title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district">District</label>
                                <select class="form-control" id="district" v-model="districtSelected">
                                    <option value="">Select District</option>
                                    <option v-for="district in districts" :value="district.id" :key="district.id">{{ district.title }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="municipality">Municipality</label>
                                <select class="form-control" id="municipality" v-model="municipalitySelected">
                                    <option value="">Select Municipality</option>
                                    <option v-for="municipality in municipalities" :value="municipality.id" :key="municipality.id">{{ municipality.title }}</option>
                                </select>
                            </div>
                            <!-- palika -->
                            <div class="form-group">
                                <label for="palika">Palika</label>
                                <select class="form-control" id="palika" v-model="palikaSelected">
                                    <option value="">Select Palika</option>
                                    <option v-for="palika in palikas" :value="palika.id" :key="palika.id">{{ palika.title }}</option>
                                </select>
                            </div>
                    </div>
                </section>
                <h5>Navigation</h5>
                <section class="text-center">
                    <div class="pos-vertical-center">
                        <h4>Navigate the steps using your keyboard arrows</h4>
                    </div>
                </section>
                <h5>Finish</h5>
                <section class="text-center">
                    <div class="pos-vertical-center">
                        <h4>Use wizard for onboarding, form data collection and more</h4>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
    import PublicService from "../../services/PublicService";
    export default {
        name:"RegisterHospital",
        props: {
        },
        components: {
        },
        data:()=>({
                hospital_name: "",
                provinces:{},
                districts: {},
                municipalities:{},
                palikas:{},
                provinceSelected:"",
                districtSelected:"",
                municipalitySelected:"",
                palikaSelected:""   
        }),
        mounted(){
            this.getProvince();
            this.watchProvinces();
        },
        methods: {
            printAll(){
                console.log(this.title)
            },
            async getProvince(){
                const  response = await PublicService.getProvince();
                console.log(response.data);
                this.provinces=response.data;
            },
            async getDistrict(){
                const response = await PublicService.getDistrict(1,"",this.provinceSelected);
                this.districts=response.data.data.districts.data
            },
            async getMunicipality(){
                const response = await PublicService.getMunicipality(1,"",this.districtSelected);
                this.municipalities=response.data.data.municipalities.data
            },
            async getPalika(){
                const response = await PublicService.getPalika(1,"",this.districtSelected);
                this.palikas=response.data.data.palikas.data
            },
            watchProvinces(){
                document.getElementById("provinceSelector").addEventListener("change",(e)=>{
                    this.provinceSelected=e.target.value;
                    this.getDistrict();
                    console.log(e.target.value);
                })
            }
        },
        watch:{
            hospital_name:function(value){
                console.log(value);
            },
            provinceSelected:function(value){
                this. getDistrict();
                console.log(value);
            },
            districtSelected:function(value){
                this.getMunicipality();
                this.getPalika();
            }
        }
    };
</script>

<style>
.wiz > .steps .done a, .wiz > .steps .done a:hover, .wiz > .steps .done a:active, .wiz > .steps .disabled a, .wiz > .steps .disabled a:hover, .wiz > .steps .disabled a:active {
    background: none;
    color: #252525;
}

.wiz > .steps .done a, .wiz > .steps .done a:hover, .wiz > .steps .done a:active, .wiz > .steps .disabled a, .wiz > .steps .disabled a:hover, .wiz > .steps .disabled a:active {
    background: none;
    color: #252525;
}
.wiz > .steps .disabled a, .wiz > .steps .disabled a:hover, .wiz > .steps .disabled a:active {
    background: #eee;
    color: #aaa;
    cursor: default;
}
.wiz > .steps a, .wiz > .steps a:hover, .wiz > .steps a:active {
    margin: 0;
}
.wiz > .steps a, .wiz > .steps a:hover {
    padding-bottom: 2.78571429em;
}
.wiz > .steps a {
    position: relative;
}
.wiz > .steps a, .wiz > .steps a:hover, .wiz > .steps a:active {
    margin: 0;
}
.wiz > .steps a, .wiz > .steps a:hover {
    padding-bottom: 2.78571429em;
}
.wiz > .steps a {
    position: relative;
}
.wiz > .steps a, .wiz > .steps a:hover, .wiz > .steps a:active {
    display: block;
    width: auto;
    margin: 0 0.5em 0.5em;
    padding: 1em 1em;
    text-decoration: none;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
ul:not([class*='menu']) li > a {
    font-weight: normal;
}
ul:not([class*='menu']) li > a {
    font-weight: normal;
}
.wiz a, .tabcontrol a {
    outline: 0;
}

</style>