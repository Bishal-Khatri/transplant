<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Call To Action <input type="checkbox" class="js-switch ml-4" v-model="visibility" /> Visible</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link text-accent" class="text-accent"  href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="nav nav-tabs justify-content-end bar_tabs" id="myTab" role="tablist">
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

                    <div class="tab-pane fade" id="style" role="tabpanel" aria-labelledby="style-tab">
                        <form class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">
                                    Background
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <div class="row">
                                        <div class="btn-group form-check" >
                                            <label class="btn btn-secondary" :class="type === 'light' ? 'active' : ''">
                                                <input type="radio" class="join-btn" value="light" v-model="type"> Light
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'bg--secondary' ? 'active' : ''">
                                                <input type="radio" class="join-btn" value="bg--secondary" v-model="type"> Medium
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'bg--dark' ? 'active' : ''">
                                                <input type="radio" class="join-btn" value="bg--dark" v-model="type"> Dark
                                            </label>
                                            <label class="btn btn-secondary" :class="type === 'bg--primary' ? 'active' : ''">
                                                <input type="radio" class="join-btn" value="bg--primary" v-model="type"> Primary
                                            </label>
                                            <!--<label class="btn btn-secondary">-->
                                                <!--<input type="radio" class="join-btn" value="image" v-model="background"> Image-->
                                            <!--</label>-->
                                        </div>
                                    </div>
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
                                    <input type="text" v-model="link" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import DeleteSection from "./DeleteSection";
    import {Errors} from "../../../../../../../../resources/js/error";
    import PageService from "../../../../services/PageService";
    import {EventBus} from "../../../app";

    export default {
        name: "CallToAction",
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
                body: '',
                visibility: 1,
                section_order: 0,

                type: 'light',
                button_name: 'Go',
                link: '',
            }
        },
        async mounted(){
            await this.setData();
        },
        methods:{
            async setData(){
                this.title = this.section.title;
                this.body = this.section.text;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;

                let background = JSON.parse(this.section.background);
                this.type = background.type;

                let json_data = JSON.parse(this.section.json_data);
                this.button_name = json_data.button_name;
                this.link = json_data.link;
            },

            async updateSection(){
                this.submitting = true;
                let background = JSON.stringify({
                    type: this.type,
                    image_url: ''
                });
                let json_data = JSON.stringify({
                    button_name: this.button_name,
                    link: this.link
                });

                try {
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: this.body,
                        visibility: this.visibility,
                        order: this.section_order,
                        background: background,
                        json_data: json_data,
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
