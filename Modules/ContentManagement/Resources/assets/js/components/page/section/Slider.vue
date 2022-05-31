<template>
    <div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Slider <input type="checkbox" class="js-switch ml-4" v-model="visibility" /> Visible</h2>
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
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Section Body
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea class="form-control" v-model="text" cols="30" rows="5" placeholder="Short Description"></textarea>
                            <span class="form-text small text-danger" v-html="errors.get('text')"></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">
                            Gallery
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select class="form-control" v-model="slider_id">
                                <option selected>Choose Gallery</option>
                                <option v-for="gallery in galleries" :value="gallery.id">{{ gallery.title }}</option>
                            </select>
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
    import {EventBus} from "../../../app";
    import PageService from "../../../../services/PageService";

    export default {
        name: "Slider",
        props: [
            'page',
            'section',
            'galleries',
        ],
        components: {
            DeleteSection,
        },
        data(){
            return{
                errors: new Errors(),
                submitting: false,

                title: '',
                text: '',
                slider_id: '',
                visibility: 1,
                section_order: 0,
            }
        },
        async mounted(){
            await this.setData();
        },
        methods:{
            async setData(){
                this.title = this.section.title;
                this.text = this.section.text;
                this.visibility = this.section.visibility;
                this.section_order = this.section.order;

                let json_data = JSON.parse(this.section.json_data);
                json_data ? this.slider_id = json_data.slider_id : '';
            },

            async updateSection(){
                this.submitting = true;
                try {
                    let json_data = JSON.stringify({
                        slider_id: this.slider_id,
                    });

                    const formData = {
                        section_id: this.section.id,
                        title: this.title,
                        text: this.text,
                        visibility: this.visibility,
                        order: this.section_order,
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
