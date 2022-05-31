<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>RichText Section <input type="checkbox" class="js-switch ml-4" v-model="visibility" /> Visible</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link" href="" v-else @click.prevent="updateSection" class="text-accent" >Save Section</a>
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

                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Body
                        </label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea class="form-control summernote" v-model="body" id="body" cols="30" rows="5" placeholder="Text"></textarea>
                            <span class="form-text small text-danger" v-html="errors.get('body')"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <delete-section ref="deleteSection"></delete-section>
    </div>
</template>

<script>
    import PageService from "../../../../services/PageService";
    import {Errors} from "../../../../../../../../resources/js/error";
    import {EventBus} from "../../../app";
    import DeleteSection from "./DeleteSection";

    export default {
        name: "RichText",
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
            }
        },
        async mounted(){
            await this.setData();
            this.init();
        },
        methods:{
            async setData(){
                this.title = this.section.title;
                this.body = this.section.text;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;
            },
            async init(){
                $('.summernote').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ]
                });
            },

            async updateSection(){
                this.submitting = true;
                try {
                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: $("#body").val(),
                        visibility: this.visibility,
                        order: this.section_order,
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
