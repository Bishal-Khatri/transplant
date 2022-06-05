<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>ImageField <input type="checkbox" class="js-switch ml-4" v-model="visibility" /> Visible</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link text-accent" href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Order
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" v-model="section_order" class="form-control">
                            <span class="form-text small text-danger" v-html="errors.get('section_order')"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Title
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="text" v-model="title" class="form-control">
                            <span class="form-text small text-danger" v-html="errors.get('title')"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Image File
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="file" class="form-control-file" id="image" @change.prevent="handelImage">
                            <small class="text-muted">Your image needs to be at least 500×500 pixels. Choose new file or Replace</small>

                            <br>
                            <img v-if="image_url" :src="image_url" alt="" name="image" class="rounded image-xl">
                            <img v-else src="/images/placeholder-dark.jpg" alt="" id="main-image-preview" name="image" class="rounded image-xl">
                        </div>
                    </div>


                </form>

            </div>
        </div>

        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import DeleteSection from "./DeleteSection";
    import PageService from "../../../../services/PageService";
    import {EventBus} from "../../../app";

    export default {
        name: "ImageField",
        props: [
            'page',
            'section',
        ],
        components: {
            DeleteSection,
        },
        data(){
            return{
                errors: new Errors(),
                submitting: false,

                title: '',
                image: '',
                image_url: '',
                visibility: 1,
                section_order: 0,
            }
        },
        async mounted(){
            await this.setData();
            this.init();
        },
        methods:{
            async setData(){
                this.title = this.section.title;
                this.visibility = this.section.visibility;
                if (this.section.image_url){
                    this.image_url = '/storage/'+this.section.image_url;
                }
                this.section_order = this.section.order;
            },
            async init(){

            },

            async updateSection(){
                this.submitting = true;
                try {
                    let formData = new FormData();
                    formData.append("section_id", this.section.id);
                    if (this.title) {
                        formData.append("title", this.title);
                    }
                    formData.append("visibility", this.visibility);
                    formData.append("order", this.section_order);
                    if(this.image){
                        formData.append("image", this.image, this.image.name);
                    }

                    const response = await PageService.updateSection(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('sectionUpdated');
                this.submitting = false;
            },

            handelImage(event){
                this.image = event.target.files[0];
                this.image_url = URL.createObjectURL(event.target.files[0]);
            },
        }
    }
</script>

<style scoped>

</style>
