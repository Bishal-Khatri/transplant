<template>
    <div>
        <div class="modal fade" id="create-district-dialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Create/Update District</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="form-group row">
                            <label>District Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" v-model="title">
                            <span class="form-text text-danger" v-html="errors.get('title')"></span>

                            <input type="text" class="form-control" style="display:none;" v-model="province_id" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button v-if="submitting" type="button" class="btn btn-accent btn-sm"><i class="fa fa-spinner fa-spin"></i></button>
                        <button v-else type="submit" class="btn btn-accent btn-sm" @click.prevent="saveDistrict">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../../app';
    import {Errors} from "../../../../../../../resources/js/error";
    import DataService from "../../../services/DataService";

    export default {
        name: "AddQuantity",
        props: [
            'province_id'
        ],
        components: {
        },
        data: () => ({
            errors: new Errors(),
            submitting: false,
            district: "",
            provinces: [],
            provinces_pg:[],
            filter:"",
            district_id: "",
            // form data
            title: "",
        }),
        computed:{
        },
        methods: {
            setSearch:_.debounce(function(){
                this.getProvince();
            }, 800),
            openDialog(district) {
                if (district){
                    this.district = district;
                    this.title = district.title;
                    this.province_id= district.province_id;
                    this.district_id = district.id;
                    this.filter=district.province.title;
                }else{
                    this.clearForm();
                }
                $("#create-district-dialog").modal("show");
            },
            setProvince(id,index){
                this.filter=this.provinces[index].title;
                this.province_id=id;
                $('#province_group').empty();
            },
            async getProvince(page = 1) {
                const response = await DataService.getProvince(page, this.filter,this.province_id);
                this.provinces_pg = response.data.data.provinces;
                this.provinces = response.data.data.provinces.data;
            },
            async saveDistrict() {
                this.submitting = true;
                try {
                    const formData = {
                        id: this.district_id,
                        province_id:this.province_id,
                        title: this.title,
                    };

                    const response = await DataService.saveDistrict(formData);
                    if (response.data.error === false) {
                        $("#create-district-dialog").modal("hide");
                        this.clearForm();
                        Errors.Notification(response);
                    }
                    this.submitting = false;
                } catch (error) {
                    this.submitting = false;
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('districtCreated');
                this.submitting = false;
            },

            clearForm() {
                this.title = this.district = this.district_id =this.filter= '';
                this.errors.clear();
            },
        },
    };
</script>

<style >
</style>
