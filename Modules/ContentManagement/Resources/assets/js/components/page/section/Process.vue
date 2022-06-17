<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Process</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link text-accent" href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><slot name="delete"></slot></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs justify-content-start bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="home" aria-selected="true">
                            Header
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="style-tab" data-toggle="tab" href="#style" role="tab" aria-controls="profile" aria-selected="false">
                            Content
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <form class="form-horizontal form-label-left">
                            <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label  class="form-label">Order</label>
                                        <input type="number" class="form-control" min="1" placeholder="Order" v-model="section_order">
                                    </div>
                                    <div class="col-md-5 form-group ">
                                        <!-- background button group Light,Medium,Dark,Image -->
                                        <label class="form-label">Background</label>
                                        <div class="form-control btn-group btn-group-toggle" data-toggle="buttons" style="height: 3.4rem;">
                                            <label class="btn btn-secondary" :class="type === 'light' ? 'active' : ''"  @click="setBackgroundType('light')">
                                                <input type="radio" class="join-btn" value="light"> Light
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'medium' ? 'active' : ''" @click="setBackgroundType('medium')">
                                                <input type="radio" class="join-btn" value="medium" > Medium
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'dark' ? 'active' : ''"  @click="setBackgroundType('dark')">
                                                <input type="radio" class="join-btn" value="dark"> Dark
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'image' ? 'active' : ''" @click="setBackgroundType('image')">
                                                <input type="radio" class="join-btn" value="image" > Image
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4" v-if="type=='image'">
                                        <label class="form-label">Background Image</label><br>
                                        <button class="btn btn-accent" @click.prevent="$refs.selectBackgroundImageSelector.openDialog()">Choose Images</button>
                                    </div>
                            </div>   
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Section Visibility
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="checkbox" class="js-switch-custom" v-model="visibility" />
                                    <span v-if="visibility">Visible</span>
                                    <span v-else>Hidden</span>
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
                                    Section Body
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control" v-model="body" cols="30" rows="5" placeholder="Short Description"></textarea>
                                    <span class="form-text small text-danger" v-html="errors.get('body')"></span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="style" role="tabpanel" aria-labelledby="style-tab">
                        <form class="form-horizontal form-label-left">                
                                <div class="row">
                                    <div class="col-md-9">
                                        <label class="form-label">Title</label>
                                        <input type="text" v-model="content_title" placeholder="Title" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Order</label>
                                        <input type="number" class="form-control" min="1" v-model="content_order" placeholder="Order">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Body</label>
                                        <textarea class="form-control" v-model="content_body" cols="30" rows="5" placeholder="Short Description"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end p-4">
                                    <!-- button success save -->
                                    <a class="btn btn-link" v-if="content_submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                                    <a class="btn btn-success" v-else @click.prevent="saveContent" href="">Save</a>
                                </div>
                        </form>
                        <hr>
                        <div class="row p-4" v-if="processes.length > 0" v-for="(process,index) in processes" :key="index">
                            <div class="col-md-9">    
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" v-model="process.title" placeholder="Title" class="form-control" :readonly="index === content_edit_id?false:true">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Body</label>
                                    <textarea class="form-control" v-model="process.body" cols="30" rows="5" placeholder="Short Description" :readonly="index === content_edit_id?false:true"></textarea>
                                </div>
                                </div>
                                <div v-if="index === content_edit_id" class="col-md-3 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-success text-white" @click.prevent="updateContent" >Save</a>
                                    <a class="btn btn-secondary text-white" @click.prevent="cancelContent" >Delete</a>
                                </div>
                                 <div v-else class="col-md-3 d-flex justify-content-center align-items-center">
                                    <a class="btn btn-primary" @click.prevent="editContent(index)" href="">Edit</a>
                                    <a class="btn btn-danger" @click.prevent="deleteContent(index)" href="">Delete</a>
                                </div>
                        </div>
                        <div v-else >
                            <div class="text-center">
                                <h4>No Content</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <select-file name="imageBackgroundFiled" title="Select Image" ref="selectBackgroundImageSelector" @filesSelected="addImages"/>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import {EventBus} from "../../../app";
    import PageService from "../../../../services/PageService";
    import SelectFile from "../../storage/SelectFile";

    export default {
        name: "Process",
        props: [
            'page',
            'section',
            'sliders',
        ],
        components: {
            SelectFile
        },
        data(){
            return{
                errors: new Errors(),
                submitting: false,

                title: '',
                body: '',
                visibility: 1,
                section_order: 0,
                type:'light',

                background_image: '',
                image_url: '',
                video_url: '',
                button_name: "Read More",
                button_link: "#",


                // content 
                content_edit_id: 'none',
                content_order: 0,
                content_title: '',
                content_body: '',
                content_submitting: false,
                processes:[]

            }
        },
        async mounted(){
            await this.setData();
            this.init();
        },
        methods:{
            selectBackgroundImage(path){
                this.background_image = '/storage/filemanager/'+path;
            },
            selectThumbnailImage(path){
                this.image_url = '/storage/filemanager/'+path;
            },
            selectVideo(path){
                this.video_url = '/storage/filemanager/'+path;
            },
            async setData(){
                this.title = this.section.title;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;
                this.body = this.section.text;

                // parse background
                let background = JSON.parse(this.section.background);
                this.background_image = background?.image_url;
                this.type = background?.type;

                // parse media
                let json_data = JSON.parse(this.section.json_data);
                this.processes = json_data;
            },
            async init(){
            },

            async updateSection(){
                this.submitting = true;
                this.processes.push({
                    order: this.content_order,
                    title: this.content_title,
                    body: this.content_body,
                });
                this.content_order++;
                try {

                    let background = JSON.stringify({
                        type: this.type,
                        image_url: this.background_image
                    });
                    let json_data = JSON.stringify(this.processes);
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: this.body,
                        visibility: this.visibility,
                        order: this.section_order,
                        json_data: json_data,
                        background: background,
                    };
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
            async saveContent(){
                this.content_submitting = true;
                this.processes.push({
                    order: this.content_order,
                    title: this.content_title,
                    body: this.content_body,
                });
                this.content_order++;
                try {

                    let background = JSON.stringify({
                        type: this.type,
                        image_url: this.background_image
                    });
                    let json_data = JSON.stringify(this.processes);
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: this.body,
                        visibility: this.visibility,
                        order: this.section_order,
                        json_data: json_data,
                        background: background,
                    };
                    const response = await PageService.updateSection(formData);
                    if (response.data.error === false) {
                        Errors.Notification(response);
                    }
                } catch (error) {
                    this.errors.record(error.response.data);
                    Errors.Notification(error.response);
                }
                EventBus.$emit('sectionUpdated');
                this.content_submitting = false;
            },
            deleteContent(index){
                this.processes.splice(index,1);
                EventBus.$emit('sectionUpdated');
            },
            editContent(index){
                this.content_edit_id = index;
            },
            cancelContent(){
                this.content_edit_id = 'none';
            },
            updateContent(){
                this.content_edit_id = 'none';
                updateSection();
                EventBus.$emit('sectionUpdated');
            },
            setBackgroundType(type){
                this.type = type;
            },
            addImages(files){
                this.image_url = `/storage/filemanager/${files[0]}`;
            },
        }
    }
</script>

<style scoped>

</style>
