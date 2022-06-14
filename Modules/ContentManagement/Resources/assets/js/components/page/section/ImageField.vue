<template>
    <div id="ImageFieldWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2>Image Field</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link text-accent" href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li>
                        <slot name="delete"></slot>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs justify-content-start bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" :href="'#content-'+section.id"  role="tab" aria-controls="home" aria-selected="true">
                            Header
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="style-tab" data-toggle="tab" :href="'#style-'+section.id" role="tab" aria-controls="profile" aria-selected="false">
                            Content
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" v-bind:id="'content-'+section.id" role="tabpanel" aria-labelledby="content-tab">
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

                    <div class="tab-pane fade" v-bind:id="'style-'+section.id" role="tabpanel" aria-labelledby="style-tab">
                        <div class="item form-group">
                            <button class="btn btn-accent" @click.prevent="$refs.selectImage.openDialog()">Choose Images</button>
                        </div>

                        <div class="item form-group">
                            <table class="table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="text-right" style="width:150px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-if="images" v-for="(image, index) in images">
                                    <td>
                                        <img :src="image.path" alt="" name="image" class="rounded image-xl">
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-danger btn-sm" @click.prevent="removeImage(index)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <select-file name="imageFiled" title="Select Image" ref="selectImage" @filesSelected="addImages"/>
    </div>
</template>

<script>
    import {Errors} from "../../../../../../../../resources/js/error";
    import PageService from "../../../../services/PageService";
    import {EventBus} from "../../../app";
    import SelectFile from "../../storage/SelectFile";

    export default {
        name: "ImageField",
        props: [
            'page',
            'section',
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
                images: [],
            }
        },
        async mounted(){
            await this.setData();
        },
        methods:{
            addImages(path){
                if (path){
                    for (let i=0; i < path.length; i++){
                        this.images.push({
                            path: '/storage/filemanager/'+path[i]
                        });
                    }
                }
            },

            removeImage(index){
                this.images.splice(index,1)
            },

            async setData(){
                this.title = this.section.title;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;
                this.body = this.section.text;

                let files = JSON.parse(this.section.json_data);
                if (files) {
                    for (let i=0; i < files.length; i++){
                        this.images.push(files[i]);
                    }
                }
            },

            async updateSection(){
                this.submitting = true;
                try {
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: this.body,
                        visibility: this.visibility,
                        order: this.section_order,
                        json_data: JSON.stringify(this.images),
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
