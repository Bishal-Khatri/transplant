<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Banner - Home Page</h2>
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
                        <a class="nav-link active" id="content-tab" data-toggle="tab" :href="'#style-'+section.id" role="tab" aria-controls="home" aria-selected="true">
                            Header
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="style-tab" data-toggle="tab" :href="'#content-'+section.id" role="tab" aria-controls="profile" aria-selected="false">
                            Content
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" :id="'style-'+section.id" role="tabpanel" aria-labelledby="content-tab">
                        <form class="form-horizontal form-label-left">
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
                                    Section Body
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <textarea class="form-control" v-model="body" cols="30" rows="5" placeholder="Short Description"></textarea>
                                    <span class="form-text small text-danger" v-html="errors.get('body')"></span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" :id="'content-'+section.id" role="tabpanel" aria-labelledby="style-tab">
                        <form class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Background Image
                                </label>
                                <div class="col-md-4 col-sm-4 ">
                                    <input type="text" v-model="background_image" class="form-control" disabled>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-accent btn-block" @click.prevent="$refs.backgroundImage.openDialog()"><i class="fa fa-images mr-1"></i>Choose</button>
                                    <select-file name="backgroundImage" title="Select File" ref="backgroundImage" @filesSelected="selectBackgroundImage"/>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Thumbnail Image
                                </label>
                                <div class="col-md-4 col-sm-4 ">
                                    <input type="text" v-model="image_url" class="form-control" disabled>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-accent btn-block" @click.prevent="$refs.thumbnailImage.openDialog()"><i class="fa fa-images mr-1"></i>Choose</button>
                                    <select-file name="thumbnailImage" title="Select File" ref="thumbnailImage" @filesSelected="selectThumbnailImage"/>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Video
                                </label>
                                <div class="col-md-4 col-sm-4 ">
                                    <input type="text" v-model="video_url" class="form-control" disabled>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-accent btn-block" @click.prevent="$refs.selectVideo.openDialog()"><i class="fa fa-images mr-1"></i>Choose</button>
                                    <select-file name="selectVideo" title="Select File" ref="selectVideo" @filesSelected="selectVideo"/>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Button Name
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" v-model="button_name" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Button Link
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" v-model="button_link" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import {EventBus} from "../../../app";
    import PageService from "../../../../services/PageService";
    import SelectFile from "../../storage/SelectFile";

    export default {
        name: "Banner",
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

                background_image: '',
                image_url: '',
                video_url: '',
                button_name: "Read More",
                button_link: "#",
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
                this.background_image = background.image_url;

                // parse media
                let json_data = JSON.parse(this.section.json_data);
                this.image_url = json_data.image_url;
                this.video_url = json_data.video_url;
                this.button_name = json_data.button_name;
                this.button_link = json_data.button_link;
            },
            async init(){
            },

            async updateSection(){
                this.submitting = true;
                try {

                    let background = JSON.stringify({
                        type: 'image',
                        image_url: this.background_image
                    });

                    let json_data = JSON.stringify({
                        image_url: this.image_url,
                        video_url: this.video_url,
                        button_name: this.button_name,
                        button_link: this.button_link,
                    });


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
            }
        }
    }
</script>

<style scoped>

</style>
