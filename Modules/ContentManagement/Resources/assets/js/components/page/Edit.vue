<template>
    <div>
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-bars"></i> Page Sections</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="component-tab" data-toggle="tab" href="#component" role="tab" aria-controls="home" aria-selected="true">Components</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="widget-tab" data-toggle="tab" href="#widget" role="tab" aria-controls="profile" aria-selected="false">Widget</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="component" role="tabpanel" aria-labelledby="home-tab">
                                <ul class="to_do">
                                    <li>
                                        <p>Call To Action <a class="float-right" href="#" @click.prevent="addSection('call_to_action', 'component')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>
                                    <li>
                                        <p>Slider <a class="float-right" href="#" @click.prevent="addSection('slider')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>
                                    <li>
                                        <p>Text Field <a class="float-right" href="#" @click.prevent="addSection('text')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>
                                    <li>
                                        <p>Image <a class="float-right" href="" @click.prevent="addSection('image')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>

                                    <li>
                                        <p>Pdf <a class="float-right" href="" @click.prevent="addSection('pdf')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-pane fade" id="widget" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="to_do">
                                    <li>
                                        <p>Image Gallery <a class="float-right" href="" @click.prevent="addSection('gallery')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>
                                    <li>
                                        <p>File Downloads <a class="float-right" href="" @click.prevent="addSection('file_download')"><i class="fa fa-plus mr-1"></i>Add</a> </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-9 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Page</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="mr-3">
                                <a class="" style="color: #5A738E;" v-if="submitting" href="">Saving <i class="fa fa-spinner fa-spin"></i></a>
                                <a class="" style="color: #5A738E;" v-else @click.prevent="updatePage" href="">Save Section</a>
                            </li>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Enable</a>
                                    <a class="dropdown-item" href="#">Disable</a>
                                </div>
                            </li>
                            <li><a class="" @click.prevent="getPageDetails"><i class="fa fa-refresh"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-label-left input_mask">
                            <div class="row">
                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" v-model="title" placeholder="Page Title">
                                    <span class="fa fa-align-left form-control-feedback left" aria-hidden="true"></span>
                                </div>

                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                    <textarea class="form-control" name="" cols="30" rows="5" placeholder="Short Description" v-model="short_description"></textarea>
                                </div>
                                <div class="col-md-12 col-sm-12  form-group">
                                    <select class="form-control" v-model="category_id">
                                        <option value="" selected>Choose Category</option>
                                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--<pre>{{sections}}</pre>-->

                <div v-if="sections.length" v-for="(section, index) in sections" :key="index">

                    <call-to-action v-if="section.section_name === 'call_to_action'" :page="page" :section="section"></call-to-action>

                    <rich-text v-if="section.type === 'text'" :page="page" :section="section"></rich-text>

                    <slider v-if="section.type === 'slider'" :page="page" :section="section" :sliders="sliders"></slider>

                    <image-field v-if="section.type === 'image'" :page="page" :section="section"></image-field>

                    <gallery v-if="section.type === 'gallery'" :page="page" :section="section" :galleries="galleries"></gallery>

                    <file-download v-else-if="section.type === 'file_download'" :page="page" :section="section"></file-download>

                    <pdf v-else-if="section.type === 'pdf'" :page="page" :section="section"></pdf>

                </div>

            </div>



        </div>
    </div>
</template>

<script>
    import {EventBus} from "../../app";
    import PageService from "../../../services/PageService";
    import {Errors} from "../../../../../../../resources/js/error";
    import Gallery from "./section/Gallery";
    import RichText from "./section/RichText";
    import FileDownload from "./section/FileDownload";
    import Slider from "./section/Slider";
    import Pdf from "./section/Pdf";
    import ImageField from "./section/ImageField";
    import CallToAction from "./section/CallToAction";
    export default {
        name: "Edit",
        components: {
            CallToAction,
            RichText,
            Gallery,
            ImageField,
            FileDownload,
            Pdf,
            Slider,
        },
        props: [
            'page',
            'galleries',
            'categories',
            'sliders',
        ],
        data(){
            return{
                submitting: false,
                page_details: '',
                sections: '',

                title: '',
                short_description: '',
                category_id: '',
            }
        },
        async mounted(){
            await this.getPageDetails();
            EventBus.$on('sectionUpdated', () => {
                this.getPageDetails();
            });
        },
        methods: {
            async getPageDetails() {
                const response = await PageService.getPageDetails(this.page.id);
                this.page_details = response.data.data.page;
                this.sections = response.data.data.page.sections;
                this.title = this.page_details.title;
                this.short_description = this.page_details.short_description;
                this.category_id = this.page_details.category_id;
            },
            async addSection(section_name, section_type) {
                const formData = {
                    page_id: this.page.id,
                    section_name: section_name,
                    section_type: section_type
                };
                const response = await PageService.addSection(formData);
                if (response.data.error === false) {
                    Errors.Notification(response);
                }
                this.getPageDetails();
            },

            init(){

            },

            async updatePage() {
                this.submitting = true;
                try {
                    const formData = {
                        page_id: this.page.id,
                        title: this.title,
                        short_description : this.short_description,
                        category_id : this.category_id
                    };

                    const response = await PageService.updatePage(formData);
                    if (response.data.error === false) {
                        this.getPageDetails();
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
                this.main_image = event.target.files[0];
                this.item_image_url = URL.createObjectURL(event.target.files[0]);
            },
            clearForm() {
                // this.id = this.item_name = this.sku = this.category = this.brand = '';
            },
            async showDelete(delete_id){
                this.delete_quantity_id = delete_id;
                $("#deleteModal").modal("show");
            },
            async hideDelete(){
                this.delete_quantity_id = '';
                $("#deleteModal").modal("hide");
            },
            async deleteQuantity(){
                this.delete_submitting = true;
                const response = await InventoryService.deleteQuantity(this.delete_quantity_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItemDetails();
                    this.hideDelete();
                    EventBus.$emit('quantityDeleted');
                }
                this.delete_submitting = false;
            },
            async uploadAdditionalImages(event){
                this.uploading_image = true;
                const files = event.target.files;
                if (files.length){
                    for (let i=0; i < files.length; i++){
                        await this.uploadFile(files[i]);
                    }
                    this.getItemDetails();
                }
                this.uploading_image = false;
            },

            async uploadFile(file){
                const fd = new FormData();
                if (file) {
                    fd.append("file", file, file.name);
                }
                fd.append("item_id", this.itemId);
                try {
                    const response = await InventoryService.uploadAdditionalImage(fd);
                    if (response.data.error === false) {
                    }
                    Errors.Notification(response);
                }catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
            },

            async deleteAdditionalImage(image_id){
                const response = await InventoryService.deleteAdditionalImage(image_id);
                if (response.data.error === false) {
                    Errors.Notification(response);
                    this.getItemDetails();
                }
            }
        },
    }
</script>

<style scoped>

</style>
