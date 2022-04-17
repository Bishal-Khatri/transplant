<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>RichText Section</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="btn btn-link" v-if="submitting" href=""><i class="fa fa-spinner fa-spin"></i></a>
                        <a class="btn btn-link" href="" v-else @click.prevent="updateSection">Save Section</a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="" @click.prevent="$refs.deleteSection.openDialog(section.id)"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-label-left input_mask">
                    <div class="checkbox col-md-12 col-sm-12  form-group">
                        <label><input type="checkbox" v-model="visibility"> Visibility</label>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="number" style="width: 150px;" class="form-control form-control-sm" v-model="section_order" placeholder="Section Order">
                    </div>
                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" v-model="title" id="inputSuccess2" placeholder="Section Title">
                        <span class="fa fa-align-left form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-12 col-sm-12  form-group has-feedback">
                        <textarea class="form-control summernote" v-model="body" id="body" cols="30" rows="5" placeholder="Text"></textarea>
                        <span class="form-text small text-danger" v-html="errors.get('body')"></span>
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
